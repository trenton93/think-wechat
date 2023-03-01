<?php
// +----------------------------------------------------------------------
// | 授权中间件
// +----------------------------------------------------------------------
// | Copyright (c) 2023 https://leapfu.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Trenton <370887237@qq.com>
// +----------------------------------------------------------------------

namespace trenton93\wechat\Middleware;

use think\Request;
use think\facade\Log;
use think\facade\Session;
use EasyWeChat\OfficialAccount\Application;

class OauthMiddleware
{

    /**
     * 执行中间件
     * @param Request  $request
     * @param \Closure $next
     * @param null     $param
     * @return mixed|\think\response\Redirect
     */
    public function handle(Request $request, \Closure $next, $param = null)
    {

        $params  = $this->getParam($param);
        $account = $params["account"];
        $scopes  = $params["scopes"];
        //定义session
        $session_key = 'wechat_oauth_user_' . $account;
        $session     = Session::get($session_key);
        /** @var Application $officialAccount */
        $officialAccount = app(sprintf('wechat.official_account.%s', $account));
        if (!$scopes) {
            $scopes = config(sprintf('wechat.official_account.%s.oauth.scopes', $account));
        }
        if (!$scopes) {
            $scopes = ['snsapi_base'];
        }
        if (is_string($scopes)) {
            $scopes = array_map('trim', explode(',', $scopes));
        }
        Log::info(json_encode($session));
        if (!$session) {
            if ($request->get('code')) {
                $session = $officialAccount->oauth->user();
                Session::set($session_key, $session);
                //跳转到登录
                Log::info($this->getTargetUrl($request));
                return redirect($this->getTargetUrl($request));
            }
            $url = $officialAccount->oauth->scopes($scopes)->redirect($request->url(true))->getTargetUrl();
            return redirect($url);
        }
        return $next($request);
    }


    /**
     * @param $params
     * @return array
     */
    protected function getParam($params)
    {
        //定义初始化
        $res["account"] = "default";
        $res['scopes']  = null;
        if (!$params) {
            return $res;
        }
        //解析
        $result  = explode(":", $params);
        $account = "";
        $scopes  = "";
        if (isset($result[0])) {
            $account = $result[0];
        }
        if (isset($result[1])) {
            $scopes = $result[1];
        }
        if ($account) {
            if (strpos($account, "sns") !== false) {
                $res["scopes"] = $account;
            } else {
                $res["account"] = $account;
            }
        }
        if ($scopes) {
            $res["scopes"] = $scopes;
        }
        return $res;
    }

    /**
     * Build the target business url.
     * @param Request $request
     *¬
     * @return string
     */
    protected function getTargetUrl($request)
    {
        $param = $request->get();
        if (isset($param['code'])) {
            unset($param['code']);
        }
        if (isset($param['state'])) {
            unset($param['state']);
        }
        return $request->baseUrl() . (empty($param) ? '' : '?' . http_build_query($param));
    }
}
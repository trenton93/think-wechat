<?php
// +----------------------------------------------------------------------
// | ThinkWechat 服务类
// +----------------------------------------------------------------------
// | Copyright (c) 2023 https://leapfu.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Trenton <370887237@qq.com>
// +----------------------------------------------------------------------
// +----------------------------------------------------------------------

namespace trenton93\ThinkWechat;

use EasyWeChat\MicroMerchant\Application as MicroMerchant;
use EasyWeChat\MiniProgram\Application as MiniProgram;
use EasyWeChat\OfficialAccount\Application as OfficialAccount;
use EasyWeChat\OpenPlatform\Application as OpenPlatform;
use EasyWeChat\OpenWork\Application as OpenWork;
use EasyWeChat\Payment\Application as Payment;
use EasyWeChat\Work\Application as Work;
use trenton93\ThinkWechat\CacheBridge;
use think\Service;

class WechatService extends Service
{

    /*
     *  usage:
     *      app( $module_name)
     *  or
     *      app( $module_name, [ app_id => 'test' ])
     */
    public function boot()
    {
        $apps = [
            'official_account' => OfficialAccount::class,
            'work'             => Work::class,
            'mini_program'     => MiniProgram::class,
            'payment'          => Payment::class,
            'open_platform'    => OpenPlatform::class,
            'open_work'        => OpenWork::class,
            'micro_merchant'   => MicroMerchant::class,
        ];
        $wechat_default = config('wechat.default') ? config('wechat.default') : [];
        foreach ($apps as $name => $app) {
            if (!config('wechat.' . $name)) {
                continue;
            }
            $configs = config('wechat.' . $name);
            foreach ($configs as $config_name => $module_default) {
                $this->app->bind('wechat.' . $name . '.' . $config_name, function ($config = []) use ($app, $module_default, $wechat_default) {
                    //合并配置文件
                    $account_config = array_merge($module_default, $wechat_default, $config);
                    $account_app    = app($app, ['config' => $account_config]);
                    if (config('wechat.default.use_tp_cache')) {
                        $account_app['cache'] = app(CacheBridge::class);
                    }
                    return $account_app;
                });
            }
            if (isset($configs['default'])) {
                $this->app->bind('wechat.' . $name, 'wechat.' . $name . '.default');
            }
        }
    }
}
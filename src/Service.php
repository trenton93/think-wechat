<?php
// +----------------------------------------------------------------------
// | think-wechat [微信 SDK for thinkphp6, 基于 w7corp/easywechat]
// +----------------------------------------------------------------------
// | Copyright (c) 2023 https://leapfu.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Trenton <370887237@qq.com>
// +----------------------------------------------------------------------

namespace trenton93\wechat;

use EasyWeChat\Work\Application as Work;
use EasyWeChat\Payment\Application as Payment;
use EasyWeChat\OpenWork\Application as OpenWork;
use EasyWeChat\MiniProgram\Application as MiniProgram;
use EasyWeChat\OpenPlatform\Application as OpenPlatform;
use EasyWeChat\MicroMerchant\Application as MicroMerchant;
use EasyWeChat\OfficialAccount\Application as OfficialAccount;

/**
 * 服务类
 * Class Service
 * @package trenton93\wechat
 */
class Service extends \think\Service
{

    protected $apps           = [
        'official_account'  => OfficialAccount::class,
        'work'             => Work::class,
        'mini_program'     => MiniProgram::class,
        'payment'          => Payment::class,
        'open_platform'    => OpenPlatform::class,
        'open_work'        => OpenWork::class,
        'micro_merchant'   => MicroMerchant::class,
    ];

    /*
    *  usage:
    *      app( $module_name)
    *  or
    *      app( $module_name, [ app_id => 'test' ])
    */
    public function boot()
    {
        $defaultConfig = config('wechat.default') ? config('wechat.default') : [];
        foreach ($this->apps as $name => $app) {
            if (!config('wechat.' . $name)) {
                continue;
            }
            $configs = config('wechat.' . $name);
            foreach ($configs as $moduleName => $moduleConfig) {
                $this->app->bind('wechat.' . $name . '.' . $moduleName, function ($config = []) use ($app, $moduleConfig, $defaultConfig) {
                    $accountConfig = array_merge($moduleConfig, $defaultConfig, $config);
                    $accountApp   = app($app, ['config' => $accountConfig]);
                    if (config('wechat.default.use_tp_cache')) {
                        $accountApp['cache'] = app(Cache::class);
                    }
                    return $accountApp;
                });
            }
        }
        $this->commands([
            \trenton93\wechat\command\Config::class
        ]);
    }
}
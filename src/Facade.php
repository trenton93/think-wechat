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

/**
 * 门面类
 * Class Facade
 * @package trenton93\wechat
 */
class Facade extends \think\Facade
{

    /**
     * @return \EasyWeChat\OfficialAccount\Application
     */
    public static function officialAccount($name = '', $config = [])
    {
        return $name ? app('wechat.official_account.' . $name, ["config" => $config]) : app('wechat.official_account', ["config" => $config]);
    }

    /**
     * @return \EasyWeChat\Work\Application
     */
    public static function work($name = '', $config = [])
    {
        return $name ? app('wechat.work.' . $name, ["config" => $config]) : app('wechat.work', ["config" => $config]);
    }

    /**
     * @return \EasyWeChat\Payment\Application
     */
    public static function payment($name = '', $config = [])
    {
        return $name ? app('wechat.payment.' . $name, ["config" => $config]) : app('wechat.payment', ["config" => $config]);
    }

    /**
     * @return \EasyWeChat\MiniProgram\Application
     */
    public static function miniProgram($name = '', $config = [])
    {
        return $name ? app('wechat.mini_program.' . $name, ["config" => $config]) : app('wechat.mini_program', ["config" => $config]);
    }

    /**
     * @return \EasyWeChat\OpenPlatform\Application
     */
    public static function openPlatform($name = '', $config = [])
    {
        return $name ? app('wechat.open_platform.' . $name, ["config" => $config]) : app('wechat.open_platform', ["config" => $config]);
    }

    /**
     * @return \EasyWeChat\OpenWork\Application
     */
    public static function openWork($name = '', $config = [])
    {
        return $name ? app('wechat.open_work.' . $name, ["config" => $config]) : app('wechat.open_work', ["config" => $config]);
    }

    /**
     * @return \EasyWeChat\MicroMerchant\Application
     */
    public static function microMerchant($name = '', $config = [])
    {
        return $name ? app('wechat.micro_merchant.' . $name, ["config" => $config]) : app('wechat.micro_merchant', ["config" => $config]);
    }

}
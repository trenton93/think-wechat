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

/**
 * 配置文件
 */
return [
    /*
      * 默认配置，将会合并到各模块中
      */
    'default'          => [
        /*
         * 指定 API 调用返回结果的类型：array(default)/object/raw/自定义类名
         */
        'response_type' => 'array',
        /*
         * 使用 ThinkPHP 的缓存系统
         */
        'use_tp_cache'  => true,
        /*
         * 日志配置
         *
         * level: 日志级别，可选为：
         *                 debug/info/notice/warning/error/critical/alert/emergency
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log'           => [
            'default'  => 'default',
            'channels' => [
                'default' => [
                    'driver' => 'daily',
                    'level'  => 'debug',
                    'path'   => app()->getRuntimePath() . "log/wechat.log",
                ],
            ],
        ],
    ],

    //公众号
    'official_account' => [
        'default' => [
            // AppID
            'app_id'  => '',
            // AppSecret
            'secret'  => '',
            // Token
            'token'   => '',
            // EncodingAESKey
            'aes_key' => '',
            /*
             * OAuth 配置
             *
             * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
             * callback：OAuth授权完成后s的回调页地址(如果使用中间件，则随便填写。。。)
             */
            //'oauth' => [
            //    'scopes'   => array_map('trim',
            //        explode(',',  'snsapi_userinfo')),
            //    'callback' => '/examples/oauth_callback.php',
            //],
        ],
    ],

    // 第三方开发平台
    //'open_platform'    => [
    //    'default' => [
    //        'app_id'  => '',
    //        'secret'  => '',
    //        'token'   => '',
    //        'aes_key' => '',
    //    ],
    //],

    // 小程序
    //'mini_program'     => [
    //    'default' => [
    //        'app_id'  => '',
    //        'secret'  => '',
    //        'token'   => '',
    //        'aes_key' => '',
    //    ],
    //],

    // 支付
    //'payment'          => [
    //    'default' => [
    //        'sandbox'    => false,
    //        'app_id'     => '',
    //        'mch_id'     => '',
    //        'key'        => '',
    //        'cert_path'  => 'path/to/cert/apiclient_cert.pem',    // XXX: 绝对路径！！！！
    //        'key_path'   => 'path/to/cert/apiclient_key.pem',      // XXX: 绝对路径！！！！
    //        'notify_url' => 'http://example.com/payments/wechat-notify',                           // 默认支付结果通知地址
    //    ],
    //    // ...
    //],

    // 企业微信
    //'work'             => [
    //    'default' => [
    //        'corp_id'  => 'xxxxxxxxxxxxxxxxx',
    //        'agent_id' => 100020,
    //        'secret'   => '',
    //        //...
    //    ],
    //],


    //企业开放平台
    //'open_work'             => [
    //    'default' => [
    //        //参考EasyWechat官方文档
    //        //https://www.easywechat.com/docs/4.1/open-work/index
    //    ],
    //],

    //小微商户
    //'micro_merchant'   => [
    //    'default' => [
    //        //参考EasyWechat官方文档
    //        //https://www.easywechat.com/docs/4.1/micro-merchant/index
    //    ],
    //],
];
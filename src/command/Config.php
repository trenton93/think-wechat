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

namespace trenton93\wechat\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\facade\Env;

/**
 * 自定义指令
 * Class Config
 * @package trenton93\wechat\command
 */
class Config extends Command
{

    /**
     * {@inheritdoc}
     */
    public function configure()
    {
        $this->setName('wechat:config')
            ->setDescription('send config to tp folder');
    }

    public function execute(Input $input, Output $output)
    {
        //获取默认配置文件
        $content = file_get_contents(root_path('vendor/trenton93/think-wechat/src') . 'config.php');

        $configPath = config_path();
        $configFile = $configPath . 'wechat.php';

        //判断目录是否存在
        if (!file_exists($configPath)) {
            mkdir($configPath, 0755, true);
        }

        //判断文件是否存在
        if (is_file($configFile)) {
            throw new \InvalidArgumentException(sprintf('The config file "%s" already exists', $configFile));
        }

        if (false === file_put_contents($configFile, $content)) {
            throw new \RuntimeException(sprintf('The config file "%s" could not be written to "%s"', $configFile,$configPath));
        }

        $output->writeln('create wechat config ok');
    }
}
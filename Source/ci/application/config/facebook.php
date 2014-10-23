<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//*** Default config for Facebook App
$config['appid'] = '695082060564419';
$config['appsecret'] = '093b0b371673a8b831dcc87d62fee7b0';

//*** Get permission
$config['scope'] = $scope = array('email', 'user_birthday');
$config['loginurl'] = 'http://timchoi.geekboy.in/index.php/login';

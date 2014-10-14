<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//*** Default config for Facebook App
$config['appid'] = '703356373080439';
$config['appsecret'] = 'dbd71535084d3208e66ec3528093a863';

//*** Get permission
$config['scope'] = $scope = array('email', 'user_birthday');
$config['loginurl'] = 'http://timchoi.geekboy.in/index.php/login';

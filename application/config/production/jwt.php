<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| JWT Secure Key
|--------------------------------------------------------------------------
*/
$config['jwt_key'] = 'eyJ0eXAiOiJKV1QiLCJhbGciTWvLUzI1NiJ9IiRkYXRhIg';
/*
|--------------------------------------------------------------------------
| JWT Algorithm Type
|--------------------------------------------------------------------------
*/
$config['jwt_algorithm'] = 'HS256';

/**
| Token Expired
| (1 Day) : 60 * 60 * 24 = 86400
| (1 Hour) : 60 * 60 = 3600
**/
$config['token_expire_time'] =  864000;

$config['token_header'] = ['authorization', 'Authorization'];
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|    http://codeigniter.com/user_guide/libraries/email.html
|
*/

$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['crlf'] = '\n';

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'tls://smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'domandtomsmtp@gmail.com';
$config['smtp_pass'] = 'nVgFlTWVNewV8f52yx';
$config['smtp_timeout'] = 30;

/* End of file email.php */
/* Location: ./application/config/email.php */
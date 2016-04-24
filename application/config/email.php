<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Email Config */
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com'; //change this?
    $config['smtp_port'] = '465';
    $config['smtp_user'] = 'molly.ostheller@gmail.com'; 
    $config['smtp_pass'] = 'hbffrplhkyajpyzm'; 
    $config['mailtype'] = 'html';
    $config['charset'] = 'iso-8859-1';
    $config['wordwrap'] = TRUE;
    $config['newline'] = "\r\n"; 
?>
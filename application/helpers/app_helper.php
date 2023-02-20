
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('alert')) {
    function alert($type, $title)
    {
        $messageAlert = "
        toastr.options = {
            'closeButton': true,
            'debug': false,
            'newestOnTop': true,
            'progressBar': false,
            'positionClass': 'toast-top-right',
            'preventDuplicates': false,
            'onclick': null,
            'showDuration': '3000',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        };
        toastr.{$type}('{$title}');
        ";

        return $messageAlert;
    }
}
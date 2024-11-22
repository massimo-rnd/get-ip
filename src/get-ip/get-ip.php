<?php
/*
Plugin Name: Get-IP
Plugin URI: https://github.com/massimo-rnd/get-ip
Description: A simple plugin to enable showing the current users IP address and hostname. You can use the shortcode [show_ip] to view the users IP address or [show_hostname] to show the users hostname on any page.
Version: 1.1
Requires at least: 4.8
Tested up to: 6.7.1
Requires PHP: 5.6
Author: massimo-rnd
Author URI: https://massimo.gg
License: MIT

Copyright (c) 2024 massimo-rnd. All rights reserved.
*/

function get_ip() {
    if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        return apply_filters( 'wpb_get_ip', $ip );
    } else {
        return 'Invalid IP Address';
    }
}

function get_hostname() {
    $ip = get_ip();

    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        $hostname = gethostbyaddr($ip);
        return apply_filters( 'wpb_get_hostname', $hostname ? $hostname : 'Hostname not found');
    } else {
        return 'Invalid IP Address';
    }
}

add_shortcode('show_ip', 'get_ip');
add_shortcode('show_hostname', 'get_hostname');

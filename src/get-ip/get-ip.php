<?php
/*
Plugin Name: Get-IP
Plugin URI: https://github.com/druffko/get-ip
Description: A simple plugin to enable showing the current users IP address and hostname. You can use the shortcode [show_ip] to view the users IP address or [show_hostname] to show the users hostname on any page.
Version: 1.0
Requires at least: 4.8
Tested up to: 5.5
Requires PHP: 5.6
Author: druffko
Author URI: https://druffko.gg
License: MIT

Copyright (c) 2024 druffko. All rights reserved.
*/

function get_ip() {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
	    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
	    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	    $ip = $_SERVER['REMOTE_ADDR'];
	}
	    return apply_filters( 'wpb_get_ip', $ip );
	}

	function get_hostname() {
		$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	}
	

	add_shortcode('show_ip', 'get_ip');
	add_shortcode('show_hostname', 'get_hostname')
?>
<?php

require_once '../config.php';

define('BASE_URL', $config['base_url']);

function base_url($path='') {
	return BASE_URL . urlencode($path);
}

function get_client_ip() {
    $ip_address = '';

    // Check for shared internet/ISP IP address
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Check for IPs passing through proxies
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Sometimes the X-Forwarded-For header contains multiple IPs, the first one is the client IP.
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip_address = trim($ipList[0]);
    }
    // Check standard headers
    elseif (!empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ip_address = $_SERVER['HTTP_X_FORWARDED'];
    }
    elseif (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ip_address = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    elseif (!empty($_SERVER['HTTP_FORWARDED'])) {
        $ip_address = $_SERVER['HTTP_FORWARDED'];
    }
    // Default to REMOTE_ADDR
    else {
        $ip_address = $_SERVER['REMOTE_ADDR'];
    }

    // Validate IP address (IPv4/IPv6)
    if (filter_var($ip_address, FILTER_VALIDATE_IP)) {
        return $ip_address;
    } else {
        return 'UNKNOWN';
    }
}

<?php

function get_client_ip()
{
    // Nothing to do without any reliable information
    if (!isset($_SERVER['REMOTE_ADDR'])) {
        return null;
    }

    // Header that is used by the trusted proxy to refer to
    // the original IP
    $proxy_header = "HTTP_X_FORWARDED_FOR";
    // List of all the proxies that are known to handle 'proxy_header'
    // in known, safe manner
    $trusted_proxies = array("2001:db8::1", "192.168.50.1");
    // Get IP of the client behind trusted proxy
    if (in_array($_SERVER['REMOTE_ADDR'], $trusted_proxies) && array_key_exists($proxy_header, $_SERVER)) {
    // Header can contain multiple IP-s of proxies that are passed through.
    // Only the IP added by the last proxy (last IP in the list) can be trusted.
        $array = explode(",", $_SERVER[$proxy_header]);
        $client_ip = trim(end($array));
        // Validate just in case
        if (filter_var($client_ip, FILTER_VALIDATE_IP)) {
            return $client_ip;
        } else {
            // Validation failed - beat the guy who configured the proxy or
            // the guy who created the trusted proxy list?
            // TODO: some error handling to notify about the need of punishment
        }
    }
 // In all other cases, REMOTE_ADDR is the ONLY IP we can trust.
    return $_SERVER['REMOTE_ADDR'];
}

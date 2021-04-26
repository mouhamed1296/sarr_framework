<?php

function start_session()
{
    if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(array(
                'cache_limiter' => 'private',
                'read_and_close' => true,
            ));
        }
    } elseif (version_compare(PHP_VERSION, '5.4.0') >= 0) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    } elseif (session_id() === '') {
        session_start();
    }
}

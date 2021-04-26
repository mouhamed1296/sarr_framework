<?php

function fatalErrorHandler()
{
    // Let's get last error that was fatal.
    $error = error_get_last();
    // This is error-only handler for example purposes; no error means that
    // there were no error and shutdown was proper. Also ensure it will handle
    // only fatal errors.
    if (null === $error || E_ERROR !== $error['type']) {
        return;
    }
    // Log last error to a log file.
    // let's naively assume that logs are in the folder inside the app folder.
    $logFile = fopen("./app/logs/error.log", 'ab+');
    // Get useful info out of error.
    $type = $error["type"];
    $file = $error["file"];
    $line = $error["line"];
    $message = $error["message"];
    fprintf(
        $logFile,
        "[%s] %s: %s in %s:%d\n",
        date("Y-m-d H:i:s"),
        $type,
        $message,
        $file,
        $line
    );
        fclose($logFile);
}
register_shutdown_function('fatalErrorHandler');

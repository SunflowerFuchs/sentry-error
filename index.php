<?php

require_once 'vendor/autoload.php';

Class ErrorHandler {
    function init() {
        set_error_handler([$this, 'handle']);
    }

    function handle() {
        echo 'default' . PHP_EOL;
    }
}

$prevHandler = new ErrorHandler();
$prevHandler->init();

Sentry\init([
    'dsn'            => 'https://43394bd8614a44f6a44345bae415fe95@sentry.pascal.local/3',
	'environment'    => 'test',
	'send_attempts'  => 3,
	'in_app_include' => ['/tmp/sentrytest/'],
	'prefixes'       => ['/tmp/sentrytest/'],
]);

// When $prevHandler is initialized, only the first of these warnings gets send to sentry
user_error( 'first error', E_USER_WARNING );
user_error( 'second error', E_USER_WARNING );
user_error( 'third error', E_USER_WARNING );

<?php

include("anticaptcha.php");
include("nocaptchaproxyless.php");

$api = new NoCaptchaProxyless();
$api->setVerboseMode(true);
        
//your anti-captcha.com account key
$api->setKey("2dd92cf4290d12ef110f6354d8a1d71b");
 
//recaptcha key from target website
$api->setWebsiteURL("http://http.myjino.ru/recaptcha/test-get.php");
$api->setWebsiteKey("6Lc_aCMTAAAAABx7u2W0WPXnVbI_v6ZdbM6rYf16");

if (!$api->createTask()) {
    $api->debout("API v2 send failed - ".$api->getErrorMessage(), "red");
    return false;
}

$taskId = $api->getTaskId();

sleep(15);
if (!$api->waitForResult()) {
    $api->debout("could not solve captcha", "red");
    $api->debout($api->getErrorMessage());
} else {
    $recaptchaToken =   $api->getTaskSolution();
    echo "\ntoken result: $recaptchaToken\n\n";
}

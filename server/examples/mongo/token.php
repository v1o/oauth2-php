<?php

/**
 * Sample token endpoint.
 *
 * Obviously not production-ready code, just simple and to the point.
 * In reality, you'd probably use a nifty framework to handle most of the crud for you.
 */

require __DIR__ . '/lib/OAuth2StorageMongo.php';
include __DIR__ . '/config.php';

$oauth = new OAuth2(new OAuth2StorageMongo($config['db_connection_string'], $config['db_name']));

try {
    $oauth->grantAccessToken();
}
catch (OAuth2ServerException $oauthError) {
    $oauthError->sendHttpResponse();
}

<?php

/**
 * Sample authorize endpoint.
 *
 * Obviously not production-ready code, just simple and to the point.
 * In reality, you'd probably use a nifty framework to handle most of the crud for you.
 */

require __DIR__ . '/lib/OAuth2StorageMongo.php';
include __DIR__ . '/config.php';

$oauth = new OAuth2(new OAuth2StorageMongo($config['db_connection_string'], $config['db_name']));

if ($_POST) {
    $user_id = 42;

    try {
        $oauth->finishClientAuthorization($_POST["accept"] == 'Yep', $user_id, $_POST);
    } catch (OAuth2RedirectException $oauthError) {
        die('You must give the application access to continue');
    }
}

try {
    $auth_params = $oauth->getAuthorizeParams();
} catch (OAuth2ServerException $oauthError) {
    $oauthError->sendHttpResponse();
}

?>
<html>
    <head>
        <h1>Authorize</h1>
    </head>
    <body>
        <form method="post" action="authorize.php">
            <? foreach ($auth_params as $k => $v) : ?>
                <input type="hidden" name="<?= $k ?>" value="<?= $v ?>" />
            <? endforeach ?>
            <p>
                Do you authorize the app to do its thing?
            </p>
            <p>
                <input type="submit" name="accept" value="Yep" />
                <input type="submit" name="accept" value="Nope" />
            </p>
        </form>
    </body>
</html>

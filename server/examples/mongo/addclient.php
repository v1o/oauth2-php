<?php

/**
 * Sample client add script.
 *
 * Obviously not production-ready code, just simple and to the point.
 */

require __DIR__ . '/lib/OAuth2StorageMongo.php';
include __DIR__ . '/config.php';

if ($_POST && isset($_POST["client_id"]) && isset($_POST["client_secret"]) && isset($_POST["redirect_uri"])) {
    $storage = new OAuth2StorageMongo($config['db_connection_string'], $config['db_name']);
    $ret = $storage->addClient($_POST["client_id"], $_POST["client_secret"], $_POST["redirect_uri"]);
}

?>
<html>
    <head>
        <h1>Add Client</h2>
    </head>
    <body>
        <form method="post" action="addclient.php">
            <table>
                <tr>
                    <td>
                        <label for="client_id">Client ID:</label>
                    </td>
                    <td>
                        <input type="text" name="client_id" id="client_id" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="client_secret">Client Secret (password/key):</label>
                    </td>
                    <td>
                        <input type="text" name="client_secret" id="client_secret" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="redirect_uri">Redirect URI:</label>
                    </td>
                    <td>
                        <input type="text" name="redirect_uri" id="redirect_uri" />
                    </td>
                </tr>
            </table>

            <input type="submit" value="Submit" />

            <? if (isset($ret) && $ret) : ?>
                (the client was added successfully)
            <? endif ?>

        </form>
    </body>
</html>

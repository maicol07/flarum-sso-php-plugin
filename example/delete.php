<?php /** @noinspection DuplicatedCode */

use Dotenv\Dotenv;
use Maicol07\SSO\Flarum;
use Maicol07\SSO\User;

// Note: Since this is called from the example folder, the vendor folder is located in the previous tree level
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env
$env = Dotenv::createImmutable(__DIR__);
$env->load();

// Create the Flarum object with the required configuration. The parameters are explained in the class file (src/Flarum.php)
$flarum = new Flarum([
    'url' => env('FLARUM_HOST') ?? 'http://flarum.example.com',
    'root_domain' => env('ROOT_DOMAIN') ?? 'example.com',
    'api_key' => env('API_KEY') ?? 'NotSecureToken',
    'password_token' => env('PASSWORD_TOKEN') ?? 'NotSecureToken',
    'remember' => env('TOKEN_REMEMBER') ?? false,
    'verify_ssl' => env('VERIFY_SSL') ?? true,
    'set_groups_admins' => env('SET_GROUPS_ADMINS') ?? true
]);

// Create the user to work with
$flarum_user = new User($_GET['username'], $flarum);

// Delete a user
$success = $flarum_user->delete();

if (!empty($_GET['redirect'])) {
    $flarum->redirect();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete user</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Lightweight CSS only to make this page beauty -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css"
          integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
</head>
<body class="container">
<div class="box" style="margin-top: 25px;">
    <h1 class="title">Delete user</h1>

    <?php if (isset($flarum) and !empty($success)) { ?>
        <div class="notification is-success">
            <button class="delete"></button>
            <?php echo "Successfully deleted {$_GET['username']}"; ?><br>
        </div>
    <?php } elseif (isset($flarum) and empty($success)) { ?>
        <div class="notification is-danger">
            <button class="delete"></button>
            <?php echo "Something went wrong while deleting {$_GET['username']} :("; ?><br><br>
            Check if one of this common error cases has occurred:
            <ul>
                <li>Username has not been typed correctly</li>
                <li>User does not exists in Flarum</li>
            </ul>
        </div>
        Users list:<br>
        <ul>
            <li><?php echo implode('</li><li>', $flarum->getUsersList('attributes.username')->all()); ?></
            >
        </ul>
    <?php } ?>
</div>
<footer class="footer">
    <div class="content has-text-centered">
        <div class="field is-grouped" style="justify-content: center;">
            <p class="control">
                <a class="button is-link" href="index.php">
                    Login
                </a>
            </p>
            <p class="control">
                <a class="button" href="logout.php">
                    Logout
                </a>
            </p>
            <p class="control">
                <a class="button is-danger" href="delete.php?username=user">
                    Delete user
                </a>
            </p>
        </div>
    </div>
</footer>
</body>
</html>

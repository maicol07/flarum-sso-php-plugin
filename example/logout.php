<?php /** @noinspection DuplicatedCode */

use Dotenv\Dotenv;
use Maicol07\SSO\Flarum;

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
    'lifetime' => env('TOKEN_LIFETIME') ?? 14,
    'verify_ssl' => env('VERIFY_SSL') ?? true,
    'set_groups_admins' => env('SET_GROUPS_ADMINS') ?? true
]);

// Logout current user
$success = $flarum->logout();

if (!empty($_GET['redirect'])) {
    $flarum->redirect();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Logout user</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Lightweight CSS only to make this page beauty -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css"
          integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
</head>
<body class="container">
<div class="box" style="margin-top: 25px;">
    <h1 class="title">Logout user</h1>
    
    <?php if (isset($flarum) and !empty($success)) { ?>
        <div class="notification is-success">
            <button class="delete"></button>
            Successfully logged out
        </div>
    <?php } elseif (isset($flarum) and empty($success)) { ?>
        <div class="notification is-danger">
            <button class="delete"></button>
            Something went wrong while logging you out of Flarum :(
        </div>
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
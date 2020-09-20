<?php

// Note: Since this is called from the example folder, the vendor folder is located in the previous tree level
use Maicol07\SSO\Flarum;

require_once __DIR__ . '/../vendor/autoload.php';

// Create the Flarum object with the required configuration. The parameters are explained in the class file (src/Flarum.php)
$forum = new Flarum(
    env('FLARUM_HOST') ?? 'http://flarum.example.com',
    env('ROOT_DOMAIN') ?? 'example.com',
    env('API_KEY') ?? 'NotSecureToken',
    env('PASSWORD_TOKEN') ?? 'NotSecureToken',
    env('TOKEN_LIFETIME') ?? 14,
    env('INSECURE') ?? false,
    env('SET_GROUPS_ADMINS') ?? true
);

// Logout current user
$forum->logout();

if (!empty($_GET['redirect'])) {
    $forum->redirect();
}

echo "Successfully logged out!";
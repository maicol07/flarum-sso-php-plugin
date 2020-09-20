<?php

use Illuminate\Support\Arr;
use Maicol07\SSO\Flarum;

// Note: Since this is called from the example folder, the vendor folder is located in the previous tree level
require_once __DIR__ . '/../vendor/autoload.php';

// Dummy users
$users = [
    'user' => [
        'password' => 'password',
        'email' => 'user@example.com',
    ],
    'admin' => [
        'password' => 'password',
        'email' => 'user1@example.com',
    ],
];

// Get username and password
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (isset($users[$username]) && $users[$username]['password'] === $password) {
    $email = $users[$username]['email'];
    
    // Create the Flarum object with the required configuration. The parameters are explained in the class file (src/Flarum.php)
    $forum = new Flarum(
        env('FLARUM_HOST') ?? 'http://flarum.example.com',
        env('ROOT_DOMAIN') ?? 'example.com',
        env('API_KEY') ?? 'NotSecureToken',
        env('PASSWORD_TOKEN') ?? 'NotSecureToken'
    );
    
    // Login the user with username, email and password (if user is already signed up in Flarum before using this extension)
    // If user doesn't exists in Flarum, it will be created
    $forum->login($username, $email, $users[$username]['password']);
    
    // Redirect to Flarum
    $forum->redirect();
} elseif (!empty($username) || !empty($password)) {
    echo 'Login failed';
}
?>

<h1>Login</h1>

<?php
foreach ($users as $user => $details) {
    echo '<p>' . $user . ' / ' . Arr::get($details, 'password') . '</p>';
}
?>

<form method="post">
    <label>
        <input type="text" name="username" placeholder="Username">
    </label>
    <label>
        <input type="password" name="password" placeholder="Password">
    </label>
    <button type="submit">Login</button>
</form>

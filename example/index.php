<?php

use Maicol07\SSO\Flarum;

require_once __DIR__ . '/src/Flarum.php';

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

$username = empty($_POST['username']) ? '' : $_POST['username'];
$password = empty($_POST['password']) ? '' : $_POST['password'];

if (isset($users[$username]) && $users[$username]['password'] === $password) {
    $email = $users[$username]['email'];
    // Create the Flarum object with the required configuration. The parameters are explained in the class file (src/Flarum.php)
    $forum = new Flarum('http://flarum.example.com', 'example.com', 'NotSecureToken', 'NotSecureToken');
    // Login the user with username, email and password (if user is already signed up in Flarum before using this extension)
    // If user doesn't exists in Flarum, it will be created
    $forum->login($username, $email, $users[$username]['password']);
    // Redirect to Flarum
    $forum->redirectToForum();
} elseif (!empty($username) || !empty($password)) {
    echo 'Login failed';
}
?>

<h1>Login</h1>

<p><?= array_keys($users)[0] ?> / <?= $users['user']['password'] ?></p>
<p><?= array_keys($users)[1] ?> / <?= $users['admin']['password'] ?></p>

<form method="post">
    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
</form>

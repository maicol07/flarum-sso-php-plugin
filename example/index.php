<?php /** @noinspection ForgottenDebugOutputInspection */

use Dotenv\Dotenv;
use Illuminate\Support\Arr;
use Maicol07\SSO\Addons\Groups;
use Maicol07\SSO\Flarum;
use Maicol07\SSO\User;

// Note: Since this is called from the example folder, the vendor folder is located in the previous tree level
require_once __DIR__ . '/../vendor/autoload.php';

// Load .env
$env = Dotenv::createImmutable(__DIR__);
$env->load();

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

if (!empty(Arr::get($users, $username)) && Arr::get($users, "$username.password") === $password) {
    // Create the Flarum object with the required configuration. The parameters are explained in the class file (src/Flarum.php)
    $flarum = new Flarum([
        'url' => env('FLARUM_HOST', 'https://discuss.flarum.org'),
        'root_domain' => env('ROOT_DOMAIN', 'flarum.org'),
        'api_key' => env('API_KEY', 'NotSecureToken'),
        'password_token' => env('PASSWORD_TOKEN', 'NotSecureToken'),
        'remember' => $_POST['remember'] ?? false,
        'verify_ssl' => env('VERIFY_SSL', true),
        'set_groups_admins' => env('SET_GROUPS_ADMINS', true)
    ]);

    // Create the user to work with
    $flarum_user = new User($username, $flarum);

    // Set his password
    $flarum_user->attributes->password = Arr::get($users, "$username.password");

    // If user is not signed up into Flarum...
    if (empty($user->id)) {
        // ...add details to Flarum user
        $flarum_user->attributes->username = $username;
        $flarum_user->attributes->email = Arr::get($users, "$username.email");
    }

    // Let's add to it some groups (optional, only for demonstation)
    // First, let's add the Groups addon (note that the Groups class is imported at the top with the use statement)
    $flarum->loadAddon(Groups::class);
    $flarum->setAddonAttributes(Groups::class, ['set_groups_admins' => env('SET_GROUPS_ADMINS') ?? true]);
    // Then, add the groups (as an array) to the correct attribute in user relationships
    $flarum_user->relationships->groups = ['Premium', 'Novice'];

    // Login the user with username. If user doesn't exists in Flarum, it will be created
    $success = $flarum_user->login();

    // Redirect to Flarum
    if (!empty($_GET['redirect'])) {
        $flarum->redirect();
    }
} elseif (!empty($username) || !empty($password)) {
    $success = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Lightweight CSS only to make this page beauty -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css"
          integrity="sha256-aPeK/N8IHpHsvPBCf49iVKMdusfobKo2oxF8lRruWJg=" crossorigin="anonymous">
</head>
<body class="container">
<div class="box" style="margin-top: 25px;">
    <h1 class="title">Login</h1>

    <div class="columns">
        <div class="column">
            <table class="table">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($users as $user => $details) {
                    echo "<tr>
                                <td>$user</td>
                                <td>" . Arr::get($details, 'password') . "</td>
                            </tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="column">
            <form method="post">
                <label class="label" for="username">Username</label>
                <input id="username" type="text" class="input" name="username" placeholder="Username">

                <label class="label mt-3" for="password">Password</label>
                <input id="password" type="password" class="input" name="password" placeholder="Password">

                <label class="checkbox mt-2 mb-2">
                    <input id="remember" name="remember" type="checkbox">
                    Remember me
                </label>

                <button class="button" type="submit" style="display: block; margin: 0 auto;">Login</button>
            </form>
        </div>
    </div>

    <?php if (isset($flarum) and !empty($success)) { ?>
        <div class="notification is-success">
            <button class="delete"></button>
            Successfully logged in! Click the button below to go to Flarum!
            <br>
            <a class="button is-rounded mt-5" href="<?php echo $flarum->url ?>"
               style="display: block; margin: 0 auto; width: max-content;">
                Go to Flarum
            </a>
            <details>
                <summary>User</summary>
                <pre style="margin: 16px 0;">
                    <?php
                    if ($flarum_user->fetchUser()) {
                        $is_admin = $flarum_user->isAdmin ? 'Yes' : 'No';
                        echo "User ID: $flarum_user->id<br>Is user admin? <b>$is_admin</b><br>User attributes: <br>";
                        var_export($flarum_user->getAttributes());
                        echo "<br>User relationships: <br>";
                        var_export($flarum_user->getRelationships());
                    } else {
                        echo "Can't fetch user from Flarum!";
                    }
                    ?>
                </pre>
            </details>
        </div>
    <?php } elseif (isset($success) and empty($success)) { ?>
        <div class="notification is-danger">
            <button class="delete"></button>
            Login failed
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

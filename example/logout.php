<?php

require_once __DIR__ . '/src/Flarum.php';

$forum = new Flarum('http://flarum.example.com', 'example.com', 'NotSecureToken', 'NotSecureToken');

// Logout current user
$forum->logout();

if ($_GET['forum']) {
    $forum->redirectToForum();
}

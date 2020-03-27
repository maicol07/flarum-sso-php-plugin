<?php

require_once __DIR__ . '/src/Flarum.php';

$forum = new Flarum('http://flarum.example.com', 'example.com', 'NotSecureToken', 'NotSecureToken');

// Delete a user
$forum->delete('username');

if ($_GET['forum']) {
	$forum->redirectToForum();
}

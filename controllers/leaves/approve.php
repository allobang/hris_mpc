<?php
session_start();

ensureLoggedIn();
requireRole('admin');

$config = require('config.php');
$db = new Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $config = require('config.php');
        $db = new Database($config['database']);

        // Update the status to 'Approved'
        $db->update('leave_requests', ['status' => 'Approved'], ['id' => $id]);

        header('Location: /leaves/manage');
        exit();
    }
}

abort(400); // Bad Request
?>
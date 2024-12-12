<?php
session_start();
require_once '../db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Include function files
require_once 'functions/club_info_functions.php';
require_once 'functions/carousel.php';
require_once 'functions/members.php';
require_once 'functions/projects.php';

// Determine which page to load
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($page) {
        case 'club_info':
            handle_club_info_update($conn);
            break;
        case 'carousel':
            handle_carousel_update($conn);
            break;
        case 'members':
            handle_member_update($conn);
            break;
        case 'projects':
            handle_project_update($conn);
            break;
    }
}

// Include the layout file
require_once 'views/layout.php';

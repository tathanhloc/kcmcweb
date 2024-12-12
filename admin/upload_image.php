<?php
require_once 'functions/club_info_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $result = handle_image_upload($_FILES['image']);
    echo $result;
}


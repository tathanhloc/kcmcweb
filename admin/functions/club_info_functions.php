<?php
require_once __DIR__ . '/../db_connect.php';

function get_club_info($conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM club_info WHERE id = 1");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $club_info = $result->fetch_assoc();
            $club_info['sections'] = json_decode($club_info['sections'], true);
            return $club_info;
        } else {
            return create_default_club_info($conn);
        }
    } catch (Exception $e) {
        error_log("Error in get_club_info: " . $e->getMessage());
        return false;
    }
}

function create_default_club_info($conn) {
    $default_data = [
        'club_name' => 'Your Club Name',
        'sections' => json_encode([
            [
                'title' => 'Welcome to our club',
                'content' => 'This is a default section. Please update with your club information.',
                'icon' => 'fas fa-users',
                'image' => ''
            ]
        ])
    ];

    try {
        $stmt = $conn->prepare("INSERT INTO club_info (club_name, sections) VALUES (?, ?)");
        $stmt->bind_param("ss", $default_data['club_name'], $default_data['sections']);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $default_data['sections'] = json_decode($default_data['sections'], true);
            return $default_data;
        } else {
            throw new Exception("Failed to create default club info");
        }
    } catch (Exception $e) {
        error_log("Error in create_default_club_info: " . $e->getMessage());
        return false;
    }
}

function update_club_info($conn, $data) {
    try {
        $stmt = $conn->prepare("UPDATE club_info SET club_name = ?, sections = ? WHERE id = 1");
        $sections_json = json_encode($data['sections']);
        $stmt->bind_param("ss", $data['club_name'], $sections_json);
        $stmt->execute();

        if ($stmt->affected_rows > 0 || $stmt->errno == 0) {
            return true;
        } else {
            throw new Exception("No rows updated or error occurred");
        }
    } catch (Exception $e) {
        error_log("Error in update_club_info: " . $e->getMessage());
        return false;
    }
}

function delete_club_info($conn) {
    try {
        $stmt = $conn->prepare("DELETE FROM club_info WHERE id = 1");
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            throw new Exception("No rows deleted or club info doesn't exist");
        }
    } catch (Exception $e) {
        error_log("Error in delete_club_info: " . $e->getMessage());
        return false;
    }
}

function handle_image_upload($file) {
    $target_dir = "../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return ["error" => "File is not an image."];
    }

    // Check file size (5MB max)
    if ($file["size"] > 5000000) {
        return ["error" => "Sorry, your file is too large. Max size is 5MB."];
    }

    // Allow certain file formats
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        return ["error" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."];
    }

    // Generate a unique filename
    $new_filename = uniqid() . "." . $imageFileType;
    $target_file = $target_dir . $new_filename;

    // Try to upload file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ["success" => "uploads/" . $new_filename];
    } else {
        return ["error" => "Sorry, there was an error uploading your file."];
    }
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


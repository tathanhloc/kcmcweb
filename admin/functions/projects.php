<?php
function handle_project_update($conn) {
    $name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $status = mysqli_real_escape_string($conn, $_POST['project_status']);
    $description = mysqli_real_escape_string($conn, $_POST['project_description']);
    $id = intval($_POST['project_id']);
    
    if ($id > 0) {
        $query = "UPDATE projects SET name = '$name', status = '$status', description = '$description' WHERE id = $id";
    } else {
        $query = "INSERT INTO projects (name, status, description) VALUES ('$name', '$status', '$description')";
    }
    mysqli_query($conn, $query);
}

function get_projects($conn) {
    return mysqli_query($conn, "SELECT * FROM projects");
}

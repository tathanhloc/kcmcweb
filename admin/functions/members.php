<?php
function handle_member_update($conn) {
    $name = mysqli_real_escape_string($conn, $_POST['member_name']);
    $role = mysqli_real_escape_string($conn, $_POST['member_role']);
    $id = intval($_POST['member_id']);
    
    if ($id > 0) {
        $query = "UPDATE members SET name = '$name', role = '$role' WHERE id = $id";
    } else {
        $query = "INSERT INTO members (name, role) VALUES ('$name', '$role')";
    }
    mysqli_query($conn, $query);
}

function get_members($conn) {
    return mysqli_query($conn, "SELECT * FROM members");
}

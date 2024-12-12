<?php
function handle_carousel_update($conn) {
    if (isset($_FILES['carousel_image'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["carousel_image"]["name"]);
        if (move_uploaded_file($_FILES["carousel_image"]["tmp_name"], $target_file)) {
            $image_path = mysqli_real_escape_string($conn, $target_file);
            $query = "INSERT INTO carousel_images (image_path) VALUES ('$image_path')";
            mysqli_query($conn, $query);
        }
    }
}

function get_carousel_images($conn) {
    return mysqli_query($conn, "SELECT * FROM carousel_images");
}

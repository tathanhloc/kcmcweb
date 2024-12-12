<?php
function handle_club_info_update($conn) {
    $club_name = mysqli_real_escape_string($conn, $_POST['club_name']);
    
    $sections = [];
    $section_titles = $_POST['section_title'];
    $section_contents = $_POST['section_content'];
    
    for ($i = 0; $i < count($section_titles); $i++) {
        $title = mysqli_real_escape_string($conn, $section_titles[$i]);
        $content = mysqli_real_escape_string($conn, $section_contents[$i]);
        $image = '';

        if (isset($_FILES['section_image']['name'][$i]) && $_FILES['section_image']['name'][$i] != '') {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["section_image"]["name"][$i]);
            if (move_uploaded_file($_FILES["section_image"]["tmp_name"][$i], $target_file)) {
                $image = $target_file;
            }
        } elseif (isset($_POST['existing_image'][$i])) {
            $image = $_POST['existing_image'][$i];
        }

        $sections[] = [
            'title' => $title,
            'content' => $content,
            'image' => $image
        ];
    }

    $sections_json = mysqli_real_escape_string($conn, json_encode($sections));
    
    $query = "UPDATE club_info SET club_name = '$club_name', sections = '$sections_json' WHERE id = 1";
    mysqli_query($conn, $query);
}

function get_club_info($conn) {
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM club_info WHERE id = 1"));
}


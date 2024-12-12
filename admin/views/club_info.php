<?php
require_once __DIR__ . '../db_connect.php';
require_once __DIR__ . '/../club_info_functions.php';

$error_message = '';
$success_message = '';

$club_info = get_club_info($conn);
if ($club_info === false) {
    $error_message = "Error retrieving club information. Please try again.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update':
                $new_data = [
                    'club_name' => sanitize_input($_POST['club_name']),
                    'sections' => []
                ];
                foreach ($_POST['section_title'] as $key => $title) {
                    $image = $_POST['existing_image'][$key];
                    if (isset($_FILES['section_image']['name'][$key]) && $_FILES['section_image']['name'][$key] !== '') {
                        $upload_result = handle_image_upload($_FILES['section_image'][$key]);
                        if (isset($upload_result['success'])) {
                            $image = $upload_result['success'];
                        } else {
                            $error_message = $upload_result['error'];
                        }
                    }
                    $new_data['sections'][] = [
                        'title' => sanitize_input($title),
                        'content' => sanitize_input($_POST['section_content'][$key]),
                        'icon' => sanitize_input($_POST['section_icon'][$key]),
                        'image' => $image
                    ];
                }
                if (update_club_info($conn, $new_data)) {
                    $success_message = "Club information updated successfully.";
                    $club_info = get_club_info($conn);
                } else {
                    $error_message = "Error updating club information. Please try again.";
                }
                break;
            case 'delete':
                if (delete_club_info($conn)) {
                    $success_message = "Club information deleted successfully.";
                    $club_info = get_club_info($conn);
                } else {
                    $error_message = "Error deleting club information. Please try again.";
                }
                break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thông tin CLB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .preview-section {
            background-color: #f8f9fa;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .icon-preview {
            font-size: 2rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Quản lý Thông tin CLB</h1>
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="update">
            <div class="mb-3">
                <label for="club_name" class="form-label">Tên CLB</label>
                <input type="text" class="form-control" id="club_name" name="club_name" value="<?php echo htmlspecialchars($club_info['club_name']); ?>" required>
            </div>
            
            <div id="sections">
                <?php foreach ($club_info['sections'] as $index => $section): ?>
                    <div class="section-form mb-4 border p-3">
                        <h3>Phần <?php echo $index + 1; ?></h3>
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" name="section_title[]" value="<?php echo htmlspecialchars($section['title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-control" name="section_content[]" rows="3" required><?php echo htmlspecialchars($section['content']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <select class="form-control icon-select" name="section_icon[]" required>
                                <option value="fas fa-users" <?php echo ($section['icon'] == 'fas fa-users') ? 'selected' : ''; ?>>Users</option>
                                <option value="fas fa-bullseye" <?php echo ($section['icon'] == 'fas fa-bullseye') ? 'selected' : ''; ?>>Bullseye</option>
                                <option value="fas fa-calendar-alt" <?php echo ($section['icon'] == 'fas fa-calendar-alt') ? 'selected' : ''; ?>>Calendar</option>
                                <option value="fas fa-code" <?php echo ($section['icon'] == 'fas fa-code') ? 'selected' : ''; ?>>Code</option>
                                <option value="fas fa-laptop" <?php echo ($section['icon'] == 'fas fa-laptop') ? 'selected' : ''; ?>>Laptop</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="section_image[]" accept="image/*">
                            <?php if (!empty($section['image'])): ?>
                                <img src="../<?php echo htmlspecialchars($section['image']); ?>" alt="Section image" style="max-width: 200px; margin-top: 10px;">
                            <?php endif; ?>
                            <input type="hidden" name="existing_image[]" value="<?php echo htmlspecialchars($section['image']); ?>">
                        </div>
                        <button type="button" class="btn btn-danger remove-section">Xóa phần này</button>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button type="button" id="add_section" class="btn btn-secondary mb-3">Thêm phần mới</button>
            <button type="submit" class="btn btn-primary">Cập nhật thông tin CLB</button>
        </form>
        
        <form method="POST" class="mt-3" onsubmit="return confirm('Bạn có chắc chắn muốn xóa toàn bộ thông tin CLB?');">
            <input type="hidden" name="action" value="delete">
            <button type="submit" class="btn btn-danger">Xóa toàn bộ thông tin CLB</button>
        </form>

        <div class="preview-section mt-5">
            <h2 class="mb-4">Xem trước: Giới Thiệu Câu Lạc Bộ</h2>
            <div id="preview-content"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            let sectionCount = <?php echo count($club_info['sections']); ?>;

            $('#add_section').click(function() {
                sectionCount++;
                const newSection = `
                    <div class="section-form mb-4 border p-3">
                        <h3>Phần ${sectionCount}</h3>
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" name="section_title[]" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-control" name="section_content[]" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <select class="form-control icon-select" name="section_icon[]" required>
                                <option value="fas fa-users">Users</option>
                                <option value="fas fa-bullseye">Bullseye</option>
                                <option value="fas fa-calendar-alt">Calendar</option>
                                <option value="fas fa-code">Code</option>
                                <option value="fas fa-laptop">Laptop</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="section_image[]" accept="image/*">
                        </div>
                        <button type="button" class="btn btn-danger remove-section">Xóa phần này</button>
                    </div>
                `;
                $('#sections').append(newSection);
                updatePreview();
            });

            $(document).on('click', '.remove-section', function() {
                $(this).closest('.section-form').remove();
                updatePreview();
            });

            function updatePreview() {
                let previewHtml = '';
                $('.section-form').each(function(index) {
                    const title = $(this).find('input[name="section_title[]"]').val();
                    const content = $(this).find('textarea[name="section_content[]"]').val();
                    const icon = $(this).find('select[name="section_icon[]"]').val();
                    const imageInput = $(this).find('input[name="section_image[]"]')[0];
                    const existingImage = $(this).find('input[name="existing_image[]"]').val();
                    const image = imageInput.files.length > 0 ? URL.createObjectURL(imageInput.files[0]) : (existingImage ? '../' + existingImage : '');

                    previewHtml += `
                        <div class="section mb-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="icon-preview">
                                        <i class="${icon}"></i>
                                    </div>
                                    <h3>${title}</h3>
                                    <p>${content}</p>
                                </div>
                                <div class="col-md-6">
                                    <img src="${image}" alt="${title}" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    `;
                });
                $('#preview-content').html(previewHtml);
            }

            $(document).on('input change', '.section-form input, .section-form textarea, .section-form select', updatePreview);
            $(document).on('change', '.section-form input[type="file"]', updatePreview);

            updatePreview();
        });
    </script>
</body>
</html>


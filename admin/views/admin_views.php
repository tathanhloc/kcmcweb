<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - CLB Truyền Thông và Máy Tính</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../admin_logout.php">Đăng xuất</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="mb-4">Quản lý Trang Web CLB</h1>

        <!-- Club Info Section -->
        <section class="mb-5">
            <h2>Thông tin CLB</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="club_name" class="form-label">Tên CLB</label>
                    <input type="text" class="form-control" id="club_name" name="club_name" value="<?php echo $club_info['club_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="club_description" class="form-label">Giới thiệu CLB</label>
                    <textarea class="form-control" id="club_description" name="club_description" rows="3" required><?php echo $club_info['club_description']; ?></textarea>
                </div>
                <button type="submit" name="update_club_info" class="btn btn-primary">Cập nhật thông tin CLB</button>
            </form>
        </section>

        <!-- Carousel Section -->
        <section class="mb-5">
            <h2>Quản lý Carousel</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="carousel_image" class="form-label">Thêm ảnh mới</label>
                    <input type="file" class="form-control" id="carousel_image" name="carousel_image" accept="image/*" required>
                </div>
                <button type="submit" name="update_carousel" class="btn btn-primary">Thêm ảnh Carousel</button>
            </form>
            <div class="mt-3">
                <h3>Ảnh hiện tại</h3>
                <div class="row">
                    <?php while ($image = mysqli_fetch_assoc($carousel_images)) : ?>
                        <div class="col-md-4 mb-3">
                            <img src="<?php echo $image['image_path']; ?>" class="img-fluid" alt="Carousel Image">
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>

        <!-- Members Section -->
        <section class="mb-5">
            <h2>Quản lý Thành viên</h2>
            <form method="POST">
                <input type="hidden" name="member_id" value="0">
                <div class="mb-3">
                    <label for="member_name" class="form-label">Tên thành viên</label>
                    <input type="text" class="form-control" id="member_name" name="member_name" required>
                </div>
                <div class="mb-3">
                    <label for="member_role" class="form-label">Vai trò</label>
                    <input type="text" class="form-control" id="member_role" name="member_role" required>
                </div>
                <button type="submit" name="update_member" class="btn btn-primary">Thêm/Cập nhật thành viên</button>
            </form>
            <div class="mt-3">
                <h3>Danh sách thành viên</h3>
                <ul class="list-group">
                    <?php while ($member = mysqli_fetch_assoc($members)) : ?>
                        <li class="list-group-item">
                            <?php echo $member['name']; ?> - <?php echo $member['role']; ?>
                            <button class="btn btn-sm btn-warning float-end" onclick="editMember(<?php echo $member['id']; ?>, '<?php echo $member['name']; ?>', '<?php echo $member['role']; ?>')">Sửa</button>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </section>

        <!-- Projects Section -->
        <section class="mb-5">
            <h2>Quản lý Dự án</h2>
            <form method="POST">
                <input type="hidden" name="project_id" value="0">
                <div class="mb-3">
                    <label for="project_name" class="form-label">Tên dự án</label>
                    <input type="text" class="form-control" id="project_name" name="project_name" required>
                </div>
                <div class="mb-3">
                    <label for="project_status" class="form-label">Trạng thái</label>
                    <select class="form-control" id="project_status" name="project_status" required>
                        <option value="Hoàn thành">Hoàn thành</option>
                        <option value="Đang tiến hành">Đang tiến hành</option>
                        <option value="Sắp triển khai">Sắp triển khai</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="project_description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="project_description" name="project_description" rows="3" required></textarea>
                </div>
                <button type="submit" name="update_project" class="btn btn-primary">Thêm/Cập nhật dự án</button>
            </form>
            <div class="mt-3">
                <h3>Danh sách dự án</h3>
                <ul class="list-group">
                    <?php while ($project = mysqli_fetch_assoc($projects)) : ?>
                        <li class="list-group-item">
                            <strong><?php echo $project['name']; ?></strong> - <?php echo $project['status']; ?>
                            <p><?php echo $project['description']; ?></p>
                            <button class="btn btn-sm btn-warning" onclick="editProject(<?php echo $project['id']; ?>, '<?php echo $project['name']; ?>', '<?php echo $project['status']; ?>', '<?php echo $project['description']; ?>')">Sửa</button>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editMember(id, name, role) {
            document.querySelector('input[name="member_id"]').value = id;
            document.querySelector('input[name="member_name"]').value = name;
            document.querySelector('input[name="member_role"]').value = role;
        }

        function editProject(id, name, status, description) {
            document.querySelector('input[name="project_id"]').value = id;
            document.querySelector('input[name="project_name"]').value = name;
            document.querySelector('select[name="project_status"]').value = status;
            document.querySelector('textarea[name="project_description"]').value = description;
        }
    </script>
</body>
</html>


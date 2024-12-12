<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - CLB Truyền Thông và Máy Tính</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="bi bi-shield-lock"></i></a>
            <a class="navbar-brand" href="../index.php"><i class="bi bi-house-fill"></i></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page == 'dashboard' ? 'active' : ''; ?>" href="index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page == 'club_info' ? 'active' : ''; ?>" href="index.php?page=club_info">Thông tin CLB</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page == 'carousel' ? 'active' : ''; ?>" href="index.php?page=carousel">Carousel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page == 'members' ? 'active' : ''; ?>" href="index.php?page=members">Thành viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $page == 'projects' ? 'active' : ''; ?>" href="index.php?page=projects">Dự án</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/admin_logout.php">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php
        switch ($page) {
            case 'dashboard':
                include 'views/dashboard.php';
                break;
            case 'club_info':
                include 'views/club_info.php';
                break;
            case 'carousel':
                include 'views/carousel.php';
                break;
            case 'members':
                include 'views/members.php';
                break;
            case 'projects':
                include 'views/projects.php';
                break;
            default:
                echo "<h1>404 - Trang không tồn tại</h1>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

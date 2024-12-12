<h1 class="mb-4">Dashboard</h1>
<p>Chào mừng đến với trang quản trị của CLB Truyền Thông và Máy Tính.</p>
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Thành viên</h5>
                <p class="card-text">Số lượng: <?php echo mysqli_num_rows(get_members($conn)); ?></p>
                <a href="index.php?page=members" class="btn btn-primary">Quản lý</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Dự án</h5>
                <p class="card-text">Số lượng: <?php echo mysqli_num_rows(get_projects($conn)); ?></p>
                <a href="index.php?page=projects" class="btn btn-primary">Quản lý</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ảnh Carousel</h5>
                <p class="card-text">Số lượng: <?php echo mysqli_num_rows(get_carousel_images($conn)); ?></p>
                <a href="index.php?page=carousel" class="btn btn-primary">Quản lý</a>
            </div>
        </div>
    </div>
</div>


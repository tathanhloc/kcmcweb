<h1 class="mb-4">Quản lý Carousel</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="carousel_image" class="form-label">Thêm ảnh mới</label>
        <input type="file" class="form-control" id="carousel_image" name="carousel_image" accept="image/*" required>
    </div>
    <button type="submit" name="update_carousel" class="btn btn-primary">Thêm ảnh Carousel</button>
</form>
<div class="mt-4">
    <h2>Ảnh hiện tại</h2>
    <div class="row">
        <?php
        $carousel_images = get_carousel_images($conn);
        while ($image = mysqli_fetch_assoc($carousel_images)) : ?>
            <div class="col-md-4 mb-3">
                <img src="<?php echo $image['image_path']; ?>" class="img-fluid" alt="Carousel Image">
                <form method="POST" class="mt-2">
                    <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                    <button type="submit" name="delete_carousel_image" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</div>

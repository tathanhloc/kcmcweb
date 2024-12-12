<section id="projects" class="section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="display-4 fw-bold mb-3" data-aos="fade-up">Dự Án Của Chúng Tôi</h2>
                <div class="divider mx-auto" data-aos="fade-up" data-aos-delay="100"></div>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $projects = [
                [
                    'name' => 'Website Trường Đại học',
                    'status' => 'Hoàn thành',
                    'description' => 'Xây dựng website mới cho trường đại học với giao diện hiện đại và tối ưu SEO.',
                    'icon' => 'bi-globe'
                ],
                [
                    'name' => 'Ứng dụng Di động Quản lý Học tập',
                    'status' => 'Đang tiến hành',
                    'description' => 'Phát triển ứng dụng di động giúp sinh viên quản lý thời gian biểu và học tập hiệu quả.',
                    'icon' => 'bi-phone'
                ],
                [
                    'name' => 'Hệ thống IoT cho Smart Campus',
                    'status' => 'Sắp triển khai',
                    'description' => 'Xây dựng hệ thống IoT để biến khuôn viên trường thành môi trường thông minh và tiết kiệm năng lượng.',
                    'icon' => 'bi-cpu'
                ],
            ];

            foreach ($projects as $index => $project) {
                $statusClass = match($project['status']) {
                    'Hoàn thành' => 'success',
                    'Đang tiến hành' => 'warning',
                    default => 'info'
                };
                ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                    <div class="card h-100 border-0 shadow-sm hover-card">
                        <div class="card-body p-4">
                            <div class="icon-box mb-3">
                                <i class="bi <?= $project['icon'] ?> fs-2 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3"><?= htmlspecialchars($project['name']) ?></h5>
                            <span class="badge bg-<?= $statusClass ?> mb-3"><?= htmlspecialchars($project['status']) ?></span>
                            <p class="card-text text-muted"><?= htmlspecialchars($project['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<style>
.hover-card {
    transition: transform 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
}

.divider {
    width: 50px;
    height: 3px;
    background: var(--bs-primary);
    margin-bottom: 30px;
}

.icon-box {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(var(--bs-primary-rgb), 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
}
</style>

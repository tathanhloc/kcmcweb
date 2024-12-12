<?php
// Trong tương lai, dữ liệu này sẽ được lấy từ cơ sở dữ liệu
$sections = [
    [
        'title' => 'Câu lạc bộ Truyền thông và Máy tính',
        'content' => 'Câu lạc bộ Truyền thông và Máy tính là nơi quy tụ những sinh viên đam mê công nghệ, sáng tạo và truyền thông. Chúng tôi tạo ra một môi trường học tập và phát triển kỹ năng thông qua các dự án thực tế và sự kiện hấp dẫn.',
        'image' => 'https://picsum.photos/1200/800?random=1',
        'icon' => 'fas fa-users'
    ],
    [
        'title' => 'Sứ mệnh của chúng tôi',
        'content' => 'Chúng tôi cam kết tạo ra một cộng đồng nơi sinh viên có thể phát triển kỹ năng, chia sẻ kiến thức và xây dựng mạng lưới quan hệ trong lĩnh vực công nghệ và truyền thông.',
        'image' => 'https://picsum.photos/1200/800?random=2',
        'icon' => 'fas fa-bullseye'
    ],
    [
        'title' => 'Các hoạt động',
        'content' => 'Từ các buổi hội thảo chuyên môn đến các dự án thực tế, chúng tôi cung cấp nhiều cơ hội để sinh viên trau dồi kỹ năng và kinh nghiệm trong lĩnh vực công nghệ và truyền thông.',
        'image' => 'https://picsum.photos/1200/800?random=3',
        'icon' => 'fas fa-calendar-alt'
    ]
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu Câu Lạc Bộ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .section {
            min-height: 10vh;
            display: flex;
            align-items: center;
            padding: 100px 0;
        }
        .section:nth-child(even) .row {
            flex-direction: row-reverse;
        }
        .content-wrapper {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .image-wrapper {
            opacity: 0;
            transform: translateY(50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .content-wrapper.show, .image-wrapper.show {
            opacity: 1;
            transform: translateY(0);
        }
        .icon-box {
            display: inline-block;
            padding: 20px;
            background-color: rgba(0, 123, 255, 0.1);
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <section id="about">
        <div class="container"><br><br>
            <h1 class="text-center mb-5 display-2 fw-bold">Giới Thiệu Câu Lạc Bộ</h1>
            <?php foreach ($sections as $index => $section): ?>
                <div class="section" id="section-<?php echo $index; ?>">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="content-wrapper">
                                <div class="icon-box">
                                    <i class="<?php echo $section['icon']; ?> fa-3x text-primary"></i>
                                </div>
                                <h3 class="text-primary"><?php echo $section['title']; ?></h3>
                                <p class="lead"><?php echo $section['content']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="image-wrapper">
                                <img src="<?php echo $section['image']; ?>" alt="<?php echo $section['title']; ?>" class="img-fluid rounded shadow-lg">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('.section');
            const options = {
                root: null,
                rootMargin: '0px',
                threshold: 0.3
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const contentWrapper = entry.target.querySelector('.content-wrapper');
                        const imageWrapper = entry.target.querySelector('.image-wrapper');
                        if (contentWrapper) contentWrapper.classList.add('show');
                        if (imageWrapper) imageWrapper.classList.add('show');
                    }
                });
            }, options);

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</body>
</html>


<?php
$members = [
    [
        'name' => 'Nguyễn Văn A',
        'role' => 'Chủ nhiệm CLB',
        'bg_image' => 'assets/images/bg-pattern-1.svg',
        'profile_image' => 'assets/images/member1-nobg.png',
        'quote' => 'Sáng tạo là chìa khóa để mở ra tương lai',
        'color' => '#4A90E2'
    ],
    [
        'name' => 'Trần Thị B',
        'role' => 'Phó chủ nhiệm',
        'bg_image' => 'assets/images/bg-pattern-2.svg',
        'profile_image' => 'assets/images/member2-nobg.png',
        'quote' => 'Đam mê là động lực để vượt qua mọi thử thách',
        'color' => '#50E3C2'
    ],
    [
        'name' => 'Lê Văn C',
        'role' => 'Trưởng ban Truyền thông',
        'bg_image' => 'assets/images/bg-pattern-3.svg',
        'profile_image' => 'assets/images/member3-nobg.png',
        'quote' => 'Kết nối là sức mạnh của cộng đồng',
        'color' => '#F5A623'
    ],
    [
        'name' => 'Phạm Thị D',
        'role' => 'Trưởng ban Kỹ thuật',
        'bg_image' => 'assets/images/bg-pattern-4.svg',
        'profile_image' => 'assets/images/member4-nobg.png',
        'quote' => 'Công nghệ là nền tảng của sự phát triển',
        'color' => '#D0021B'
    ]
];
?>

<section id="members" class="members-container">
    <h2 class="section-title">Thành Viên Ban Chủ Nhiệm</h2>
    <div class="members-grid">
        <?php foreach ($members as $member): ?>
            <div class="member-card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="member-image-wrap">
                            <img src="<?php echo $member['profile_image']; ?>" alt="<?php echo $member['name']; ?>">
                        </div>
                        <h3><?php echo $member['name']; ?></h3>
                        <p class="role"><?php echo $member['role']; ?></p>
                    </div>
                    <div class="card-back" style="background-color: <?php echo $member['color']; ?>">
                        <div class="quote-content">
                            <i class="fas fa-quote-left"></i>
                            <p><?php echo $member['quote']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<style>
.members-container {
    padding: 4rem 2rem;
    background: #f5f5f5;
}

.section-title {
    text-align: center;
    margin-bottom: 3rem;
    color: #333;
    font-size: 2.5rem;
}

.members-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.member-card {
    perspective: 1000px;
    height: 400px;
}

.card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    cursor: pointer;
}

.member-card:hover .card-inner {
    transform: rotateY(180deg);
}

.card-front, .card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.card-front {
    background: white;
    padding: 20px;
    text-align: center;
}

.member-image-wrap {
    width: 200px;
    height: 200px;
    margin: 0 auto 20px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #f0f0f0;
}

.member-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card-front h3 {
    color: #333;
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.card-front .role {
    color: #666;
    font-size: 1rem;
}

.card-back {
    transform: rotateY(180deg);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
    color: white;
}

.quote-content {
    text-align: center;
}

.quote-content i {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.quote-content p {
    font-size: 1.2rem;
    font-style: italic;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .members-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    .member-card {
        height: 350px;
    }
}
</style>

<!-- Add Font Awesome for quote icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Matrix | تطوير البرمجيات والحلول الرقمية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;900&family=Orbitron:wght@400;700;900&family=IBM+Plex+Sans+Arabic:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>        
        :root {
            --primary: #00f3ff; 
            --primary-glow: rgba(0, 243, 255, 0.4);
            --primary-dim: rgba(0, 243, 255, 0.1);
            --bg-body: #0a0a0f;
            --bg-card: rgba(255, 255, 255, 0.02);
            --text-main: #ffffff;
            --text-dim: #9ca3af;
            --border-color: rgba(255, 255, 255, 0.08);
            --shadow-glow: 0 0 40px rgba(0, 243, 255, 0.15);
        }

        [data-theme="light"] {
            --primary: #0088ff;
            --primary-glow: rgba(0, 136, 255, 0.3);
            --primary-dim: rgba(0, 136, 255, 0.08);
            --bg-body: #f8f9fa;
            --bg-card: rgba(255, 255, 255, 0.95);
            --text-main: #1a1a1a;
            --text-dim: #6b7280;
            --border-color: rgba(0, 0, 0, 0.08);
            --shadow-glow: 0 0 30px rgba(0, 136, 255, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'IBM Plex Sans Arabic', 'Tajawal', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            line-height: 1.7;
        }

        .tech-font {
            font-family: 'Orbitron', monospace;
        }

        /* ========== SCROLLBAR ========== */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-body);
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--primary), var(--primary-glow));
            border-radius: 10px;
        }

        /* ========== BACKGROUND LAYERS ========== */
        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        #matrix-bg {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0.15;
            transition: opacity 0.5s;
        }

        [data-theme="light"] #matrix-bg {
            opacity: 0.04;
        }

        #three-bg {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0.5;
        }

        [data-theme="light"] #three-bg {
            opacity: 0.2;
        }

        /* ========== NAVBAR ========== */
        .navbar {
            background: rgba(10, 10, 15, 0.85);
            backdrop-filter: blur(30px) saturate(180%);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
        }

        [data-theme="light"] .navbar {
            background: rgba(255, 255, 255, 0.85);
        }

        .navbar.scrolled {
            padding: 0.5rem 0;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            font-family: 'Orbitron', monospace;
            font-weight: 900;
            font-size: 1.75rem;
            letter-spacing: 3px;
            color: var(--text-main) !important;
            text-shadow: 0 0 20px var(--primary-glow);
            transition: all 0.3s;
        }

        .navbar-brand:hover {
            text-shadow: 0 0 35px var(--primary);
            transform: scale(1.02);
        }

        .navbar-brand span {
            color: var(--primary);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .nav-link {
            color: var(--text-main) !important;
            font-weight: 600;
            margin: 0 0.75rem;
            padding: 0.5rem 0 !important;
            position: relative;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 50%;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: all 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: all 0.3s;
        }

        .nav-link:hover::before,
        .nav-link:hover::after {
            width: 50%;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        /* ========== BUTTONS ========== */
        .btn-custom {
            background: linear-gradient(135deg, var(--primary-dim) 0%, rgba(0, 243, 255, 0.05) 100%);
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 0.875rem 2.5rem;
            font-weight: 700;
            border-radius: 0;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 0.875rem;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, rgba(0, 243, 255, 0.8) 100%);
            z-index: -1;
            transition: 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: skewX(-15deg);
        }

        .btn-custom:hover {
            color: var(--bg-body) !important;
            border-color: var(--primary);
            box-shadow: var(--shadow-glow);
            transform: translateY(-3px);
        }

        .btn-custom:hover::before {
            left: 0;
        }

        .btn-outline-custom {
            background: transparent;
            border: 2px solid var(--text-dim);
            color: var(--text-main);
            padding: 0.875rem 2.5rem;
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 0;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-dim);
            transform: translateY(-3px);
        }

        /* ========== CARDS ========== */
        .service-card,
        .service-box,
        .pricing-card,
        .project-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 1.25rem;
            padding: 2.5rem 2rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(20px);
        }

        .service-card::before,
        .service-box::before,
        .pricing-card::before,
        .project-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, var(--primary) 0%, transparent 50%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s;
            z-index: -1;
            border-radius: inherit;
        }

        .service-card:hover::before,
        .service-box:hover::before,
        .pricing-card:hover::before,
        .project-card:hover::before {
            opacity: 0.1;
        }

        .service-card:hover,
        .service-box:hover,
        .pricing-card:hover,
        .project-card:hover {
            transform: translateY(-12px);
            border-color: var(--primary);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.2),
                        var(--shadow-glow);
        }

        .card-icon,
        .service-icon {
            font-size: 3.5rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            transition: all 0.4s;
            display: inline-block;
            filter: drop-shadow(0 0 20px var(--primary-glow));
        }

        .service-card:hover .card-icon,
        .service-box:hover .service-icon {
            transform: scale(1.2) rotate(12deg);
            filter: drop-shadow(0 0 35px var(--primary));
        }

        /* ========== PROJECT CARDS ========== */
        .project-card {
            padding: 0;
            margin-bottom: 2rem;
        }

        .project-img {
            height: 280px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            position: relative;
            overflow: hidden;
            border-radius: 1.25rem 1.25rem 0 0;
        }

        .project-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.7s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: grayscale(30%) brightness(0.9);
        }

        .project-card:hover .project-img img {
            transform: scale(1.15);
            filter: grayscale(0%) brightness(1);
        }

        .project-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 243, 255, 0.95) 0%, rgba(0, 150, 200, 0.85) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s;
        }

        .project-card:hover .project-overlay {
            opacity: 1;
        }

        .project-overlay .btn-custom {
            border-radius: 50%;
            padding: 1rem;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ========== FILTER BUTTONS ========== */
        .filter-btn {
            background: transparent;
            border: 2px solid var(--border-color);
            color: var(--text-dim);
            padding: 0.625rem 1.5rem;
            border-radius: 2rem;
            margin: 0 0.375rem 0.75rem;
            transition: all 0.3s;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .filter-btn.active,
        .filter-btn:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: var(--primary-dim);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--primary-glow);
        }

        /* ========== PRICING ========== */
        .pricing-card {
            text-align: center;
            padding: 3rem 2rem;
        }

        .pricing-card.featured {
            border-color: var(--primary);
            background: linear-gradient(135deg, var(--primary-dim) 0%, var(--bg-card) 100%);
            transform: scale(1.05);
        }

        .price-tag {
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--primary);
            margin: 1.5rem 0;
            font-family: 'Orbitron', monospace;
            text-shadow: 0 0 25px var(--primary-glow);
        }

        /* ========== TEAM ========== */
        .team-member {
            text-align: center;
            padding: 2rem;
            transition: all 0.3s;
        }

        .team-img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 4px solid var(--primary);
            margin-bottom: 1.5rem;
            transition: all 0.4s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            object-fit: cover;
        }

        .team-member:hover .team-img {
            transform: scale(1.12) rotate(8deg);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.3),
                        var(--shadow-glow);
        }

        /* ========== CONTACT FORM ========== */
        .contact-form {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            padding: 3rem;
            border-radius: 1.25rem;
            backdrop-filter: blur(20px);
        }

        .form-control {
            background: rgba(0, 0, 0, 0.3);
            border: 2px solid var(--border-color);
            color: var(--text-main);
            border-radius: 0.75rem;
            padding: 1rem 1.25rem;
            transition: all 0.3s;
        }

        [data-theme="light"] .form-control {
            background: rgba(255, 255, 255, 0.8);
        }

        .form-control:focus {
            background: rgba(0, 0, 0, 0.5);
            border-color: var(--primary);
            color: var(--text-main);
            box-shadow: 0 0 20px var(--primary-glow);
            transform: translateY(-2px);
        }

        [data-theme="light"] .form-control:focus {
            background: rgba(255, 255, 255, 1);
        }

        .form-control::placeholder {
            color: var(--text-dim);
            opacity: 0.7;
        }

        .info-box {
            margin-bottom: 2rem;
            display: flex;
            align-items: start;
            transition: all 0.3s;
            padding: 1.25rem;
            border-radius: 0.75rem;
        }

        .info-box:hover {
            background: var(--bg-card);
            transform: translateX(-10px);
        }

        .info-icon {
            width: 60px;
            height: 60px;
            border: 2px solid var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-left: 1.5rem;
            font-size: 1.5rem;
            transition: all 0.3s;
            box-shadow: var(--shadow-glow);
        }

        .info-box:hover .info-icon {
            transform: rotate(360deg) scale(1.15);
            box-shadow: 0 0 35px var(--primary);
        }

        .map-container {
            height: 350px;
            width: 100%;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            border: 2px solid var(--border-color);
            border-radius: 1.25rem;
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--text-dim);
            transition: all 0.3s;
        }

        .map-container:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-glow);
        }

        /* ========== TIMELINE ========== */
        .timeline-item {
            padding: 1.5rem 0;
            border-right: 3px solid var(--border-color);
            padding-right: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }

        .timeline-item:hover {
            border-right-color: var(--primary);
            transform: translateX(-10px);
        }

        /* ========== CONTROLS ========== */
        .controls-wrapper {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .control-btn {
            width: 56px;
            height: 56px;
            background: var(--bg-body);
            border: 2px solid var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3),
                        var(--shadow-glow);
            color: var(--primary);
            font-size: 1.375rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .control-btn:hover {
            transform: scale(1.15) rotate(10deg);
            background: var(--primary);
            color: var(--bg-body);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.4),
                        0 0 50px var(--primary);
        }

        #colorPickerInput {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        /* ========== HERO SECTION ========== */
        #home {
            background: radial-gradient(ellipse at center, var(--primary-dim) 0%, transparent 70%);
            position: relative;
        }

        #home h1 {
            animation: fadeInUp 1s ease;
        }

        #home p {
            animation: fadeInUp 1.2s ease;
        }

        #home .btn-custom {
            animation: fadeInUp 1.4s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========== SECTION TITLES ========== */
        .display-4 {
            font-weight: 900;
            background: linear-gradient(135deg, var(--text-main) 0%, var(--primary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ========== FOOTER ========== */
        footer {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
        }

        footer a {
            transition: all 0.3s;
        }

        footer a:hover {
            color: var(--primary) !important;
            transform: translateY(-3px);
        }

        /* ========== RESPONSIVE ========== */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .display-1 {
                font-size: 2.5rem !important;
            }

            .display-4 {
                font-size: 2rem !important;
            }

            .controls-wrapper {
                bottom: 1.25rem;
                right: 1.25rem;
            }

            .control-btn {
                width: 48px;
                height: 48px;
                font-size: 1.125rem;
            }

            .contact-form {
                padding: 2rem 1.5rem;
            }

            .timeline-item {
                border-right: none;
                border-bottom: 2px solid var(--border-color);
                padding-right: 0;
                padding-bottom: 1.25rem;
            }

            .price-tag {
                font-size: 2.75rem;
            }
        }

        /* ========== SMOOTH SCROLL ========== */
        html {
            scroll-behavior: smooth;
        }

        /* ========== SELECTION ========== */
        ::selection {
            background: var(--primary);
            color: var(--bg-body);
        }

        /* ========== FADE IN ========== */
        .fade-in {
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>

</head>
<body data-theme="dark">
    
    <!-- ========== CANVAS CONTAINER ========== -->
    <div id="canvas-container">
        <canvas id="matrix-bg"></canvas>
        <div id="three-bg"></div>
    </div>

    <!-- ========== CONTROLS ========== -->
    <div class="controls-wrapper">
        <div class="control-btn" id="themeToggle" title="تبديل الوضع (ليلي/نهاري)">
            <i class="fas fa-sun"></i>
        </div>
        <div class="control-btn" title="تغيير اللون الأساسي">
            <i class="fas fa-palette"></i>
            <input type="color" id="colorPickerInput" value="#00f3ff">
        </div>
    </div>
    
    <!-- ========== NAVBAR ========== -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#home">DIGITAL <span>MATRIX</span></a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="color: var(--primary);">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#home">الرئيسية</a></li>
                    <li class="nav-item"><a class="nav-link" href="#projects">المشاريع</a></li>
                    <li class="nav-item"><a class="nav-link" href="#media-achievements">التسويق الاليكترونى</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">الخدمات</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">فريقنا</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">عن الشركة</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">تواصل معنا</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- ========== HERO SECTION ========== -->
    <section id="home" class="d-flex align-items-center min-vh-100 position-relative">
        <div class="container text-center position-relative" style="z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h5 class="tech-font text-uppercase mb-3" style="color: var(--primary); letter-spacing: 5px;">Welcome to the System</h5>
                    <h1 class="display-1 fw-black mb-4" style="font-weight: 900; text-shadow: 0 0 40px var(--primary-glow);">
                        نبني مستقبلك <br> <span style="color: var(--primary);">الرقمي</span>
                    </h1>
                    <p class="lead mb-5 mx-auto" style="max-width: 700px; color: var(--text-dim); font-size: 1.125rem;">
                        شركة رائدة في مجال البرمجيات وحلول الويب. نمزج بين الإبداع الفني والدقة الهندسية لنقدم لك منتجات رقمية استثنائية.
                    </p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="#contact" class="btn btn-custom">ابدأ رحلتك</a>
                        <a href="#" class="btn btn-outline-custom">
                            <i class="fas fa-play me-2"></i> مشاهدة العرض
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== PROJECTS ========== -->
    <section class="py-5 fade-in" id="projects">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3">أحدث أعمالنا</h1>
                <p style="color: var(--text-dim); font-size: 1.125rem;">نماذج حية من الإبداع البرمجي</p>
                
                <div class="mt-4 d-flex justify-content-center flex-wrap gap-2">
                    <button class="filter-btn active" data-filter="all">الكل</button>
                    <button class="filter-btn" data-filter="web">تطبيقات ويب</button>
                    <button class="filter-btn" data-filter="mobile">تطبيقات جوال</button>
                    <button class="filter-btn" data-filter="graphic">هوية بصرية</button>
                    <button class="filter-btn" data-filter="marketing">تسويق اليكترونى</button>
                </div>
            </div>
            <div class="row" id="projectsGrid">
                @foreach ($projects as $item) 
                    <div class="col-md-4 project-item" data-category="{{ $item->type }}">
                        <div class="project-card">
                            <div class="project-img">
                                <img src="{{ url("storage/" . $item->image) }}" alt="{{ $item->name }}">
                                <div class="project-overlay">
                                    <a href="#" class="btn btn-custom"><i class="fas fa-link"></i></a>
                                </div>
                            </div>
                            <div class="p-4">
                                <h5 class="fw-bold mb-2">{{ $item->name }}</h5>
                                <p class="small mb-3" style="color: var(--primary);">{{ $item->description }}</p>
                                <p style="color: var(--text-dim); font-size: 0.9rem;">{{ $item->technics }}.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ========== Marketing ========= --> 
    @if ($marketing) 
        <section class="py-5 fade-in" id="media-achievements" style="background: var(--bg-card); backdrop-filter: blur(20px);">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold mb-3">إنجازات التسويق الإلكتروني</h1>
                    <p style="color: var(--text-dim); font-size: 1.125rem;">نتائج حقيقية حققناها لعملائنا</p>
                </div>

                <!-- Stats Overview -->
                <div class="row g-4 mb-5">
                    <div class="col-md-3 col-6">
                        <div class="service-card text-center py-4">
                            <div class="card-icon mb-3">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="fw-bold mb-2 tech-font" style="color: var(--primary);">{{ $marketing->total_watching }}+</h3>
                            <p class="mb-0" style="color: var(--text-dim); font-size: 0.9rem;">إجمالي المشاهدات</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="service-card text-center py-4">
                            <div class="card-icon mb-3">
                                <i class="fas fa-percentage"></i>
                            </div>
                            <h3 class="fw-bold mb-2 tech-font" style="color: var(--primary);">{{ $marketing->range_raise }}%</h3>
                            <p class="mb-0" style="color: var(--text-dim); font-size: 0.9rem;">متوسط نسبة النمو</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="service-card text-center py-4">
                            <div class="card-icon mb-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="fw-bold mb-2 tech-font" style="color: var(--primary);">{{ $marketing->access }}</h3>
                            <p class="mb-0" style="color: var(--text-dim); font-size: 0.9rem;">وصول إجمالي</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="service-card text-center py-4">
                            <div class="card-icon mb-3">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <h3 class="fw-bold mb-2 tech-font" style="color: var(--primary);">{{ $marketing->top_raise }}%</h3>
                            <p class="mb-0" style="color: var(--text-dim); font-size: 0.9rem;">أعلى نمو محقق</p>
                        </div>
                    </div>
                </div>

                <!-- Client Growth Cases -->
                <div class="row g-4">
                    <!-- Case 1: Facebook Page Growth -->
                    <div class="col-lg-6">
                        <div class="service-card h-100">
                            <div class="d-flex align-items-center mb-4">
                                <div class="card-icon me-3" style="font-size: 2.5rem;">
                                    <i class="fab fa-facebook"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1">صفحة فيس بوك - محتوى ترفيهي</h4>
                                    <p class="mb-0" style="color: var(--primary); font-size: 0.9rem;">Facebook Organic Growth</p>
                                </div>
                            </div>
                            
                            <div class="mb-4" style="background: rgba(0,0,0,0.2); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid var(--border-color);">
                                <img src="{{ url("storage/" . $marketing->face_image) }}" alt="نمو صفحة فيس بوك" style="width: 100%; height: auto; border-radius: 0.5rem; margin-bottom: 1rem;">
                                
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">الوصول</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary);">{{ $marketing->face_access }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">التعليقات</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary);">{{ $marketing->face_comments }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">المشاركات</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary);">{{ $marketing->face_share }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">الحفظ</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary);">{{ $marketing->face_save }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                محتوى عضوي بدون إعلانات مدفوعة
                            </p>
                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                تحسين وصول المنشورات بنسبة 200%
                            </p>
                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                زيادة التفاعل والمشاركات بشكل ملحوظ
                            </p>
                        </div>
                    </div>

                    <!-- Case 2: YouTube Analytics -->
                    <div class="col-lg-6">
                        <div class="service-card h-100">
                            <div class="d-flex align-items-center mb-4">
                                <div class="card-icon me-3" style="font-size: 2.5rem;">
                                    <i class="fab fa-youtube"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1">قناة يوتيوب - محتوى تعليمي</h4>
                                    <p class="mb-0" style="color: var(--primary); font-size: 0.9rem;">YouTube Growth & Monetization</p>
                                </div>
                            </div>
                            
                            <div class="mb-4" style="background: rgba(0,0,0,0.2); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid var(--border-color);">
                                <img src="{{ url("storage/" . $marketing->youtube_image) }}" alt="إحصائيات يوتيوب" style="width: 100%; height: auto; border-radius: 0.5rem; margin-bottom: 1rem;">
                                
                                <div class="row g-3 mb-3">
                                    <div class="col-4">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">المشاهدات</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary); font-size: 0.9rem;">{{ $marketing->youtube_watsh }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">الأرباح</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary); font-size: 0.9rem;">${{ $marketing->youtube_profits }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">الفترة</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary); font-size: 0.9rem;">{{ $marketing->youtube_period }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                تحقيق أرباح مستدامة من الإعلانات
                            </p>
                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                استراتيجية SEO متقدمة لزيادة المشاهدات
                            </p>
                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                تحسين معدل الاحتفاظ بالمشاهدين
                            </p>
                        </div>
                    </div>

                    <!-- Case 3: Advanced Analytics -->
                    <div class="col-lg-6">
                        <div class="service-card h-100">
                            <div class="d-flex align-items-center mb-4">
                                <div class="card-icon me-3" style="font-size: 2.5rem;">
                                    <i class="fas fa-chart-area"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1">نمو محتوى - تحليلات متقدمة</h4>
                                    <p class="mb-0" style="color: var(--primary); font-size: 0.9rem;">Content Performance Analytics</p>
                                </div>
                            </div>
                            
                            <div class="mb-4" style="background: rgba(0,0,0,0.2); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid var(--border-color);">
                                <img src="{{ url("storage/" . $marketing->analysis_image) }}" alt="تحليلات المشاهدين" style="width: 100%; height: auto; border-radius: 0.5rem; margin-bottom: 1rem;">
                                
                                <div class="row g-3 mb-3">
                                    <div class="col-6">
                                        <div class="p-3 text-center" style="background: linear-gradient(135deg, var(--primary-dim) 0%, rgba(0, 243, 255, 0.2) 100%); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">المشاهدات</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary);">{{ $marketing->analysis_watches }}</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 text-center" style="background: linear-gradient(135deg, var(--primary-dim) 0%, rgba(0, 243, 255, 0.2) 100%); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">النمو</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary);">{{ $marketing->analysis_growth }}%</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                نمو سريع في عدد المشاهدين الجدد
                            </p>
                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                تحسين ملحوظ في أداء المحتوى بعد 31 يوليو 2025
                            </p>
                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                استراتيجية محتوى مبنية على البيانات
                            </p>
                        </div>
                    </div>

                    <!-- Case 4: Comprehensive Metrics -->
                    <div class="col-lg-6">
                        <div class="service-card h-100">
                            <div class="d-flex align-items-center mb-4">
                                <div class="card-icon me-3" style="font-size: 2.5rem;">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1">مقاييس شاملة - نمو متكامل</h4>
                                    <p class="mb-0" style="color: var(--primary); font-size: 0.9rem;">Multi-Platform Growth Strategy</p>
                                </div>
                            </div>
                            
                            <div class="mb-4" style="background: rgba(0,0,0,0.2); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid var(--border-color);">
                                <img src="{{url("storage/" . $marketing->overall_growth_image) }}" alt="مقاييس شاملة" style="width: 100%; height: auto; border-radius: 0.5rem; margin-bottom: 1rem;">
                                
                                <div class="row g-3 mb-3">
                                    <div class="col-4">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">جهات الاتصال</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary); font-size: 0.9rem;">+{{ $marketing->overall_growth_calling }}%</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">الاستجابة</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary); font-size: 0.9rem;">+{{ $marketing->overall_growth_response }}%</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="p-3 text-center" style="background: var(--primary-dim); border-radius: 0.5rem; border: 1px solid var(--primary);">
                                            <p class="mb-1 small" style="color: var(--text-dim);">المحادثات</p>
                                            <h5 class="fw-bold mb-0 tech-font" style="color: var(--primary); font-size: 0.9rem;">+{{ $marketing->overall_growth_chats }}%</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 p-3" style="background: var(--bg-body); border-radius: 0.5rem;">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span style="color: var(--text-dim); font-size: 0.85rem;">المشاهدات الكلية</span>
                                        <span style="color: var(--primary); font-weight: bold;">{{ $marketing->overall_growth_watches }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span style="color: var(--text-dim); font-size: 0.85rem;">التفاعلات</span>
                                        <span style="color: var(--primary); font-weight: bold;">{{ $marketing->overall_growth_reaction }}</span>
                                    </div> 
                                </div>
                            </div>

                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                نمو شامل في جميع المقاييس الرئيسية
                            </p>
                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                تحسين معدل التحويل من المشاهدة للتفاعل
                            </p>
                            <p style="color: var(--text-dim); font-size: 0.95rem;">
                                <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i>
                                استراتيجية متكاملة عبر منصات متعددة
                            </p>
                        </div>
                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center mt-5 pt-4">
                    <h3 class="fw-bold mb-4">هل تريد نتائج مماثلة لمشروعك؟</h3>
                    <p class="lead mb-4" style="color: var(--text-dim);">دعنا نساعدك في تحقيق نمو حقيقي وملموس لعلامتك التجارية</p>
                    <a href="#contact" class="btn btn-custom">احجز استشارتك المجانية الآن</a>
                </div>
            </div>
        </section>
    @endif

    <!-- ========== SERVICES ========== -->
    <section class="py-5 fade-in" id="services">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3">ماذا نقدم؟</h1>
                <p style="color: var(--text-dim); font-size: 1.125rem;">حلول تقنية شاملة لتنمية أعمالك</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="service-box d-flex">
                        <div class="ms-3"><i class="fas fa-laptop-code service-icon"></i></div>
                        <div>
                            <h3 class="fw-bold mb-3">تطوير المواقع</h3>
                            <p style="color: var(--text-dim);">تصميم وتطوير مواقع تعريفية ومتاجر إلكترونية باستخدام أحدث التقنيات لضمان السرعة والأمان.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-box d-flex">
                        <div class="ms-3"><i class="fas fa-mobile-alt service-icon"></i></div>
                        <div>
                            <h3 class="fw-bold mb-3">تطبيقات الجوال</h3>
                            <p style="color: var(--text-dim);">بناء تطبيقات Native و Cross-platform تعمل بكفاءة على نظامي iOS و Android.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-box d-flex">
                        <div class="ms-3"><i class="fas fa-bullhorn service-icon"></i></div>
                        <div>
                            <h3 class="fw-bold mb-3">التسويق الرقمي</h3>
                            <p style="color: var(--text-dim);">إدارة الحملات الإعلانية، تحسين محركات البحث (SEO)، وإدارة حسابات التواصل الاجتماعي.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="service-box d-flex">
                        <div class="ms-3"><i class="fas fa-shield-alt service-icon"></i></div>
                        <div>
                            <h3 class="fw-bold mb-3">استشارات أمنية</h3>
                            <p style="color: var(--text-dim);">فحص الثغرات، تأمين السيرفرات، وحماية البيانات الحساسة من الاختراق.</p>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </section>

    <!-- ========== TEAM ========== -->
    <section id="team" class="py-5 fade-in" style="background: var(--bg-card); backdrop-filter: blur(20px);">
        <div class="container">
            <div class="text-center pt-5">
                <h2 class="display-4 fw-bold mb-3">فريق العمل</h2>
                <p class="mb-5" style="color: var(--text-dim); font-size: 1.125rem;">نخبة من المحترفين في خدمتك</p>
                <div class="row justify-content-center">
                    @foreach ($team as $item)
                        <div class="col-md-4 mb-4">
                            <div class="team-member">
                                <img src="{{ url("storage/" . $item->image) }}" class="team-img" alt="{{ $item->name }}">
                                <h5 class="fw-bold mt-3">{{ $item->name }}</h5>
                                <p class="mb-0" style="color: var(--text-dim); font-size: 0.9rem;">{{ $item->position }}</p>
                            </div>
                        </div>
                    @endforeach 
                </div>
            </div>
        </div>
    </section>
 
    <!-- ========== ABOUT ========== -->
    <section class="py-5 fade-in" id="about">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="text-start mb-4">
                        <h2 class="display-5 fw-bold mb-3" style="background: linear-gradient(135deg, var(--text-main) 0%, var(--primary) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">رؤيتنا ورسالتنا</h2>
                        <p style="color: var(--text-dim); font-size: 1.125rem;">لماذا نحن الخيار الأول للشركات؟</p>
                    </div>
                    <div class="timeline-item">
                        <h4 class="fw-bold mb-2">
                            <i class="fas fa-bullseye ms-2" style="color: var(--primary);"></i>
                            الرسالة
                        </h4>
                        <p style="color: var(--text-dim);">{{ $vision->msg }}.</p>
                    </div>
                    <div class="timeline-item">
                        <h4 class="fw-bold mb-2">
                            <i class="fas fa-eye ms-2" style="color: var(--primary);"></i>
                            الرؤية
                        </h4>
                        <p style="color: var(--text-dim);">{{ $vision->vision }}.</p>
                    </div>
                    <div class="timeline-item border-0">
                        <h4 class="fw-bold mb-2">
                            <i class="fas fa-star ms-2" style="color: var(--primary);"></i>
                            القيم
                        </h4>
                        <p style="color: var(--text-dim);">{{ $vision->benifits }}.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4 tech-font text-center">
                        <div class="col-6">
                            <div class="service-card py-5">
                                <h2 class="display-4 fw-bold mb-2" style="color: var(--primary);">{{ $vision->years }}+</h2>
                                <p class="mb-0" style="color: var(--text-dim);">سنوات خبرة</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="service-card py-5">
                                <h2 class="display-4 fw-bold mb-2" style="color: var(--primary);">{{ $vision->clients }}+</h2>
                                <p class="mb-0" style="color: var(--text-dim);">عميل حول العالم</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="service-card py-5">
                                <h2 class="display-4 fw-bold mb-2" style="color: var(--primary);">{{ $vision->projects }}+</h2>
                                <p class="mb-0" style="color: var(--text-dim);">مشروع ناجح</p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== CONTACT ========== -->
    <section class="py-5 fade-in" id="contact">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="display-5 fw-bold mb-4">لنتحدث عن مشروعك</h2>
                    <p class="lead mb-5" style="color: var(--text-dim);">هل لديك فكرة رائعة؟ نحن هنا للمساعدة في تحقيقها. املأ النموذج وسنتواصل معك في أقرب وقت.</p>
                    
                    <div class="info-box">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <h5 class="fw-bold mb-2">مقرنا الرئيسي</h5>
                            <p class="mb-0" style="color: var(--primary);">{{ $company_info->address }}</p>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="info-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h5 class="fw-bold mb-2">البريد الإلكتروني</h5>
                            <p class="mb-0 tech-font" style="color: var(--primary);">{{ $company_info->email }}</p>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="info-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <h5 class="fw-bold mb-2">الهاتف</h5>
                            <p class="mb-0 tech-font" style="color: var(--primary);">{{ $company_info->phone }}+</p>
                            <p class="mb-0 tech-font" style="color: var(--primary);">{{ $company_info->phone2 }}+</p>
                        </div>
                    </div>
 
                    <div class="map-container" style="padding: 0; overflow: hidden;">
                    <iframe 
                        src="https://www.google.com/maps?q={{ $company_info->lat }},{{ $company_info->lng }}&hl=ar&z=17&output=embed"
                        width="100%" 
                        height="100%" 
                        style="border:0; border-radius: 1.25rem;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact-form">
                        <h3 class="fw-bold mb-4">أرسل رسالة</h3>
                        <form action="mailto:ahmedahmadahmid73@gmail.com" method="POST" enctype="text/plain"> 
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" class="form-control"  name="name" placeholder="الاسم بالكامل" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control"  name="email" placeholder="البريد الإلكتروني" required>
                                </div>
                                <div class="col-12">
                                    <input type="text" class="form-control"  name="subject" placeholder="عنوان الرسالة" required>
                                </div>
                                <div class="col-12">
                                    <select class="form-control" name="service" required>
                                        <option value="" selected disabled style="color: var(--text-dim);">نوع الخدمة المطلوبة</option>
                                        <option>تصميم موقع</option>
                                        <option>تطبيق موبايل</option>
                                        <option>استشارة برمجية</option>
                                        <option>أخرى</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" rows="5" placeholder="تفاصيل المشروع..." required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-custom w-100">
                                        إرسال الرسالة <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FOOTER ========== -->
    <footer class="py-4 text-center border-top" style="border-color: var(--border-color) !important;">
        <div class="container">
            <p class="m-0 mb-3" style="color: var(--text-dim);">&copy; 2024 Digital Matrix. جميع الحقوق محفوظة</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ $company_info->facebook }}" style="color: var(--text-dim); font-size: 1.25rem;"><i class="fab fa-facebook"></i></a>
                <a href="{{ $company_info->tweeter }}" style="color: var(--text-dim); font-size: 1.25rem;"><i class="fab fa-twitter"></i></a>
                <a href="{{ $company_info->linked_in }}" style="color: var(--text-dim); font-size: 1.25rem;"><i class="fab fa-linkedin"></i></a>
                <a href="{{ $company_info->instagram }}" style="color: var(--text-dim); font-size: 1.25rem;"><i class="fab fa-instagram"></i></a>
                <a href="{{ $company_info->tiktok }}" style="color: var(--text-dim); font-size: 1.25rem;"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ==========================================
        // 1. Theme & Color Management
        // ==========================================
        const root = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const colorPicker = document.getElementById('colorPickerInput');
        const icon = themeToggle.querySelector('i');
        const navbar = document.querySelector('.navbar');

        // Toggle Dark/Light Mode
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.body.setAttribute('data-theme', newTheme);
            icon.className = newTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
            
            localStorage.setItem('theme', newTheme);
        });

        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme) {
            document.body.setAttribute('data-theme', savedTheme);
            icon.className = savedTheme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
        }

        // Color Picker Logic
        colorPicker.addEventListener('input', (e) => {
            const color = e.target.value;
            root.style.setProperty('--primary', color);
            
            if(particlesMaterial) {
                particlesMaterial.color.set(color);
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // ========================================== 
        // 2. Matrix Rain (Background Layer 1)
        // ==========================================
        const mCanvas = document.getElementById('matrix-bg');
        const mCtx = mCanvas.getContext('2d');
        
        function resizeCanvas() {
            mCanvas.width = window.innerWidth;
            mCanvas.height = window.innerHeight;
        }
        resizeCanvas();

        const katakana = 'xyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%&()*+-/\\';
        const latin = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const nums = '0123456789';
        const alphabet = katakana + latin + nums;
        
        const fontSize = 14;
        let columns = Math.floor(mCanvas.width / fontSize);
        let rainDrops = Array(columns).fill(1);

        function drawMatrix() {
            const theme = document.body.getAttribute('data-theme');
            mCtx.fillStyle = theme === 'light' 
                ? 'rgba(248, 249, 250, 0.1)' 
                : 'rgba(10, 10, 15, 0.1)';
            mCtx.fillRect(0, 0, mCanvas.width, mCanvas.height);

            const computedStyle = getComputedStyle(root);
            mCtx.fillStyle = computedStyle.getPropertyValue('--primary').trim();
            mCtx.font = fontSize + 'px monospace';

            for(let i = 0; i < rainDrops.length; i++) {
                const text = alphabet.charAt(Math.floor(Math.random() * alphabet.length));
                mCtx.fillText(text, i * fontSize, rainDrops[i] * fontSize);

                if(rainDrops[i] * fontSize > mCanvas.height && Math.random() > 0.975){
                    rainDrops[i] = 0;
                }
                rainDrops[i]++;
            }
        }
        
        setInterval(drawMatrix, 40);

        // ==========================================
        // 3. Three.js Network Mesh (Background Layer 2)
        // ==========================================
        let scene, camera, renderer, particlesMesh, particlesMaterial;

        function initThree() {
            const container = document.getElementById('three-bg');
            
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.z = 100;

            renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setPixelRatio(window.devicePixelRatio);
            container.appendChild(renderer.domElement);

            // Create Particles (Nodes)
            const particlesGeometry = new THREE.BufferGeometry();
            const particlesCount = 150; 
            
            const posArray = new Float32Array(particlesCount * 3);
            
            for(let i = 0; i < particlesCount * 3; i++) {
                posArray[i] = (Math.random() - 0.5) * 200; 
            }
            
            particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
            
            particlesMaterial = new THREE.PointsMaterial({
                size: 0.8,
                color: getComputedStyle(root).getPropertyValue('--primary').trim(),
                transparent: true,
                opacity: 0.8
            });
            
            particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
            scene.add(particlesMesh);

            document.addEventListener('mousemove', onDocumentMouseMove);
            animate();
        }

        let mouseX = 0;
        let mouseY = 0;
        let windowHalfX = window.innerWidth / 2;
        let windowHalfY = window.innerHeight / 2;

        function onDocumentMouseMove(event) {
            mouseX = (event.clientX - windowHalfX) * 0.1;
            mouseY = (event.clientY - windowHalfY) * 0.1;
        }

        function animate() {
            requestAnimationFrame(animate);

            particlesMesh.rotation.y += 0.002;
            particlesMesh.rotation.x += 0.001;

            camera.position.x += (mouseX - camera.position.x) * 0.05;
            camera.position.y += (-mouseY - camera.position.y) * 0.05;
            camera.lookAt(scene.position);

            renderer.render(scene, camera);
        }

        window.addEventListener('resize', () => {
            windowHalfX = window.innerWidth / 2;
            windowHalfY = window.innerHeight / 2;
            
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
            
            resizeCanvas();
            columns = Math.floor(mCanvas.width / fontSize);
            rainDrops = Array(columns).fill(1);
        });

        initThree();

        // ==========================================
        // 4. Project Filter
        // ==========================================
        const filterBtns = document.querySelectorAll('.filter-btn');
        const projectItems = document.querySelectorAll('.project-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.getAttribute('data-filter');

                projectItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // ==========================================
        // 5. Smooth Scroll for Navigation
        // ==========================================
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                    }
                }
            });
        });

        // ==========================================
        // 6. Form Submission
        // ==========================================
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('شكراً لتواصلك معنا! سنرد عليك في أقرب وقت ممكن.');
                contactForm.reset();
            });
        }

        // ==========================================
        // 7. Fade In on Scroll
        // ==========================================
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(40px)';
            el.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
            observer.observe(el);
        });

        // ==========================================
        // 8. Scroll to Top Button (Optional)
        // ==========================================
        let scrollToTopBtn = document.createElement('button');
        scrollToTopBtn.innerHTML = '<i class="fas fa-arrow-up"></i>';
        scrollToTopBtn.className = 'control-btn';
        scrollToTopBtn.style.cssText = 'position: fixed; bottom: 120px; right: 2rem; display: none; z-index: 1000;';
        scrollToTopBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
        document.body.appendChild(scrollToTopBtn);

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollToTopBtn.style.display = 'flex';
            } else {
                scrollToTopBtn.style.display = 'none';
            }
        });
    </script>
</body>
</html>
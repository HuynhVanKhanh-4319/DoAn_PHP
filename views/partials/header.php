<!-- filepath: d:\XAMPP\htdocs\PHP\BaiCuoiKy\views\partials\header.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robot Workshop - Mô Hình Cao Cấp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .header-glow {
            border-bottom: 2px solid #0ff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            background: linear-gradient(45deg, #111, #1a1a1a);
        }
        
        .nav-link {
            position: relative;
            color: #fff !important;
            transition: 0.3s;
        }
        
        .nav-link:hover {
            color: #0ff !important;
            text-shadow: 0 0 10px #0ff;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #0ff;
            transition: 0.3s;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .brand-logo {
            font-family: 'Arial Black', sans-serif;
            letter-spacing: 2px;
            background: linear-gradient(45deg, #0ff, #00f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .cart-icon {
            transition: 0.3s;
        }
        
        .cart-icon:hover {
            transform: scale(1.1);
            filter: drop-shadow(0 0 5px #0ff);
        }
    </style>
</head>
<body class="bg-dark">
    <header class="header-glow fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand brand-logo h2 mb-0" href="home.php">ROBOT WORKSHOP</a>
                
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item mx-2">
                            <a href="home.php" class="nav-link active">TRANG CHỦ</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link">BỘ SƯU TẬP</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link">PHỤ KIỆN</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="#" class="nav-link">HƯỚNG DẪN</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a href="cart.php" class="nav-link position-relative">
                                <i class="bi bi-cart3 cart-icon fs-5"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge bg-danger">
                                    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                                    <span class="visually-hidden">Cart items</span>
                                </span>
                            </a>
                        </li>

                        <!-- Thêm nút "Cập nhật thông tin" cho user đã đăng nhập -->
                        
                            <li class="nav-item mx-2">
                                <a href="update_profile.php" class="nav-link">CẬP NHẬT THÔNG TIN</a>
                            </li>
                        

                        <!-- Nút Đăng xuất -->
                        
                            <li class="nav-item mx-2">
                                <a href="../index.php?action=logout" class="btn btn-outline-danger btn-sm">ĐĂNG XUẤT</a>
                            </li>
                        
                            
                    </ul>
                </div>
            </nav>
        </div>
    </header>
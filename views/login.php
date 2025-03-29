<!-- filepath: d:\XAMPP\htdocs\PHP\BaiCuoiKy\views\login.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robot Workshop - Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 20px;
            border: 2px solid rgba(0, 255, 255, 0.3);
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            overflow: hidden;
            transition: 0.5s;
        }

        .login-card:hover {
            box-shadow: 0 0 50px rgba(0, 255, 255, 0.4);
        }

        .login-header {
            background: linear-gradient(45deg, #003366, #0066cc);
            padding: 2rem;
            text-align: center;
        }

        .neon-text {
            color: #fff;
            text-shadow: 0 0 10px #0ff,
                         0 0 20px #0ff,
                         0 0 30px #0ff;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(0, 255, 255, 0.3);
            color: #fff !important;
            padding: 1rem;
            transition: 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            border-color: #0ff;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3);
        }

        .form-label {
            color: #0ff !important;
            font-weight: 500;
        }

        .btn-login {
            background: linear-gradient(45deg, #0066cc, #00ccff);
            border: none;
            padding: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(45deg, #00ccff, #0066cc);
            transform: translateY(-2px);
        }

        .robot-overlay {
            position: absolute;
            right: -50px;
            bottom: -50px;
            opacity: 0.1;
            pointer-events: none;
        }

        @media (max-width: 768px) {
            .robot-overlay {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="login-card">
                    <div class="login-header">
                        <h2 class="neon-text mb-0"><i class="fas fa-robot me-2"></i>ĐĂNG NHẬP</h2>
                    </div>
                    
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <!-- Username Input -->
                            <div class="mb-4">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-user text-primary"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control border-start-0" 
                                           id="username" 
                                           name="username" 
                                           placeholder="Nhập tài khoản..."
                                           required>
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-4">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-lock text-primary"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control border-start-0" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Nhập mật khẩu..."
                                           required>
                                </div>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="btn btn-login w-100 text-uppercase">
                                Đăng nhập <i class="fas fa-sign-in-alt ms-2"></i>
                            </button>

                            <!-- Register Link -->
                            <div class="text-center mt-4">
                                <p class="text-muted mb-0">Chưa có tài khoản?
                                    <a href="index.php?action=register" class="text-primary text-decoration-none">
                                        Đăng ký ngay <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Robot Image -->
    <img src="assets/images/login-robot.png" class="robot-overlay img-fluid" alt="Robot" style="max-width: 400px;">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
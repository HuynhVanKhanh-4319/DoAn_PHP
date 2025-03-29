<!-- filepath: d:\XAMPP\htdocs\PHP\BaiCuoiKy\views\register.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robot Workshop - Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .register-card {
            background: rgba(0, 0, 0, 0.8);
            border-radius: 20px;
            border: 2px solid rgba(0, 255, 255, 0.3);
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            transition: 0.5s;
        }

        .register-card:hover {
            box-shadow: 0 0 50px rgba(0, 255, 255, 0.4);
        }

        .register-header {
            background: linear-gradient(45deg, #006633, #00cc66);
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

        .btn-register {
            background: linear-gradient(45deg, #00cc66, #00ff88);
            border: none;
            padding: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: linear-gradient(45deg, #00ff88, #00cc66);
            transform: translateY(-2px);
        }

        .password-strength {
            height: 4px;
            margin-top: 5px;
            transition: 0.3s;
        }

        .robot-overlay {
            position: absolute;
            left: -100px;
            bottom: -50px;
            opacity: 0.1;
            pointer-events: none;
            transform: rotate(-15deg);
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
            <div class="col-xl-6 col-lg-7 col-md-8">
                <div class="register-card">
                    <div class="register-header">
                        <h2 class="neon-text mb-0"><i class="fas fa-robot me-2"></i>TẠO TÀI KHOẢN</h2>
                    </div>
                    
                    <div class="card-body p-4">
                        <form method="POST" action="">
                            <!-- Username -->
                            <div class="mb-4">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-user text-success"></i>
                                    </span>
                                    <input type="text" 
                                           class="form-control border-start-0" 
                                           id="username" 
                                           name="username" 
                                           placeholder="Nhập tên đăng nhập..."
                                           required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-envelope text-success"></i>
                                    </span>
                                    <input type="email" 
                                           class="form-control border-start-0" 
                                           id="email" 
                                           name="email" 
                                           placeholder="Nhập email..."
                                           required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-lock text-success"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control border-start-0" 
                                           id="password" 
                                           name="password" 
                                           placeholder="Nhập mật khẩu..."
                                           required
                                           oninput="checkPasswordStrength(this.value)">
                                </div>
                                <div class="password-strength">
                                    <div class="progress" style="height: 4px;">
                                        <div id="password-strength-bar" class="progress-bar" role="progressbar"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-lock text-success"></i>
                                    </span>
                                    <input type="password" 
                                           class="form-control border-start-0" 
                                           id="confirm_password" 
                                           name="confirm_password" 
                                           placeholder="Nhập lại mật khẩu..."
                                           required>
                                </div>
                            </div>

                            <!-- Register Button -->
                            <button type="submit" class="btn btn-register w-100 text-uppercase">
                                Đăng ký <i class="fas fa-user-plus ms-2"></i>
                            </button>

                            <!-- Login Link -->
                            <div class="text-center mt-4">
                                <p class="text-muted mb-0">Đã có tài khoản?
                                    <a href="index.php?action=login" class="text-success text-decoration-none">
                                        Đăng nhập ngay <i class="fas fa-arrow-right ms-1"></i>
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
    <img src="https://bizweb.dktcdn.net/100/040/530/files/mo-hinh-black-mamba-bmb-bs-03-7.jpg?v=1653191349414" class="robot-overlay img-fluid" alt="Robot" style="max-width: 400px;">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('password-strength-bar');
            let strength = 0;
            
            if (password.length >= 8) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^A-Za-z0-9]/)) strength += 1;

            const width = (strength / 4) * 100;
            strengthBar.style.width = width + '%';
            
            if (strength < 2) {
                strengthBar.className = 'progress-bar bg-danger';
            } else if (strength < 4) {
                strengthBar.className = 'progress-bar bg-warning';
            } else {
                strengthBar.className = 'progress-bar bg-success';
            }
        }
    </script>
</body>
</html>
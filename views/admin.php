<!-- filepath: d:\XAMPP\htdocs\PHP\BaiCuoiKy\views\admin.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robot Workshop - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-color: #6366f1;
            --secondary-color: #3b82f6;
        }

        body {
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .admin-navbar {
            background: linear-gradient(45deg, #1e293b, #0f172a);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            height: 70px;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            min-height: calc(100vh - 70px);
            position: fixed;
            top: 70px;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: 0.3s;
        }

        .nav-link {
            color: #64748b;
            padding: 12px 25px;
            margin: 8px 15px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .nav-link:hover {
            background: #f1f5f9;
            color: var(--primary-color);
        }

        .nav-link.active {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white !important;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.2);
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
            background: linear-gradient(45deg, #fff, #f8fafc);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="admin-navbar navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="#">
                <i class="fas fa-robot me-2"></i>ROBOT ADMIN
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="text-white me-4" id="notiDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Thông báo mới</h6>
                        <a class="dropdown-item" href="#">Đơn hàng mới #1234</a>
                        <a class="dropdown-item" href="#">5 đánh giá mới</a>
                    </div>
                </div>
                <a href="../index.php?action=login" class="btn btn-light btn-sm">
                    <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="pt-4">
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action nav-link active">
                    <i class="fas fa-home me-3"></i>Dashboard
                </a>
                <a href="#" class="list-group-item list-group-item-action nav-link">
                    <i class="fas fa-users-cog me-3"></i>Quản lý người dùng
                </a>
                <a href="#" class="list-group-item list-group-item-action nav-link">
                    <i class="fas fa-box-open me-3"></i>Sản phẩm
                </a>
                <a href="#" class="list-group-item list-group-item-action nav-link">
                    <i class="fas fa-chart-bar me-3"></i>Thống kê
                </a>
                <a href="#" class="list-group-item list-group-item-action nav-link">
                    <i class="fas fa-cog me-3"></i>Cài đặt
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <h4 class="mb-4">Tổng quan hệ thống</h4>
            
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary p-3 rounded-circle me-3">
                                <i class="fas fa-users text-white fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Người dùng</h6>
                                <h3 class="mb-0">1,234</h3>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-success"><i class="fas fa-arrow-up"></i> 12%</span>
                            <span class="text-muted ms-2">So với tháng trước</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-success p-3 rounded-circle me-3">
                                <i class="fas fa-shopping-cart text-white fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Đơn hàng</h6>
                                <h3 class="mb-0">356</h3>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-success"><i class="fas fa-arrow-up"></i> 24%</span>
                            <span class="text-muted ms-2">Đang xử lý: 15</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning p-3 rounded-circle me-3">
                                <i class="fas fa-dollar-sign text-white fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Doanh thu</h6>
                                <h3 class="mb-0">$12,345</h3>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> 8%</span>
                            <span class="text-muted ms-2">Tháng này</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="stat-card p-4">
                        <div class="d-flex align-items-center">
                            <div class="bg-info p-3 rounded-circle me-3">
                                <i class="fas fa-chart-line text-white fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Hiệu suất</h6>
                                <h3 class="mb-0">94%</h3>
                            </div>
                        </div>
                        <div class="progress mt-3" style="height: 6px;">
                            <div class="progress-bar bg-info" style="width: 94%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="chart-container mb-4">
                <h5 class="mb-4">Biểu đồ doanh thu</h5>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Biểu đồ doanh thu
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Th1', 'Th2', 'Th3', 'Th4', 'Th5', 'Th6'],
                datasets: [{
                    label: 'Doanh thu (triệu)',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: '#6366f1',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(99, 102, 241, 0.1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
</body>
</html>
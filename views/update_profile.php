<?php
session_start();
require_once '../config.php';

// Kiểm tra user đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Lấy thông tin user từ cơ sở dữ liệu
$user_id = $_SESSION['user_id'];
try {
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if (!$user) {
        die("User không tồn tại.");
    }
} catch (PDOException $e) {
    die("Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $avatar = $user['avatar'];

    // Xử lý upload ảnh
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/avatars/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $avatar = $upload_dir . time() . '_' . basename($_FILES['avatar']['name']);
        move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
    }

    // Cập nhật thông tin
    try {
        $stmt = $pdo->prepare("UPDATE user SET email = ?, password = ?, avatar = ? WHERE id = ?");
        $stmt->execute([$email, password_hash($password, PASSWORD_DEFAULT), $avatar, $user_id]);
        header("Location: home.php");
        exit();
    } catch (PDOException $e) {
        die("Lỗi cập nhật thông tin: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <?php include 'partials/header.php'; ?>
    <div class="container mt-5 pt-5">
        <h2>CẬP NHẬT THÔNG TIN</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu mới</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu mới">
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                <?php if ($user['avatar']): ?>
                    <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar" width="100" class="mt-2">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
    <?php include 'partials/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
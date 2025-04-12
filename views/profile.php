<!-- filepath: d:\XAMPP\htdocs\PHP\DoAn_PHP\views\profile.php -->
<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['user'])) {
    header('Location: index.php?action=login'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

$user = $_SESSION['user']; // Lấy thông tin người dùng từ session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, button {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        img {
            display: block;
            margin: 10px auto;
            max-width: 100px;
            border-radius: 50%;
        }
        .message {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Update Profile</h1>

    <!-- Hiển thị thông báo thành công hoặc lỗi -->
    <?php if (isset($_GET['success'])): ?>
        <p class="message" style="color: green;">Profile updated successfully!</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p class="message" style="color: red;">Failed to update profile. Please try again.</p>
    <?php endif; ?>

    <form method="POST" action="index.php?action=updateProfile" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="avatar">Avatar:</label>
        <input type="file" name="avatar" id="avatar">
        <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar">

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
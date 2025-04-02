# Lưu ý:
## Tải thư viện Google-api-php-client tại đây: [Link](https://github.com/googleapis/google-api-php-client) (Lưu ý phải tải composer trước)
Sau khi clone thư viện thì xóa google-api-php-client cũ trong thư mục libs và clone thư viện mới về bỏ vào libs sau khi bỏ vào libs thì mở cmd cd tới libs/google-api-php-client chạy lệnh composer install


# File config.php
```
<?php
$host = 'localhost';
$dbname = 'doancuoiky';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}



// config api google
define('GOOGLE_CLIENT_ID', '431187249991-dm6m23vn750upcre5iqr6gcad1mte8r3.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', 'http://localhost/PHP/DoAn_PHP/callback.php');


require_once 'libs/google-api-php-client/vendor/autoload.php';

// Call api Google
$gClient = new Google_Client();
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);
$gClient->addScope("email");
$gClient->addScope("profile");

$google_oauthV2 = new Google_Service_Oauth2($gClient);

?> 


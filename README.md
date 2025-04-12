# File config.php
``` <?php
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


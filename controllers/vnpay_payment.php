<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once __DIR__ . '/../config/vnpay_config.php';

function process_vnpay_payment($order_data) {
    $vnp_Url = VNPAY_URL;
    $vnp_Returnurl = VNPAY_RETURN_URL;
    $vnp_TmnCode = VNPAY_TMN_CODE;
    $vnp_HashSecret = VNPAY_HASH_SECRET;
    
    $vnp_TxnRef = $order_data['order_id'];
    $vnp_OrderInfo = $order_data['order_desc'];
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = $order_data['amount'] * 100;
    $vnp_Locale = VNPAY_LOCALE;
    $vnp_BankCode = '';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    
    $inputData = array(
        "vnp_Version" => VNPAY_VERSION,
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => VNPAY_COMMAND,
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => VNPAY_CURR_CODE,
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    return $vnp_Url;
}
?> 
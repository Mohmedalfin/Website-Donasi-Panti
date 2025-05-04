<?php
/*Install Midtrans PHP Library (https://github.com/Midtrans/midtrans-php)
composer require midtrans/midtrans-php
                              
Alternatively, if you are not using **Composer**, you can download midtrans-php library 
(https://github.com/Midtrans/midtrans-php/archive/master.zip), and then require 
the file manually.   

require_once dirname(__FILE__) . '/pathofproject/Midtrans.php'; */
require_once __DIR__ . '/../vendor/autoload.php';


//SAMPLE REQUEST START HERE

// Set your Merchant Server Key
\Midtrans\Config::$serverKey = 'SB-Mid-server-SHsoYIKeZetjtVNr6-5lP17w';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;


$nama = $_POST['nama'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];
$catatan = isset($_POST['catatan']) ? $_POST['catatan'] : '';

$total = isset($_POST['custom_nominal']) && $_POST['custom_nominal'] > 0
    ? (int) $_POST['custom_nominal']
    : (int) $_POST['total'];

$params = array(
    'transaction_details' => array(
        'order_id' => 'DONASI-' . time(),
        'gross_amount' => $total,
    ),
    'customer_details' => array(
        'first_name' => $nama,
        'email' => $email,
        'phone' => $telepon,
    ),
    'item_details' => array(
        array(
            'id' => 'donation',
            'price' => $total,
            'quantity' => 1,
            'name' => 'Donasi',
        )
    ),
    'custom_fields' => array(
        'custom_field1' => $catatan,
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);

echo json_encode(['snapToken' => $snapToken]);
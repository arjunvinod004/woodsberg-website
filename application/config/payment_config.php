<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Federal Bank Payment Gateway Configuration
$config['federal_bank'] = array(
    'merchant_id' => 'YOUR_MERCHANT_ID',
    'access_key' => 'YOUR_ACCESS_KEY',
    'secret_key' => 'YOUR_SECRET_KEY',
    'test_mode' => TRUE, // Set to FALSE for live transactions
    'gateway_url' => array(
        'test' => 'https://test.federalbank.co.in/payment/gateway',
        'live' => 'https://secure.federalbank.co.in/payment/gateway'
    ),
    'currency' => 'INR',
    'hash_method' => 'sha512', // or sha256 based on bank requirements
    'return_url' => base_url('payment/success'),
    'cancel_url' => base_url('payment/cancel'),
    'notify_url' => base_url('payment/notify')
);
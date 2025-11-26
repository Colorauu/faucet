<?php
return [
    'db' => [
        'host' => 'localhost',
        'name' => 'dnpzwuxj_ironfaucet',
        'user' => 'dnpzwuxj_ironfaucet',
        'pass' => '6hbzV4FcunNVTP8m5j3p',
        'charset' => 'utf8mb4',
    ],
    'app' => [
        'url' => 'https://ironfaucet.sbs',
        'env' => 'production',
    ],
    'faucetpay' => [
        'api_key' => '',
        'default_coin' => 'BEP20'
    ],
    'cron_secret' => bin2hex(random_bytes(12)),
    'session_cookie_name' => 'ironfaucet_session_v1'
];

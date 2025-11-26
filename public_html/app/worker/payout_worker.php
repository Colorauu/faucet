<?php
// allow CLI or cron token
if (php_sapi_name() !== 'cli') {
    $token = $_GET['cron'] ?? '';
    $cfg = require __DIR__ . '/../core/config.php';
    if (empty($cfg['cron_secret']) || $token !== $cfg['cron_secret']) {
        http_response_code(403); echo "Forbidden"; exit;
    }
}
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/FaucetPay.php';
$db = Database::getConnection();
$cfg = require __DIR__ . '/../core/config.php';
$fp = new FaucetPay($cfg['faucetpay']['api_key'] ?? '');

$stmt = $db->prepare("SELECT * FROM payouts WHERE status='pending' LIMIT 10");
$stmt->execute();
$rows = $stmt->fetchAll();
foreach ($rows as $r) {
    $res = $fp->send($r['tx_address'] ?? $r['method'], (float)$r['amount'], $r['coin'] ?? $cfg['faucetpay']['default_coin']);
    if (!empty($res['success']) || (isset($res['status']) && $res['status']=='success')) {
        $db->prepare("UPDATE payouts SET status='paid', txid=:tx, paid_at=NOW(), response=:resp WHERE id=:id")
           ->execute(['tx'=>$res['txid'] ?? '','resp'=>json_encode($res),'id'=>$r['id']]);
    } else {
        $db->prepare("UPDATE payouts SET status='failed', response=:resp WHERE id=:id")
           ->execute(['resp'=>json_encode($res),'id'=>$r['id']]);
    }
}
echo "ok\n";

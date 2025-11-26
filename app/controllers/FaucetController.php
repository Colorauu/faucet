<?php
class FaucetController extends Controller {
    public function claim() {
        session_start();
        if (empty($_SESSION['user_id'])) {
            header('Location: /login'); exit;
        }
        $userId = $_SESSION['user_id'];
        $settings = new Settings();
        $min = (float)$settings->get('reward_min') ?: 1;
        $max = (float)$settings->get('reward_max') ?: 5;
        $amount = round(mt_rand($min*100000000, $max*100000000)/100000000,8);
        $c = new Claim();
        $c->create($userId,$amount,$_SERVER['REMOTE_ADDR']);
        // add to user balance
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE users SET balance = balance + :a, last_claim = NOW(), faucet_claims = faucet_claims + 1 WHERE id=:id");
        $stmt->execute(['a'=>$amount,'id'=>$userId]);
        $this->view('home/faucet',['amount'=>$amount]);
    }
}

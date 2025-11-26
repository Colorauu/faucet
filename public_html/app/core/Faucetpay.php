<?php
class FaucetPay {
    private string $apiKey;
    private string $endpoint = 'https://faucetpay.io/api/v1/';
    public function __construct(string $apiKey) { $this->apiKey = $apiKey; }
    public function send(string $to, float $amount, string $coin = 'BEP20') {
        $url = $this->endpoint . 'withdraw';
        $post = ['api_key' => $this->apiKey,'to'=>$to,'amount'=>(string)$amount,'coin'=>$coin];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        $resp = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) return ['success'=>false,'error'=>$err];
        $json = json_decode($resp,true);
        if (!is_array($json)) return ['success'=>false,'error'=>'invalid_response','raw'=>$resp];
        return $json;
    }
}

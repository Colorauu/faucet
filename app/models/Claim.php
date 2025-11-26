<?php
class Claim extends Model {
    public function create($user_id,$amount,$ip) {
        $stmt = $this->db->prepare("INSERT INTO claims (user_id,amount,ip) VALUES (:u,:a,:ip)");
        return $stmt->execute(['u'=>$user_id,'a'=>$amount,'ip'=>$ip]);
    }
}

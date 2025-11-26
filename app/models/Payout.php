<?php
class Payout extends Model {
    public function create($user_id,$method,$amount) {
        $stmt = $this->db->prepare("INSERT INTO payouts (user_id,method,amount) VALUES (:u,:m,:a)");
        return $stmt->execute(['u'=>$user_id,'m'=>$method,'a'=>$amount]);
    }
    public function pending($limit=50) {
        $stmt = $this->db->prepare("SELECT * FROM payouts WHERE status='pending' ORDER BY id ASC LIMIT :l");
        $stmt->bindValue(':l',(int)$limit,PDO::PARAM_INT); $stmt->execute();
        return $stmt->fetchAll();
    }
}

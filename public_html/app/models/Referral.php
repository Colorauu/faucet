<?php
class Referral extends Model {
    public function add($referrer,$user_id,$commission) {
        $stmt = $this->db->prepare("INSERT INTO referrals (referrer_id,user_id,commission) VALUES (:r,:u,:c)");
        return $stmt->execute(['r'=>$referrer,'u'=>$user_id,'c'=>$commission]);
    }
}

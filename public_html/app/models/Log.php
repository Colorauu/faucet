<?php
class Log extends Model {
    public function login($user_id,$email,$ip,$ua,$status){
        $stmt = $this->db->prepare("INSERT INTO login_logs (user_id,email,ip,user_agent,status) VALUES (:u,:e,:ip,:ua,:s)");
        return $stmt->execute(['u'=>$user_id,'e'=>$email,'ip'=>$ip,'ua'=>$ua,'s'=>$status]);
    }
}

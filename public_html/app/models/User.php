<?php
class User extends Model {
    public function findByEmail(string $email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
        $stmt->execute(['email'=>$email]);
        return $stmt->fetch();
    }
    public function create(array $data) {
        $stmt = $this->db->prepare("INSERT INTO users (email,password,wallet,ip,country) VALUES (:email,:password,:wallet,:ip,:country)");
        return $stmt->execute([
            'email'=>$data['email'],
            'password'=>password_hash($data['password'], PASSWORD_BCRYPT),
            'wallet'=>$data['wallet'] ?? null,
            'ip'=>$data['ip'] ?? null,
            'country'=>$data['country'] ?? null
        ]);
    }
}

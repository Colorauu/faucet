<?php
class Admin extends Model {
    public function findByEmail(string $email) {
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email=:email LIMIT 1");
        $stmt->execute(['email'=>$email]); return $stmt->fetch();
    }
    public function all() {
        $stmt = $this->db->query("SELECT id,username,email,role,created_at FROM admins ORDER BY id DESC");
        return $stmt->fetchAll();
    }
    public function create(array $d) {
        $stmt = $this->db->prepare("INSERT INTO admins (username,email,password,role) VALUES (:username,:email,:password,:role)");
        return $stmt->execute(['username'=>$d['username'],'email'=>$d['email'],'password'=>password_hash($d['password'],PASSWORD_BCRYPT),'role'=>$d['role']??'admin']);
    }
}

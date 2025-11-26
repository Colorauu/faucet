<?php
class Settings extends Model {
    public function get($name) {
        $stmt = $this->db->prepare("SELECT value FROM faucet_settings WHERE name=:name LIMIT 1");
        $stmt->execute(['name'=>$name]);
        $r = $stmt->fetch();
        return $r['value'] ?? null;
    }
    public function set($name,$value) {
        $stmt = $this->db->prepare("INSERT INTO faucet_settings (name,value) VALUES (:name,:value) ON DUPLICATE KEY UPDATE value=:value");
        return $stmt->execute(['name'=>$name,'value'=>$value]);
    }
}

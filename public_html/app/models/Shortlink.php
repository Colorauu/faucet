<?php
class Shortlink extends Model {
    public function all(){ return $this->db->query("SELECT * FROM shortlinks")->fetchAll(); }
}

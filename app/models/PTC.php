<?php
class PTC extends Model { public function all(){ return $this->db->query("SELECT * FROM ptc_ads")->fetchAll(); } }

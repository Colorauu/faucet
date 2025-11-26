<?php

class Achievement extends Model
{
    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM achievements ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM achievements WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO achievements (name, description, type, target_value, reward_amount, is_active)
                VALUES (:name, :description, :type, :target_value, :reward_amount, :is_active)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'name'         => $data['name'],
            'description'  => $data['description'],
            'type'         => $data['type'],
            'target_value' => $data['target_value'],
            'reward_amount'=> $data['reward_amount'],
            'is_active'    => $data['is_active'] ?? 1
        ]);
    }

    public function updateAchievement($id, $data)
    {
        $sql = "UPDATE achievements SET 
                name = :name,
                description = :description,
                type = :type,
                target_value = :target_value,
                reward_amount = :reward_amount,
                is_active = :is_active
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id'           => $id,
            'name'         => $data['name'],
            'description'  => $data['description'],
            'type'         => $data['type'],
            'target_value' => $data['target_value'],
            'reward_amount'=> $data['reward_amount'],
            'is_active'    => $data['is_active']
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM achievements WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}

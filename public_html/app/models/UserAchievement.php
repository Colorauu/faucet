<?php
class UserAchievement extends Model {

    public function userHasAchievement($user_id, $achievement_id) {
        $stmt = $this->db->prepare("SELECT id FROM user_achievements 
                                    WHERE user_id = :u AND achievement_id = :a");
        $stmt->execute(['u' => $user_id, 'a' => $achievement_id]);
        return $stmt->fetch();
    }

    public function register($user_id, $achievement_id) {
        $stmt = $this->db->prepare("INSERT INTO user_achievements (user_id, achievement_id) 
                                    VALUES (:u, :a)");
        return $stmt->execute(['u' => $user_id, 'a' => $achievement_id]);
    }

    public function getUserAchievements($user_id) {
        $stmt = $this->db->prepare("
            SELECT a.*, ua.date_achieved 
            FROM user_achievements ua 
            JOIN achievements a ON ua.achievement_id = a.id
            WHERE ua.user_id = :u
            ORDER BY ua.date_achieved DESC
        ");
        $stmt->execute(['u' => $user_id]);
        return $stmt->fetchAll();
    }
}

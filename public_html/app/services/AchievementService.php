<?php
class AchievementService {

    private $achievement;
    private $userAchievement;
    private $db;

    public function __construct() {
        $this->achievement = new Achievement();
        $this->userAchievement = new UserAchievement();
        $this->db = Database::getConnection();
    }

    public function check($user_id, $type, $current_value) {
        // pega todas conquistas do tipo acionado
        $achievements = $this->achievement->findByType($type);

        foreach ($achievements as $a) {

            // já ganhou?
            if ($this->userAchievement->userHasAchievement($user_id, $a['id'])) {
                continue;
            }

            // ainda não atingiu o valor
            if ($current_value < $a['target_value']) {
                continue;
            }

            // marca como conquistado
            $this->userAchievement->register($user_id, $a['id']);

            // recompensa
            $stmt = $this->db->prepare("UPDATE users SET balance = balance + :rew WHERE id = :id");
            $stmt->execute(['rew' => $a['reward_amount'], 'id' => $user_id]);

            // adiciona na activity feed (prova social)
            $feed = $this->db->prepare("
                INSERT INTO activity_feed (user_id, username, activity_type, amount, message_text)
                VALUES (:uid, (SELECT username FROM users WHERE id=:uid), 'achievement', :amt, :msg)
            ");
            $feed->execute([
                'uid' => $user_id,
                'amt' => $a['reward_amount'],
                'msg' => "Conquistou: {$a['name']}"
            ]);
        }
    }
}

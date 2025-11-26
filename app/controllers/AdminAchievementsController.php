<?php

class AdminAchievementsController extends Controller
{
    protected Achievement $achievementModel;

    public function __construct()
    {
        AdminMiddleware::check(); // Protege rota
        require_once __DIR__ . '/../models/Achievement.php';
        $this->achievementModel = new Achievement();
    }

    // LISTAR
    public function index()
    {
        $achievements = $this->achievementModel->all();
        $this->view('admin/achievements/index', ['achievements' => $achievements]);
    }

    // FORM CRIAR
    public function create()
    {
        $this->view('admin/achievements/create');
    }

    // SALVAR NOVA
    public function store()
    {
        $data = [
            'name'         => $_POST['name'],
            'description'  => $_POST['description'],
            'type'         => $_POST['type'],
            'target_value' => (int)$_POST['target_value'],
            'reward_amount'=> $_POST['reward_amount'],
            'is_active'    => isset($_POST['is_active']) ? 1 : 0
        ];

        $this->achievementModel->create($data);

        header("Location: /admin/achievements");
    }

    // FORM EDITAR
    public function edit($id)
    {
        $achievement = $this->achievementModel->find($id);
        $this->view('admin/achievements/edit', ['achievement' => $achievement]);
    }

    // SALVAR EDIÇÃO
    public function update($id)
    {
        $data = [
            'name'         => $_POST['name'],
            'description'  => $_POST['description'],
            'type'         => $_POST['type'],
            'target_value' => (int)$_POST['target_value'],
            'reward_amount'=> $_POST['reward_amount'],
            'is_active'    => isset($_POST['is_active']) ? 1 : 0
        ];

        $this->achievementModel->updateAchievement($id, $data);

        header("Location: /admin/achievements");
    }

    // APAGAR
    public function delete($id)
    {
        $this->achievementModel->delete($id);
        header("Location: /admin/achievements");
    }
}

<?php
class Money_limitController extends BaseController
{
    private $userModel;
    private $user_id;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
        $this->user_id = isset($_SESSION['login']) ? $_SESSION['login']['id'] : 0;
    }

    public function sayHi()
    {

        $money_limit = 0;
        $user = $this->userModel->find($this->user_id);
        if ($user['spending_limit']) {
            $money_limit = $user['spending_limit'];
        }

        $this->view(
            'main-layout',
            [
                'page' => 'moneyLimits/index',
                'pageName' => 'Giới hạn thu chi',
                'money_limit' => $money_limit
            ]
        );
    }

    public function update()
    {
        $data = [];
        $money_limit = $_POST['money_limit'];
        $user = $this->userModel->find($this->user_id);

        if ($money_limit && $money_limit != $user['spending_limit']) {
            $data['spending_limit'] = $money_limit;
        }

        if (count($data) > 0) {
            $this->userModel->update($this->user_id, $data);
            header("location:sayHi");
        } else {
            header("location:sayHi");
        }
    }
}

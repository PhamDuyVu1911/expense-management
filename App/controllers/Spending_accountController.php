<?php
class Spending_accountController extends BaseController
{
    private $spendingAccountModel;


    public function __construct()
    {
        $this->spendingAccountModel = $this->model('Spending_accountModel');
    }

    public function sayHi()
    {
        $spendingAccounts = $this->spendingAccountModel->getAll();
        $this->view('main-layout', [
            'page' => 'spendingAccounts/index',
            'pageName' => 'Danh sách tài khoản',
            'spendingAccounts' => $spendingAccounts
        ]);
    }

    public function getMoneyById()
    {
        $id = $_POST['id'];
        $result = $this->spendingAccountModel->find($id); //Tìm email

        header('Content-Type: application/json');
        echo json_encode($result);
    }



    public function add()
    {
        $this->view('main-layout', [
            'page' => 'spendingAccounts/add',
            'pageName' => 'Thêm tài khoản',
        ]);
    }

    public function create()
    {
        $name = $_POST['name'];
        $initial_amount = $_POST['initial_amount'];
        $type_account = $_POST['type_account'];
        $description = $_POST['description'];

        if ($name && $initial_amount && $type_account && $description) {
            $data = ['name' => $name, 'initial_amount' => $initial_amount, 'type_account' => $type_account, 'description' => $description];
            $this->spendingAccountModel->create($data);
            header("location: sayHi");
        } else {
            header("location:add");
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $spendingAccount = $this->spendingAccountModel->find($id);
        $this->view('main-layout', [
            'page' => 'spendingAccounts/edit',
            'pageName' => 'cập nhật tài khoản',
            'spendingAccount' => $spendingAccount,
        ]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = [];
        $name = $_POST['name'];
        $initial_amount = $_POST['initial_amount'];
        $type_account = $_POST['type_account'];
        $description = $_POST['description'];
        $spendingAccount = $this->spendingAccountModel->find($id);



        if ($name && $name != $spendingAccount['name']) {
            $data['name'] = $name;
        }

        if ($initial_amount && $initial_amount != $spendingAccount['initial_amount']) {
            $data['initial_amount'] = $initial_amount;
            if ($spendingAccount['amount']) {
                $data['amount'] = ($spendingAccount['amount'] - $spendingAccount['initial_amount']) + $initial_amount;
            }
        }

        if ($type_account && $type_account != $spendingAccount['type_account']) {
            $data['type_account'] = $type_account;
        }

        if ($description && $description != $spendingAccount['description']) {
            $data['description'] = $description;
        }

        if (count($data) > 0) {
            $this->spendingAccountModel->update($id, $data);
            header("location:../sayHi");
        } else {
            header("location:../edit&id=${id}");
        }
    }

    public function delete()
    {
        $transactionModel = $this->model('TransactionModel');
        $id = $_POST['id'];

        if ($id) {
            $spendingAccounts = $transactionModel->getTransactionByAccount($id);
            if (mysqli_num_rows($spendingAccounts)) {
                // Xoá các chi tiêu của tài khoản này
                $transactionModel->deleteTransactionByAccount($id);
            }
            $this->model('Saving_accountModel')->deleteSavingAccountByAccount($id);
            $this->spendingAccountModel->destroy($id);
            header("location:sayHi");
        } else {
            header("location:sayHi");
        }
    }
}

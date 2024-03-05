<?php
class CategoryController extends BaseController
{
    private $categoryModel;


    public function __construct()
    {
        $this->categoryModel = $this->model('CategoryModel');
    }

    public function sayHi()
    {
        $Categories = $this->categoryModel->getCategoryOrderBy();
        $this->view('main-layout', [
            'page' => 'categories/index',
            'pageName' => 'Nhóm chi tiêu',
            'categories' => $Categories
        ]);
    }



    public function add()
    {
        $this->view('main-layout', [
            'page' => 'categories/add',
            'pageName' => 'Thêm nhóm chi tiêu',
        ]);
    }


    public function create()
    {
        $name = $_POST['name'];
        $type_transaction_id = $_POST['type_transaction_id'];
        if ($name &&  $type_transaction_id) {
            $data = ['name' => $name, 'type_transaction_id' => $type_transaction_id];
            $this->categoryModel->create($data);
            header("location:sayHi");
        } else {
            header("location:add");
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $category = $this->categoryModel->find($id);
        $this->view('main-layout', [
            'page' => 'categories/edit',
            'pageName' => 'Cập nhật danh mục',
            'category' => $category,
        ]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $data = [];
        $name = $_POST['name'];
        $category = $this->categoryModel->find($id);

        if ($name && $name != $category['name']) {
            $data['name'] = $name;
        }

        if (count($data) > 0) {
            $this->categoryModel->update($id, $data);
            header("location:sayHi");
        } else {
            header("location:edit&id=${id}");
        }
    }

    public function delete()
    {
        // Call model
        $transactionModel = $this->model('TransactionModel');
        $spendingAccountModel = $this->model('Spending_accountModel');
        $planModel = $this->model('PlanModel');

        $id = $_POST['id'];
        $total_money_by_account = [];

        $transactions = $transactionModel->getTransactionByGroup($id);
        $category = $this->categoryModel->find($id);
        $type = $category['type_transaction_id'];
        $plans = $planModel->getPlanByGroup($id);

        // Xoá các kế hoạch chi tiêu của danh mục
        if (count($plans) > 0) {
            $planModel->deletePlanByGroup($id);
        }

        // Hoàn lại tiền cho các tài khoản
        if (count($transactions) > 0) {
            // Lặp qua mảng $transactions để tính tổng tiền theo spending_account_id
            foreach ($transactions as $transaction) {
                $accountId = $transaction['spending_account_id'];
                $money = $transaction['money_number'];

                // Nếu spending_account_id đã tồn tại trong mảng $total_money_by_account, thì cộng thêm vào tổng
                if (array_key_exists($accountId, $total_money_by_account)) {
                    $total_money_by_account[$accountId] += $money;
                } else {
                    // Nếu spending_account_id chưa tồn tại, tạo mới và gán giá trị là money_number
                    $total_money_by_account[$accountId] = $money;
                }
            }

            // Xoá tất cả  chi tiêu của danh mục
            $transactionModel->deleteTransactionByGroup($id);

            foreach ($total_money_by_account as $accountId => $totalMoney) {
                $spendingAccount = $spendingAccountModel->find($accountId);
                if ($type == 1) {
                    // Thu: Trừ totalMoney từ 'amount'
                    $newAmount = $spendingAccount['amount'] - $totalMoney;
                    $spendingAccountModel->update(
                        $accountId,
                        ['amount' => $newAmount]
                    );
                } else {
                    // Chi: Cộng totalMoney vào 'amount'
                    $newAmount = $spendingAccount['amount'] + $totalMoney;
                    $spendingAccountModel->update(
                        $accountId,
                        ['amount' => $newAmount]
                    );
                }
            }
        }

        // Xoá danh mục
        $this->categoryModel->destroy($id);
        header("location:sayHi");
    }
}

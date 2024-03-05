<?php
class ReportController extends BaseController
{
    private $transactionModel;
    private $spendingAccountModel;
    private $categoryModel;



    public function __construct()
    {
        $this->transactionModel = $this->model('TransactionModel');
        $this->spendingAccountModel = $this->model('Spending_accountModel');
        $this->categoryModel = $this->model('CategoryModel');
    }

    public function sayHi()
    {
        $type_transaction_id = 0;
        $spending_account_id = 0;
        $time_start = 0;
        $time_end = 0;


        if (isset($_POST['type_transaction_id']) && $_POST['type_transaction_id'] !== 0) {
            $type_transaction_id = $_POST['type_transaction_id'];
        }

        if (isset($_POST['spending_account_id']) && $_POST['spending_account_id'] !== 0) {
            $spending_account_id = $_POST['spending_account_id'];
        }

        if (isset($_POST['time_start']) && $_POST['time_start'] !== 0) {
            $time_start = $_POST['time_start'];
        }

        if (isset($_POST['time_end'])) {
            $time_end = $_POST['time_end'];
        }


        $categories = $this->categoryModel->getAll();
        $spendingAccounts = $this->spendingAccountModel->getAll();
        $transactions = $this->transactionModel->filterTransaction($type_transaction_id, $spending_account_id, $time_start, $time_end);

        $this->view('main-layout', [
            'page' => 'reports/index',
            'pageName' => 'Báo cáo thống kê',
            'transactions' => $transactions,
            'categories' => $categories,
            'spendingAccounts' => $spendingAccounts,
            'type_transaction_id' => $type_transaction_id,
            'spending_account_id' => $spending_account_id,
            'time_start' => $time_start,
            'time_end' => $time_end,
        ]);
    }
}

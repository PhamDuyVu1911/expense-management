<?php
class OverviewController extends BaseController
{
    private $transactionModel;
    private $spendingAccountModel;



    public function __construct()
    {
        $this->transactionModel = $this->model('TransactionModel');
        $this->spendingAccountModel = $this->model('Spending_accountModel');
    }

    public function sayHi()
    {
        $transactions = $this->transactionModel->getTransactionByType();
        $spendingAccounts = $this->spendingAccountModel->getAll();
        // Tổng thu nhập
        $income_total = 0;
        // Tổng chi tiêu
        $spending_total = 0;
        // Tổng số dư của tất cả tài khoản
        $amount_spending_account = 0;

        if (count($spendingAccounts) > 0) {
            foreach ($spendingAccounts as $spendingAccount) {
                if ($spendingAccount['amount']) {
                    $amount_spending_account += $spendingAccount['amount'];
                } else {
                    $amount_spending_account += $spendingAccount['initial_amount'];
                }
            }
        }

        if (count($transactions)) {
            foreach ($transactions as $transaction) {
                if ($transaction['type_transaction_id'] == 1) {
                    $income_total += $transaction['money_number'];
                } else {
                    $spending_total += $transaction['money_number'];
                }
            }
        }



        $transactions = $this->transactionModel->getAll();
        $this->view('main-layout', [
            'page' => 'overviews/index',
            'pageName' => 'Tổng quan',
            'transactions' => $transactions,
            'income_total' => $income_total,
            'spending_total' => $spending_total,
            'amount_spending_account' => $amount_spending_account,
        ]);
    }
}

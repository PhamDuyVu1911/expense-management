<?php
class Saving_accountController extends BaseController
{
    protected $savingAccountModel;
    protected $spendingAccountModel;
    public function __construct()
    {
        $this->savingAccountModel = $this->model('Saving_accountModel');
        $this->spendingAccountModel = $this->model('Spending_accountModel');
    }

    public function sayHi()
    {
        $spendingAccounts = $this->spendingAccountModel->getAll();
        $savingAccounts = $this->savingAccountModel->getAll();


        // Xử lý cộng tiền tháng tự động
        foreach ($savingAccounts as $savingAccount) {
            // Tiền gửi của toàn kỳ hạn
            $full_term_interest = $savingAccount['depositAmount'] +  $savingAccount['depositAmount'] * $savingAccount['interestRate'] / 100 / 12 * $savingAccount['durationInMonths'];
            // Tiền gửi của từng tháng
            $interest_each_month =  $savingAccount['depositAmount'] * $savingAccount['interestRate'] / 100 / 12 * 1;

            // Nếu tổng tiền cộng dô mỗi tháng nhỏ hơn tổng số tiền lãi của kỳ hạn
            if ($savingAccount['total_amount'] <  $full_term_interest) {
                // Cứ sau một tháng cộng lên số tiền lãi của tài khoản
                // Nếu ngày hiện tại bằng với ngày update (1 tháng kể từ ngày update)
                if (date('Y-m-d') === date('Y-m-d', strtotime("+${savingAccount['durationInMonths']} month", strtotime($savingAccount['update_at'])))) {
                    // Nếu đã cập nhật total_amont trước đó thì tiền = total_amount + tiền lãi
                    if ($savingAccount['total_amount'] != 0) {
                        $this->savingAccountModel->update($savingAccount['id'], ['total_amount' => $savingAccount['total_amount'] + $interest_each_month]);
                    } else {
                        // Nếu không  thì tiền = depositAmount + tiền lãi
                        $this->savingAccountModel->update($savingAccount['id'], ['total_amount' => $savingAccount['depositAmount'] + $interest_each_month]);
                    }
                }
            }
        }

        $this->view('main-layout', [
            'page' => 'savingAccounts/index',
            'pageName' => 'Tiền gửi tiết kiệm',
            'savingAccounts' => $savingAccounts,
            'spendingAccounts' => $spendingAccounts
        ]);
    }

    public function add()
    {
        $spendingAccounts = $this->spendingAccountModel->getAll();

        $this->view('main-layout', [
            'page' => 'savingAccounts/add',
            'pageName' => 'Thêm tiền gửi tiết kiệm',
            'spendingAccounts' => $spendingAccounts
        ]);
    }

    public function create()
    {
        $spending_account_id = $_POST['spending_account_id'];
        $depositAmount = $_POST['depositAmount'];
        $durationInMonths = $_POST['durationInMonths'];
        $interestRate = $_POST['interestRate'];


        if ($interestRate && $durationInMonths && $depositAmount && $spending_account_id) {
            // Data saving account
            $data = ['interestRate' => $interestRate, 'durationInMonths' => $durationInMonths, 'depositAmount' => $depositAmount, 'spending_account_id' => $spending_account_id];

            // Tạo dữ liệu cho saving account
            $this->savingAccountModel->create($data);

            $spendingAccount = $this->spendingAccountModel->find($spending_account_id);

            // Lấy ra tiền từ tài khoản hiện tài
            $money = $spendingAccount['amount'] ? $spendingAccount['amount'] : $spendingAccount['initial_amount'];

            // Trừ tiền tài khoản
            if (isset($spendingAccount['amount'])) {
                $this->spendingAccountModel->update($spending_account_id, ['amount' => $money - $depositAmount]);
            } else {
                $this->spendingAccountModel->update($spending_account_id, ['initial_amount' => $money - $depositAmount]);
            }
            header("location: sayHi");
        } else {
            header("location:add");
        }
    }

    public function take_out_money()
    {
        $id = $_GET['id'];
        $total = $_POST['total'];
        $spending_account_id = $_POST['spending_account_id'];
        $spendingAccount = $this->spendingAccountModel->find($spending_account_id);

        $money = isset($spendingAccount['amount']) ? $spendingAccount['amount'] : $spendingAccount['initial_amount'];

        // Cộng tiền vào tài khoản cũ
        $this->spendingAccountModel->update($spending_account_id, ['amount' => $money + $total]);

        // Xoá tiết kiệm này đi
        $this->savingAccountModel->destroy($id);
        header("location: sayHi");
    }
}

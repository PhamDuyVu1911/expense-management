<?php
class TransactionController extends BaseController
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
        $userModel = $this->model('UserModel');
        $user_id = isset($_SESSION['login']) ? $_SESSION['login']['id'] : 0;
        $user = $userModel->find($user_id);
        // Tổng chi tiêu
        $spending_total = 0;
        // Tổng thu nhập
        $income_total = 0;

        $transactions = $this->transactionModel->getAll();
        $categories = $this->categoryModel->getAll();
        $spendingAccounts = $this->spendingAccountModel->getAll();
        $transaction_types = $this->transactionModel->getTransactionByType();

        if (count($transaction_types)) {
            foreach ($transaction_types as $transaction) {
                if ($transaction['type_transaction_id'] == 1) {
                    $income_total += $transaction['money_number'];
                } else {
                    $spending_total += $transaction['money_number'];
                }
            }
        }

        $this->view('main-layout', [
            'page' => 'transactions/index',
            'pageName' => 'Danh sách chi tiêu',
            'transactions' => $transactions,
            'categories' => $categories,
            'spendingAccounts' => $spendingAccounts,
            'spending_total' => $spending_total,
            'spending_limit' => $user['spending_limit'],
            'income_total' => $income_total
        ]);
    }



    public function add()
    {
        $categories = $this->categoryModel->getCategoryOrderBy();
        $spendingAccounts = $this->spendingAccountModel->getAll();

        $this->view('main-layout', [
            'page' => 'transactions/add',
            'pageName' => 'Thêm chi tiêu',
            'spendingAccounts' => $spendingAccounts,
            'categories' => $categories
        ]);
    }

    function create()
    {
        $money_number = $_POST['money_number'];
        $description = $_POST['description'];
        $detail = $_POST['detail'];
        $file = $_FILES['file'];
        $group_transaction_id = $_POST['group_transaction_id'];
        $spending_account_id = $_POST['spending_account_id'];

        if (
            $money_number && $group_transaction_id && $spending_account_id
        ) {
            $data = [
                'money_number' => $money_number,
                'description' => $description ? $description : 'Không có',
                'detail' => $detail ? $detail : 'Không có',
                'spending_account_id' => $spending_account_id,
                'group_transaction_id' => $group_transaction_id
            ];

            if ($file && $file['name']) {
                // format name file
                $error = [];
                $size_allow = 10;
                $fileName = $file['name'];
                $fileName = explode('.', $fileName);
                $ext = end($fileName);
                $new_file_name = md5(uniqid()) . '.' . $ext;


                //Check type file
                $allow_ext = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
                if (in_array($ext, $allow_ext)) {
                    $size = $file['size'] / 1024 / 1024;
                    if ($size <= $size_allow) {
                        $upload = move_uploaded_file($file['tmp_name'], './img_save/' . $new_file_name);
                        $data['img'] = $new_file_name;

                        if (!$upload) {
                            $error[] = 'error upload';
                        }
                    } else {
                        $error = 'size_error';
                    }
                } else {
                    $error[] = 'ext_error';
                }
            }

            $category = $this->categoryModel->find($group_transaction_id);
            $spendingAccount = $this->spendingAccountModel->find($spending_account_id);
            $type = $category['type_transaction_id'];
            if ($spendingAccount['amount']) {
                if ($type == 1) {
                    // Thu
                    $this->spendingAccountModel->update($spending_account_id, ['amount' => $spendingAccount['amount'] + (int)$money_number]);
                } else {
                    // Chi 
                    $this->spendingAccountModel->update($spending_account_id, ['amount' => $spendingAccount['amount'] - (int)$money_number]);
                }
            } else {
                if ($type == 1) {
                    // Thu
                    $this->spendingAccountModel->update($spending_account_id, ['amount' => $spendingAccount['initial_amount'] + (int)$money_number]);
                } else {
                    // Chi 
                    $this->spendingAccountModel->update($spending_account_id, ['amount' => $spendingAccount['initial_amount'] - (int)$money_number]);
                }
            }
            $this->transactionModel->create($data);
            header('location:sayHi');
        } else {
            header('location:add');
        }
    }

    public function edit()
    {
        $id = $_GET['id'];
        $spendingAccounts = $this->spendingAccountModel->getAll();
        $transaction = $this->transactionModel->find($id);
        $categories = $this->categoryModel->getCategoryOrderBy();

        $this->view('main-layout', [
            'page' => 'transactions/edit',
            'pageName' => 'cập nhật tài khoản',
            'transaction' => $transaction,
            'categories' => $categories,
            'spendingAccounts' => $spendingAccounts
        ]);
    }

    public function update()
    {
        $id = $_GET['id'];
        $money_number = $_POST['money_number'];
        $description = $_POST['description'];
        $detail = $_POST['detail'];
        $file = $_FILES['file'];
        $group_transaction_id = $_POST['group_transaction_id'];
        $spending_account_id = $_POST['spending_account_id'];

        // Old
        $transaction = $this->transactionModel->find($id);
        $spending_account = $this->spendingAccountModel->find($transaction['spending_account_id']);


        // New
        $spending_account_new = $this->spendingAccountModel->find($spending_account_id);
        $category_new = $this->categoryModel->find($group_transaction_id);
        $type_new = $category_new['type_transaction_id'];

        if ($spending_account_new['id'] != $spending_account['id']) {
            // Khác tài khoản
            if ($type_new == 1) {
                // + Thu
                // - Trừ tiền tài khoản cũ
                $this->spendingAccountModel->update($spending_account['id'], [
                    'amount' => $spending_account['amount'] - $money_number
                ]);
                //  - Cộng tiền tài khoản mới
                $this->spendingAccountModel->update($spending_account_new['id'], [
                    'amount' => $spending_account_new['amount'] + $money_number
                ]);
            } else {
                // Chi
                // - Cộng tiền tài khoản cũ
                $this->spendingAccountModel->update($spending_account['id'], [
                    'amount' => $spending_account['amount'] + $money_number
                ]);
                //  - Trừ tiền tài khoản mới
                $this->spendingAccountModel->update($spending_account_new['id'], [
                    'amount' => $spending_account_new['amount'] - $money_number
                ]);
            }
        } else {
            if ($type_new == 1) {
                // + Thu
                $this->spendingAccountModel->update($spending_account['id'], [
                    'amount' => $spending_account['amount'] - $transaction['money_number'] + $money_number
                ]);
            } else {
                // Chi
                $this->spendingAccountModel->update($spending_account['id'], [
                    'amount' => $spending_account['amount'] + $transaction['money_number'] - $money_number
                ]);
            }
        }





        $data = [];

        if ($money_number && $money_number != $transaction['money_number']) {
            $data['money_number'] = $money_number;
        }

        if ($description && $description != $transaction['description']) {
            $data['description'] = $description;
        }

        if ($detail && $detail != $transaction['detail']) {
            $data['detail'] = $detail;
        }

        if ($group_transaction_id && $group_transaction_id != $transaction['group_transaction_id']) {
            $data['group_transaction_id'] = $group_transaction_id;
        }

        if ($spending_account_id && $spending_account_id != $transaction['spending_account_id']) {
            $data['spending_account_id'] = $spending_account_id;
        }




        if ($file && $file['name']) {
            // format name file
            $error = [];
            $size_allow = 10;
            $fileName = $file['name'];
            $fileName = explode('.', $fileName);
            $ext = end($fileName);
            $new_file_name = md5(uniqid()) . '.' . $ext;

            //Check type file
            $allow_ext = ['jpg', 'png', 'gif', 'bmp', 'jpeg'];
            if (in_array($ext, $allow_ext)) {
                $size = $file['size'] / 1024 / 1024;
                if ($size <= $size_allow) {
                    $upload = move_uploaded_file($file['tmp_name'], './save_img/' . $new_file_name);
                    if ($upload) {
                        $status =  unlink('./save_img/' . $transaction['img']);
                    }
                    if (!$upload) {
                        $error[] = 'error upload';
                    }
                } else {
                    $error = 'size_error';
                }
            } else {
                $error[] = 'ext_error';
            }
            $data['img'] = $new_file_name;
        }

        if (count($data) > 0) {
            $this->transactionModel->update($id, $data);
            header("location:sayHi");
        } else {
            header("location:edit&id=${id}");
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        if ($id) {
            $transaction = $this->transactionModel->find($id);
            $spending_account = $this->spendingAccountModel->find($transaction['spending_account_id']);
            $category = $this->categoryModel->find($transaction['group_transaction_id']);
            $type = $category['type_transaction_id'];
            if ($type == 1) {
                // Thu
                // Trừ đi tiền đã cộng
                $this->spendingAccountModel->update($spending_account['id'], [
                    'amount' => $spending_account['amount'] - $transaction['money_number']
                ]);
            } else {
                // Chi
                // Hoàn lại tiền đã trừ
                $this->spendingAccountModel->update($spending_account['id'], [
                    'amount' => $spending_account['amount'] + $transaction['money_number']
                ]);
            }
            // Xoá chi tiêu
            $this->transactionModel->update($id, ['status' => 0]);
            header("location:sayHi");
        } else {
            header("location:sayHi");
        }
    }
}

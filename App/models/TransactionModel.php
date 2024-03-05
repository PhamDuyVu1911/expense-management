<?php
class TransactionModel extends BaseModel
{
    protected $tableName = 'transactions';


    public function getTransactionByAccount($id)
    {
        $sql = "SELECT * from $this->tableName where status=1 and spending_account_id = ${id}";
        $result =  $this->querySql($sql);

        return $result;
    }

    public function getTransactionByGroup($id)
    {
        $sql = "SELECT * from $this->tableName where status=1 and user_id = $this->user_id and group_transaction_id = ${id}";
        $result =  $this->querySql($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function deleteTransactionByAccount($id)
    {
        $sql = "UPDATE $this->tableName 
        SET status = 0 
        Where spending_account_id =${id} 
        AND status = 1 and user_id = $this->user_id";
        $result =  $this->querySql($sql);
    }

    public function deleteTransactionByGroup($id)
    {
        $sql = "UPDATE $this->tableName 
        SET status = 0 
        Where group_transaction_id =${id} 
        AND status = 1 and user_id = $this->user_id";
        $result =  $this->querySql($sql);
    }

    public function filterTransaction($type_transaction_id, $spending_account_id, $time_start, $time_end)
    {
        $sql = "SELECT transactions.id, transactions.money_number, transactions.time, transactions.img, transactions.description, transactions.detail, transactions.group_transaction_id, transactions.spending_account_id
        FROM transactions 
        INNER JOIN group_transactions ON transactions.group_transaction_id = group_transactions.id 
        WHERE transactions.status = 1 
        AND transactions.user_id = $this->user_id";

        if ($spending_account_id !== 0) {
            $sql .= " AND spending_account_id = $spending_account_id";
        }
        if ($type_transaction_id !== 0) {
            $sql .= " AND group_transactions.type_transaction_id = $type_transaction_id";
        }
        if ($time_start !== 0 && $time_end !== 0) {
            $sql .= " AND DATE(transactions.time) BETWEEN '$time_start' AND '$time_end'";
        }

        $result = $this->querySql($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function getTransactionByType()
    {
        $sql = "SELECT transactions.id, transactions.money_number, transactions.time, transactions.img, transactions.description, transactions.detail, transactions.group_transaction_id, transactions.spending_account_id, group_transactions.type_transaction_id
        FROM transactions, group_transactions 
        WHERE transactions.group_transaction_id = group_transactions.id 
        AND transactions.status = 1 
        AND transactions.user_id = $this->user_id
        ";

        $result = $this->querySql($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }
}

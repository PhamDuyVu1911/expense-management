<?php
class CategoryModel extends BaseModel
{
    protected $tableName = 'group_transactions';



    public function getCategoryOrderBy()
    {
        $sql = "SELECT * FROM $this->tableName Where status=1 and user_id = $this->user_id ORDER BY group_transactions.type_transaction_id";
        $result =  $this->querySql($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function getCategoryByType($type)
    {
        $sql = "SELECT * FROM group_transactions WHERE status=1 and user_id = $this->user_id AND group_transactions.type_transaction_id = ${type}";
        $result =  $this->querySql($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }
}

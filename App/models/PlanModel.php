<?php
class PlanModel extends BaseModel
{
    protected $tableName = 'spending_plans';




    public function getPlanByGroup($id)
    {
        $sql = "SELECT * from $this->tableName 
        Where group_transaction_id =${id} 
        AND status = 1 and user_id = $this->user_id";
        $result =  $this->querySql($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function deletePlanByGroup($id)
    {
        $sql = "UPDATE $this->tableName 
        SET status = 0 
        Where group_transaction_id =${id} 
        AND status = 1 and user_id = $this->user_id";
        $result =  $this->querySql($sql);
    }
}

<?php
class Saving_accountModel extends BaseModel
{
    protected $tableName = 'saving_accounts';

    public function deleteSavingAccountByAccount($id)
    {
        $sql = "UPDATE $this->tableName 
        SET status = 0 
        Where spending_account_id =${id} 
        AND status = 1 and user_id = $this->user_id";
        $result =  $this->querySql($sql);
    }
}

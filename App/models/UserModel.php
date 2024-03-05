<?php
class UserModel extends BaseModel
{
    protected $tableName = 'users';


    public function findEmail($email)
    {
        $sql = "SELECT * FROM $this->tableName WHERE email = '${email}' Limit 1";
        $result =  $this->querySql($sql);
        return  mysqli_fetch_assoc($result);
    }
}

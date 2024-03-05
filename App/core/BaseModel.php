<?php
class BaseModel extends Database
{
    protected $connect;
    protected $tableName;

    protected $user_id;


    public function __construct()
    {
        $this->connect = $this->HandleConnect();
        $this->user_id =  isset($_SESSION['login']) ? $_SESSION['login']['id'] : 0;
    }

    public function getAll($select = ['*'], $orderBy = [])
    {

        $columns = implode(', ', $select);
        $orderByString = implode(' ', $orderBy);
        if ($orderByString) {
            $sql = "
                SELECT ${columns} 
                FROM $this->tableName 
                where status = 1 and user_id = $this->user_id
                ORDER BY ${orderByString} 
                ";
        } else {
            $sql = "
                SELECT ${columns} 
                FROM $this->tableName 
                where status = 1 and user_id = $this->user_id
            ";
        }

        $query = $this->_query($sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($data, $row);
        }
        return $data;
    }

    public function find($id)
    {
        $sql = "SELECT * FROM $this->tableName Where id = ${id}";
        $query = $this->_query($sql);
        return mysqli_fetch_assoc($query);
    }


    public function findOne($field, $value)
    {
        $sql = "SELECT * 
        FROM $this->tableName
        WHERE $this->tableName.${field} = '%${value}%' 
        AND $this->tableName.status = 1 LIMIT 1";
        $query = $this->_query($sql);
        return  mysqli_fetch_assoc($query);
    }



    public function create($data)
    {
        function handleString($value)
        {
            return "'" . $value . "'";
        }
        $valueString = array_map('handleString', array_values($data));
        $columns = implode(', ', array_keys($data));
        $newValue = implode(', ', $valueString);
        $sql = "
            INSERT INTO $this->tableName(${columns},user_id) 
            VALUE(${newValue}, $this->user_id)
        ";


        $this->_query($sql);
    }


    public function createAuth($data)
    {
        function handleStringAuth($value)
        {
            return "'" . $value . "'";
        }

        $valueString = array_map('handleStringAuth', array_values($data));
        $columns = implode(', ', array_keys($data));
        $newValue = implode(', ', $valueString);
        $sql = "
            INSERT INTO $this->tableName(${columns}) 
            VALUE(${newValue})
        ";
        $this->_query($sql);
    }


    public function update($id, $data)
    {
        $dataSet = [];
        foreach ($data as $key => $value) {
            array_push($dataSet, "${key} = '${value}'");
        }
        $dataSetString = implode(', ', $dataSet);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s');
        $sql = "UPDATE $this->tableName SET ${dataSetString}, update_at='${date}' WHERE id = ${id}";
        $this->_query($sql);
    }

    public function destroy($id)
    {
        $sql = "UPDATE $this->tableName SET status = 0 WHERE id = ${id}";
        $this->_query($sql);
    }

    public function querySql($sql)
    {
        $query = $this->_query($sql);
        return $query;
    }

    private function _query($sql)
    {
        return mysqli_query($this->connect, $sql);
    }
}

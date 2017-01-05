<?php
class Database
{
    private static $INSTANCE;
    private $mysqli,
    $HOST = "localhost",
    $USER = "root",
    $PASS = "",
    $DB   = "db_users";

    public function __construct()
    {
        $this->mysqli = new mysqli($this->HOST, $this->USER, $this->PASS, $this->DB);
        if (mysqli_connect_error()) {
            return mysqli_errno();
        }
    }
    public static function getInstance()
    {
        if (!isset(self::$INSTANCE)) {
            self::$INSTANCE = new Database();
        }

        return self::$INSTANCE;
    }

    public function insert($table, $field = array())
    {
        $column   = implode(", ", array_keys($field));
        $valueArr = array();
        $i=0;
        foreach ($field as $key => $value) {
            if (is_int($value)) {
                $valueArr[$i] = $this->escape($value);
            }else{
                $valueArr[$i] = "'".$this->escape($value)."'";
            }
        $i++;
        }
        $values = implode(",", $valueArr);
        $query  = "INSERT INTO $table ($column) VALUES ($values)";
        return $this->run_query($query);

    }
	
	public function update($table, $field = array(), $id)
    {
        $valueArr = array();
        $i=0;
		foreach ($field as $key => $value) {
            if (is_int($value)) {
                $valueArr[$i] = $key. "=" .$this->escape($value);
            }else{
                $valueArr[$i] = $key. "='" .$this->escape($value) ."'";
            }
        $i++;
        }
        $values = implode(",", $valueArr);
        $query  = "UPDATE $table SET $values WHERE id=$id";
		return $this->run_query($query);

    }

    public function delete($table, $id)
    {
        $query = "DELETE FROM $table WHERE id = $id";
        return $this->mysqli->query($query);
    }
	
    public function get_info($table, $field = '', $value = '')
    {   
        
		if ($field != ''){
			$value = $this->escape($value);
			if ( !is_int($value) ){
				$value = "'". $value ."'";
			}
			$query = "SELECT * FROM $table WHERE $field = $value";
			$result = $this->mysqli->query($query);

			while($row = $result->fetch_assoc()){
				return $row;
			}
		} else {
			$query = "SELECT * FROM $table";
			$result = $this->mysqli->query($query);
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}

    }
    public function run_query($query)
    {
        if ($this->mysqli->query($query)) return true;
        else return false;
    }
    public function escape($value)
    {
        return $this->mysqli->real_escape_string($value);
    }
}
// new Database();
?>
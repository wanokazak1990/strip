<?php 
namespace app\core;
Class Model 
{	
	protected $db;
	public $table = "";

	public function __construct($data=array())
	{
		$table = get_class($this);//получаем имя класса из пространства имен
		$table = explode('\\', $table);//разбиваем пространство имён с именем класса на массив
		$table = array_pop($table);//последнее значение и есть оригинальное имя класса
		$this->table = $table;//свойсто table устанавливаеи имя класса
		$this->db = DB::getInstant();//запскаем прповерку на подключение базы
		$this->setVariableModel();//заводим свойства класса из столбов таблицы
		$this->setVariable($data);//Устанавливаем в свойства значения
	}

	//функция которая создаёт переменные модели по имени столбца 
	public function setVariableModel()
	{
		try
		{
			$sql = "SHOW COLUMNS FROM $this->table";
			$result = $this->db->query($sql);
			if($result)
			{
				$result->setFetchMode(\PDO::FETCH_ASSOC);
				$result = $result->fetchAll();
				foreach ($result as $key => $value) {
					$temp = $value['Field'];
					$this->$temp = NULL;
				}
				return 1;
			}	

		}
		catch (PDOException $e) 
		{
			echo "Error".$e->getMessage();
		}
	}

	public function setVariable($data=array())
	{
		if(!empty($data))
		{
			foreach ($data as $key => $value) {
				foreach ($this as $i => $item) {
					
					if($i == $key) $this->$key = $value;
				}
			}
		}
	}

	public function getParam($param)
	{
		return $this->$param;
	}
	
	

	public function getAll()
	{
		try
		{
			$r_data = false;
			$sql = "SELECT * FROM {$this->table}";
			$result = $this->db->query($sql);
			$result->setFetchMode(\PDO::FETCH_ASSOC);
			$result = $result->fetchAll();
			if(count($result)>0)
			{
				foreach ($result as $row) {
					$Class_name = get_called_class();
					$class = new $Class_name();
					$class->setVariable($row);
					$r_data[] = $class;
				}
			}
			return $r_data;
		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}

	public function getRowById($id)
	{
		$id = intval($id);
		try
		{
			$sql = "SELECT * FROM $this->table WHERE id = ?";
			$result = $this->db->prepare($sql);
			$result->bindValue(1,$id,\PDO::PARAM_INT);
			$result->execute();
			$result->setFetchMode(\PDO::FETCH_ASSOC);
			$result = $result->fetch();
			
			if(count($result)>1)
			{
				$this->setVariable($result);
				return true;
			}

			return false;
		}
		catch (PDOException $e) 
		{
			echo "Error".$e->getMessage();
		}
	}

	public function getById($id)
	{
		$r_data = array();
		try
		{
			$sql = "SELECT * FROM $this->table WHERE id = ? LIMIT 1";
			$result = $this->db->prepare($sql);
			$result->bindValue(1,$id,\PDO::PARAM_INT);
			$result->execute();
			$result->setFetchMode(\PDO::FETCH_ASSOC);
			$result = $result->fetchAll();

			if($result)
			{
				foreach ($result as $row) {
					$Class_name = get_called_class();
					$class = new $Class_name($row);
					$r_data[] = $class;
				}
				return $r_data[0];
			}
		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}		
	}

	public function getCustomSQL($sql,$data=array())
	{
		try{
			$r_data = false;
			if($data!=false)
			{
				$result = $this->db->prepare($sql);
				for ($i=0; $i<count($data); $i++)
				{
					if(is_numeric($data[$i])) $result->bindValue($i+1, $data[$i], \PDO::PARAM_INT);
					else $result->bindValue($i+1, $data[$i], \PDO::PARAM_STR); 
				}
				$result->execute();
			}
			else
			{
				$result = $this->db->query($sql);
			}

			if($result!=false)
			{
				if(count($result)>0)
				{
					$result->setFetchMode(\PDO::FETCH_ASSOC);
					$result = $result->fetchAll();
					foreach ($result as $row) {
						$Class_name = get_called_class();
						$class = new $Class_name($row);
						//$class->setVariable($row);
						$r_data[] = $class;
					}
					return $r_data;
				}
			}

			return false;

		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}
	
	public function getCustomSQLNonClass($sql,$data=false)
	{
		try
		{
			$mas = false;
			if($data!=false)
			{
				$result = $this->db->prepare($sql);
				for($i=0;$i<count($data);$i++)
				{
					if(is_numeric($data[$i])) $result->bindValue($i+1, $data[$i], \PDO::PARAM_INT);
					else $result->bindValue($i+1, $data[$i], \PDO::PARAM_STR); 
				}
				$result->execute();
			}
			else
			{
				$result = $this->db->query($sql);
			}
			if($result!=false)
			{
				
					$result->setFetchMode(\PDO::FETCH_ASSOC);
					$result = $result->fetchAll();
					foreach ($result as $key => $row) {
						$mas[] = $row;
					}
				
			}
			return $mas;
		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}

	/*вернёт названия столбцов*/
	public function getColumnsName()
	{
		$columnName = false;
		try
		{
			$sql = "SHOW COLUMNS FROM $this->table";
			$result = $this->db->query($sql);
			$result->setFetchMode(\PDO::FETCH_ASSOC);
			$result = $result->fetchAll();
			foreach ($result as $key => $value) {
				$columnName[] = $value['Field'];
			}
			return $columnName;

		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}

	/*
	/*Добавляет в базу запись
	/*таблица выбирается, в зависимости от класса вызывающую эту функцию
	/*данные для добавления беруться из свойств объекта
	/**/
	public function insertData()
	{
		$sql_columns = '';//нужна чтобы создать запрос в бд, храннит названия столбцов
		$i = 0;
		$sql_patterns = '';//Хранит вопросительные знаки, паттерны для пдо драйвера, подготовленного запроса
		$sql_values = array();

		try{
			$table_col = $this->getColumnsName();

			foreach ($this as $key => $value) {
				foreach ($table_col as $col => $name) {
					if(($key == $name) && ($key != 'id') && ($value!=''))
					{
						$sql_columns 	.= " {$name},";
						$sql_patterns 	.= " ?,";
						$sql_values[] 	 = $value;
					}
				}
			}
			$sql_columns 	= substr($sql_columns, 	0,-1);
			$sql_patterns 	= substr($sql_patterns, 0,-1);

			$sql_columns  = "(".$sql_columns .")";
			$sql_patterns = "(".$sql_patterns.")";

			if(empty($sql_patterns)) return false;
			if(empty($sql_columns)) return false;

			$sql = "INSERT INTO $this->table {$sql_columns} VALUES {$sql_patterns}";

			$result = $this->db->prepare($sql);
			//echo $sql;
			for($i=0; $i<count($sql_values);$i++) {
				$result->bindValue($i+1,$sql_values[$i], \PDO::PARAM_STR);
				//echo "<br/>".$sql_values[$i]."<br/>";
			}
			if($result -> execute()) return $this->db->lastInsertId();
			else return false;

		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}

	public function updateData()
	{
		$sql_values = array();//массив содержит добовляемые значения
		$sql_patterns = '';
		$sql_id = '';
		try
		{
			$table_col = $this->getColumnsName();
			foreach ($this as $key => $value)
			{
				foreach ($table_col as $col => $name)
				{
					if(($key == $name) && ($key != 'id') && ($value!=''))
					{
						$sql_patterns .= $name.' = ?,';
						$sql_values[] 	 = $value;
					}
				}
			}
			$sql_patterns = substr($sql_patterns, 0,-1);
			$sql = "UPDATE $this->table SET ".$sql_patterns." WHERE id = ?";
			$result = $this->db->prepare($sql);
			//echo "$sql";
			//Html::prA($sql_values);
			for($i=0; $i<count($sql_values); $i++)
			{
				$result->bindValue($i+1, $sql_values[$i], \PDO::PARAM_STR);
			}
			$result->bindValue(count($sql_values)+1, $this->id, \PDO::PARAM_INT);

			return $result->execute();
		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}

	public function deleteData($name="",$param="")
	{
		try
		{
			if(empty($name)) :
				$sql = "DELETE FROM {$this->table} WHERE id = {$this->id}";
				$res = $this->db->query($sql);
			else :
				$sql = "DELETE FROM {$this->table} WHERE {$name} = {$param}";
				$res = $this->db->query($sql);
			endif;
		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}

	public function clearTable()
	{
		try
		{
			$sql = "DELETE FROM {$this->table} ";
			$res = $this->db->query($sql);
		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}

	public function getRowByParam($name,$value)
	{
		try
		{
			$sql = "SELECT * FROM $this->table WHERE $name = ?";
			$result = $this->db->prepare($sql);
			if(is_numeric($value))
				$result->bindValue(1,$value,\PDO::PARAM_INT);
			else
				$result->bindValue(1,$value,\PDO::PARAM_STR);
			$result->execute();
			$result->setFetchMode(\PDO::FETCH_ASSOC);
			$result = $result->fetch();
			
			if(count($result)>1)
			{
				$this->setVariable($result);
				return true;
			}

			return false;
		}
		catch (PDOException $e) 
		{
			echo "Error".$e->getMessage();
		}
	}

	public function getAllByParam($name="",$param="", $limit="")
	{
		try
		{
			$r_data = array();
			$str = "";
			if($name)
				$str = " WHERE {$name} = ?";
			if($limit)
				$str = $str.' LIMIT '.$limit;
			$sql = "SELECT * FROM {$this->table} {$str}";
			$result = $this->db->prepare($sql);
			if(is_numeric($param))
				$result->bindValue(1,$param,\PDO::PARAM_INT);
			else
				$result->bindValue(1,$param,\PDO::PARAM_STR);
			$result->execute();
			$result->setFetchMode(\PDO::FETCH_ASSOC);
			$result = $result->fetchAll();
			if(count($result)>0)
			{
				foreach ($result as $row) {
					$Class_name = get_called_class();
					$class = new $Class_name();
					$class->setVariable($row);
					$r_data[] = $class;
				}
			}
			return $r_data;
		}
		catch (PDOException $e)
		{
			echo "Error".$e->getMessage();
		}
	}

	public function getCount($param = "id",$option=array())
	{
		$option = array_slice($option,0,1);
		$str = "";
		if($option)
			$str = "WHERE ".key($option)."=".$option[key($option)];
		$sql = "SELECT count({$param}) as total FROM {$this->table} {$str}";
		$result = $this->db->query($sql);
		$result->setFetchMode(\PDO::FETCH_ASSOC);
		$result = $result->fetch();
		return $result['total'];
	}
}
<?php

class DataBase{
    private $dbHost;
	private $dbUser;
	private $dbPass;
	private $dbName;
	private $DbCon;
    
    privat $connection;
    
    public function __construct($dbHost,$dbUser,$dbPass,$dbName){
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbPass = $dbPass;
        $this->dbName = $dbName;
    }
    
    public function connect(){
		$con = new mysqli($this->dbHost,$this->dbUser,$this->dbPass,$this->dbName);
		
		if($con){
			$this->DbCon=$con;
			return "DataBase connection Succeed";
		}else{
			return "DataBase connection failed!";
		}
	}
    
    //select 
    public function select($table,$row="*",$where=null,$order=null){
		$query='SELECT '.$row.' FROM '.$table;
		if($where!=null){
			$query.=' WHERE '.$where;
		}
		if($order!=null){
			$query.=' ORDER BY '.$order;
		}
		$result=$this->DbCon->query($query);
         
        $resultCheck = mysqli_num_rows($result);
    
        if($resultCheck>0){
            while($row = mysqli_fetch_assoc($result)){
                echo $row['name'] ."<br>";
            }
        
        }else{
            echo "no results";
        }

	}
    
    //insert
    	public function insert($table,$value,$row=null){
		$insert= " INSERT INTO ".$table;
		if($row!=null){
			$insert.=" (". $row." ) ";
		} 
		for($i=0; $i<count($value); $i++){
			if(is_string($value[$i])){
				$value[$i]= '"'. $value[$i] . '"';
			}
		}
		$value=implode(',',$value);
		$insert.=' VALUES ('.$value.');';
		$ins=$this->DbCon->query($insert); 
		if($ins){
			 echo "New insert created successfully";
		}else{
			return "error when try to insert";
		}
	}
    
    //delete
    public function delete($table,$where=null){
              echo "del";
		if($where == null)
            {
                $delete = "DELETE ".$table;
            }
            else
            {
                $delete = "DELETE FROM ".$table." WHERE ".$where;
            }
			$del=$this->DbCon->query($delete);
			if($del){
                echo "delete successfully";
			}else{
                echo "error when try to delete";
			}
	}
    
    
    //update
    public function update($table,$rows,$where){
        echo "Fd";
            for($i = 0; $i < count($where); $i++)
            {
                if($i%2 != 0)
                {
                    if(is_string($where[$i]))
                    {
                        if(($i+1) != null)
                            $where[$i] = '"'.$where[$i].'" AND ';
                        else
                            $where[$i] = '"'.$where[$i].'"';
                    }
                }
            }
            $where = implode(" ",$where);
            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]]))
                {
                    $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }

                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
            $update .= ' WHERE '.$where;
            echo $update;
            $query = $this->DbCon->query($update);

            if($query)
            {
                return "updated successfully";
            }
            else
            {
                return "error when try to update";
            }
	    
         }
    
    
    
}
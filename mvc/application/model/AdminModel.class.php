<?php

// application/model/AdminModel.class.php

class AdminModel extends Model{

    
    public function getAdmin($name,$pwd){
               
        $sql = "select user_id FROM `{$this->table}` WHERE user_name = '$name' and password = '$pwd'";
        
        //echo $sql;
        
        $adminId = $this->db->getAll($sql);

        return $adminId;

    }

}

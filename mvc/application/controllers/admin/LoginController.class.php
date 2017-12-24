<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author autumnzest
 */
class LoginController {
    public function logAction(){

        // Load View template

        include  CURR_VIEW_PATH . "main.html";
        //include CURR_VIEW_PATH . "main.html";
        $this->loginCheck();
        
    }
    
        public function loginCheck(){
          $adminname=$_POST[adminname];  //接收提交的用户名 
          $adminpwd=MD5($_POST[adminpwd]);   //接收提交的密码 
          //$adminpwd=$_POST[adminpwd];
          if(trim($adminname)==""||trim($adminpwd)=="") 
           { 
            echo "<script>alert('请输入用户名或用户密码!');history.back();</script>"; 
            exit; 
           }else{
               $adminModel = new AdminModel("admin_list");
               $result = count($adminModel->getAdmin($adminname,$adminpwd));
               if($result!=0){
                   include  CURR_VIEW_PATH . "manage.html";
               }
               else{
                   echo "<script>alert('admin not exist!');history.back();</script>"; 
                   exit;
               }
           }
           
    }
}



<?php
    class Register_Model extends Model{
        public function __construct() {
            parent::__construct();
        }
        
         public function do_register()
         {
             $this->db->debug = 1;
                if (isset($_POST)){
                    $email=$_POST['txtEmail'];
                    $pass=$_POST['txtPass'];
                    $name=$_POST['txtName'];
                    $phone=$_POST['txtPhone'];
                    $add=$_POST['txtAdd'];
                    $age=$_POST['txtAge'];
                    $gender=$_POST['txtGender'];
                    $find_email= $this->db->getOne("SELECT COUNT(*) FROM t_cms_person WHERE C_EMAIL=?",array($email));
                    if($find_email=0){
                        
                        $v_msg=$this->db->Execute("INSERT INTO 
                        t_cms_person(C_NAME,C_EMAIL,C_PASS,C_BIRTH,C_GENDER,C_ADDRESS,C_PHONE) 
                        VALUE(?,?,?,?,?,?,?)",array($name,$email,$pass,$age,$gender,$add,""));
                    return $v_msg;
                    }
                    else{
                       echo "<script>alert('Email đã tồn tại!');</script>";
                       return FALSE;
                    }
                }
         }
    }
?>
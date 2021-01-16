<?php
    class Model{
        private $localhost = 'localhost';
        private $username = 'root';
        private $password = '';
        private $db_name = 'expenditure';
        private $conn;

        public function __construct(){
            try {
                $this-> conn = new mysqli($this->localhost,$this->username,$this->password,$this->db_name);
            } catch (Exception $e) {
                echo "error making connection".$e;
            }
        }

        // login form method
        public function login($email,$password){
            // error message 
            $error = '';
            $query = "SELECT * FROM `users` WHERE email = ? LIMIT 1";
				$stmt = $this->conn->prepare($query);
				$stmt->bind_param('s',$email);
				if($stmt->execute()){
					$result = $stmt->get_result();
					if (mysqli_num_rows($result) > 0) {
                        $fetch = $result->fetch_assoc();
						//check if the passwords match
						if ($fetch['password'] == md5(md5($password).$fetch['id'])) {
							//setting the session id
							$_SESSION['id'] = $fetch['id'];
							// setting session username
							$_SESSION['username'] = $fetch['username'];
							//redirect to the dashboard if the passwords match
							header('location:admin/dashboard.php');
						}
						else{
							$error = '<div class="alert alert-danger">Incorrect Email or Password</div>';
						}
					}
					else{
						$error = '<div class="alert alert-danger">Incorrect Email or Password </div>';
					}
				}
            echo $error;
        }
        // signup form method
        public function signup($name,$email,$username,$password,$c_password){
            $error = '';
           
            // check if email already exists
            $check_mail = "SELECT id FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($check_mail);
            $stmt->bind_param('s',$email);
            if($stmt->execute()){
                $result = $stmt->get_result();
                if (mysqli_num_rows($result) > 0) {
                    $error = '<div class="alert alert-danger" role="alert">Email already exists for another user </div>';
                }
                else if ($password !== $c_password) {
                    $error = '<div class="alert alert-danger" role="alert">Passwords do not match! </div>';
                }
                else{
                    $query = "INSERT INTO users(`fullname`,username,email,`password`) VALUES(?,?,?,?)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param('ssss',$name,$username,$email,$password);
                    if ($stmt->execute()){
                        // // select id of the inserted  user
                        $user_id = mysqli_insert_id($this->conn);
                        // // update the password to make it more secured
                        $strong_pass = md5(md5($password).$user_id);
                        // update the password
                        $update_pass = "UPDATE users SET `password` = ? WHERE id = ? LIMIT 1";
                        $stmt = $this->conn->prepare($update_pass);
                        $stmt->bind_param('si',$strong_pass,$user_id);
                        if($stmt->execute()){
                            // error message
                            $error = '<div class="alert alert-success" role="alert">Registered successfully! </div>';
                        }
                        else {
                            // error message
                            $error = '<div class="alert alert-danger" role="alert">An error occured! </div>';
                        }
                        
                    }
                    else{
                        $error = '<div class="alert alert-danger" role="alert">Error registering, try later! </div>';
                    }
                }
            }
            echo $error;
        }
    }
?>
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
                echo "error making connection".$e->getMessage();
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
        public function signup($name,$email,$username,$password,$c_password,$number,$image){
            $error = '';
            error_reporting(E_ALL);

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
                else if (!preg_match("!image!",$_FILES['image']['type'])) {
                    $error = '<div class="alert alert-danger" role="alert">Error! not an image </div>';
                }
                else{
                    $image_exp = explode('.',$_FILES['image']['name']);
                    $image_path = "images/". round(microtime(true)) . '.' .strtolower(end($image_exp));
                    move_uploaded_file($_FILES['image']['tmp_name'],$image_path);
                    $query = "INSERT INTO users(`fullname`,username,email,`password`,phone_num,image_dir) VALUES(?,?,?,?,?,?)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param('ssssis',$name,$username,$email,$password,$number,$image_path);
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

        // fetching user data
        public function user_data($id){
            error_reporting(E_ALL);

            // setting the error message to empty
            $error = '';
            // setting the data to null
            $data = null;
            $query = "SELECT * FROM users WHERE id =? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i',$id);
            if ($stmt->execute()){
               while($result = $stmt->get_result()){
                $data[] = $result->fetch_assoc();
               }  
            }
            else{
                $error = '<div class="alert alert-danger" role="alert">Error fetching user data! </div>'.mysqli_error($this->conn);
            }
            return $data;
            echo $error;
        }

        // update the user data
        public function update_data($id,$name,$email,$username,$password,$c_password,$number){
            // set the error message
            $error = '';
            if (isset($_POST['submit'])) {
               
                // check if the password match
                if ($password !== $c_password) {
                    $error = '<div class="alert alert-danger" role="alert">Passwords do not match! </div>';
                }
                else{
                    // set the strong password
                    $strong_pass = md5(md5($password).$id);
                    // update the password
                    $update = "UPDATE users SET fullname = ?,username = ?,email = ?,phone_num = ?,`password` = ? WHERE id = ? LIMIT 1 ";
                    $stmt =  $this->conn->prepare($update);
                    $stmt->bind_param('sssisi',$name,$username,$email,$number,$password,$id);
                    if ($stmt->execute()){
                        $error = '<div class="alert alert-success" role="alert">Profile updated successfully! </div>';
                        // header('location:profile.php');
                    }
                    else {
                        $error = '<div class="alert alert-danger" role="alert">Error updating profile! </div>';
                    }
                }
            }
            echo $error;
        }

        // fetch profile details
        public function profile_det($id){
            $data = null;
            $query = "SELECT * FROM users WHERE id =?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i',$id);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                while ($fetch = $result->fetch_assoc()){
                    $data[] = $fetch;
                } 
            }
            return $data;
        }

        // profile image update functionality
        public function update_img($id,$image){
            // setting error message
            $error = '';
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {// if the request method is post
                if (empty($image)) {
                    $error = '<div class="alert alert-danger" role="alert"> No image selected! </div>';
                }
                else if (!preg_match("!image!",$_FILES['image']['type'])) {
                    $error = '<div class="alert alert-danger" role="alert">Error! Not image </div>';
                }
                else {
                    $image_exp = explode('.',$_FILES['image']['name']);
                    $image_path = "../images/". round(microtime(true)) . '.' .strtolower(end($image_exp));
                    // image path for the db to match the other images path in the signup
                    $db_path = "images/". round(microtime(true)) . '.' .strtolower(end($image_exp));
                    if (move_uploaded_file($_FILES['image']['tmp_name'],$image_path)){// if the image is moved to the folder
                        // update the image path in the database
                        $update = "UPDATE users SET image_dir = ? WHERE id = ? LIMIT 1";
                        $stmt = $this->conn->prepare($update);
                        $stmt->bind_param('si',$db_path,$id);
                        if ($stmt->execute()) {
                            $error = '<div class="alert alert-success" role="alert">Image uploaded successfully! </div>';
                        }
                        else {
                            $error = '<div class="alert alert-danger" role="alert">Error updating image! </div>';
                        }   
                    } 
                   
                }
                // echo $error . mysqli_error($this->conn);
            } 
            echo $error;
            }

            // category method
        public function add_cat($cat_name,$cat_type,$user_id){
            $error = '';
            $cat_name = ucwords($cat_name);
            // check if the category already exists
            $check = "SELECT id FROM categories WHERE category_name = ? AND (user_id = ? && cat_type = ?) ";
            $stmt = $this->conn->prepare($check);
            $stmt->bind_param('sis',$cat_name,$user_id,$cat_type);
            if ($stmt->execute()){
                $result = $stmt->get_result(); 
                // check if the category is found
                if (mysqli_num_rows($result) > 0) {
                    $error = '<div class="alert alert-danger" role="alert"> category already exists! </div>';    
                }
                else{
                    $query = "INSERT INTO categories (category_name,cat_type,user_id) VALUES(?,?,?)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bind_param('ssi',$cat_name,$cat_type,$user_id);
                    if ($stmt->execute()){
                        $error = '<div class="alert alert-success" role="alert">category added successfully! </div>';
                    }
                    else{
                        $error = '<div class="alert alert-danger" role="alert">error adding category ! </div>';
                    }
                }
            }
            echo $error;
        }

            // manage categories method
        public function manage_categories($user_id){
            $data = null;
            $query = "SELECT * FROM categories WHERE user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i',$user_id);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                while ($fetch = $result->fetch_assoc()) {
                    $data[] = $fetch;
                }
            }
            return $data;
        }

            // creating category update
        public function cat_update($id,$name,$user_id){
            $error = null;
            $query = "UPDATE categories SET category_name = ? WHERE id = ? AND user_id = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('sii',$name,$id,$user_id);
            if($stmt->execute()){
                $error = '<div class="alert alert-success">category updated successfully!</div>';
            }
            else {
                $error = '<div class="alert alert-danger">Error updating category try later!</div>';
            }
            echo $error;
        }

        // fetch category
        public function fetch_cat($type,$user_id){
            $data = null;
            $query = "SELECT * FROM categories WHERE cat_type = ? AND user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('si',$type,$user_id);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                while ($fetch = $result->fetch_assoc()){
                    $data[] = $fetch;
                }
            }
            return $data;
        }

        // add expenses method
        public function add_exp($user_id,$name,$amount,$date,$description,$category,$place){
            $error = '';
            $query = "INSERT INTO expenses(user_id,exp_name,exp_date,exp_amount,exp_desc,exp_cat,place) VALUES(?,?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('ississs',$user_id,$name,$date,$amount,$description,$category,$place);
            if($stmt->execute()){
                $error = '<div class="alert alert-success">Expense added successfully!</div>';
            }
            else {
                $error = '<div class="alert alert-danger">Error adding expense!</div>';
            }
            echo $error;
        }
        
        // manage expenditure method
        public function manageExp($user_id){
            $data = null;
            $query = "SELECT * FROM expenses WHERE user_id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i',$user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($fetch = $result->fetch_assoc()){
                $data[] = $fetch;
            }
            return $data;
        }
        //creating category edit method
		public function edit_cat($id){
            $data = null;
            //check if the get variable is category
			if (isset($_GET['cat'])) {
				$query = "SELECT * FROM categories WHERE id= ? LIMIT 1";
				$stmt = $this->conn->prepare($query);
				$stmt->bind_param('i',$id);
				if($stmt->execute()){
					$result = $stmt->get_result();
					while ($fetch = $result->fetch_assoc()) {
						$data[] = $fetch;
					}
				}
            }
            return $data;
        }

        // creating edit expenses method
        public function edit($id,$user_id){
            $data = null;
            //check if the get variable is expenses
			if (isset($_GET['exp'])) {
				$query = "SELECT * FROM expenses WHERE id= ? AND user_id = ? LIMIT 1";
				$stmt = $this->conn->prepare($query);
				$stmt->bind_param('ii',$id,$user_id);
				if($stmt->execute()){
					$result = $stmt->get_result();
					while ($fetch = $result->fetch_assoc()) {
						$data[] = $fetch;
					}
				}
            }
            return $data;
        }
        // update method
        public function update($id,$user_id,$name,$amount,$date,$description,$category,$place){
            $error = '';
            $query = "UPDATE expenses SET exp_name = ?,exp_date = ?,exp_amount = ?,exp_desc = ?,exp_cat = ?, place = ? WHERE id = ? AND user_id = ? LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('ssisssii',$name,$date,$amount,$description,$place,$category,$id,$user_id);
            if($stmt->execute()){
                $error = '<div class="alert alert-success">expenses updated successfully!</div>';
            }
            else {
                $error = '<div class="alert alert-danger">Error updating expenses try later!</div>';
            }
            echo $error;
			 
        }
        // deleting method
        public function delete($id,$user_id){
			$error = '';
        	    //check if category id is set
            if (isset($_GET['cat'])) {
				$query = "DELETE FROM categories WHERE id = ? AND user_id = ? LIMIT 1";
				$stmt = $this->conn->prepare($query);
				$stmt->bind_param('ii',$id,$user_id);
				if($stmt->execute()){
					header('location:categories.php');
				}
				else {
					$error = '<div class="alert alert-danger">Error deleting category!</div>';
				}
            }
            else if (isset($_GET['exp'])) {
				$query = "DELETE FROM expenses WHERE id = ? AND user_id = ? LIMIT 1";
				$stmt = $this->conn->prepare($query);
				$stmt->bind_param('ii',$id,$user_id);
				if($stmt->execute()){
					header('location:expenses.php');
				}
				else {
					$error = '<div class="alert alert-danger">Error deleting expenses!</div>';
				}
            }
            return $error;
        }

        // weekly report analysis
        public function weekly($user_id){
            $data = null;
            $query = "SELECT * FROM expenses WHERE user_id =? AND WEEK(exp_date) = WEEK(CURRENT_DATE())";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i',$user_id);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                while ($fetch = $result->fetch_assoc()) {
                    $data[] = $fetch;
                }
            }
            return $data;
        }

        // monthly report analysis
        public function monthly($user_id){
            $data = null;
            $query = "SELECT * FROM expenses WHERE user_id =? AND MONTH(exp_date) = MONTH(CURRENT_DATE())";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i',$user_id);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                while ($fetch = $result->fetch_assoc()) {
                    $data[] = $fetch;
                }
            }
            return $data;
        }
        
        // yearly report analysis
        public function yearly($user_id){
            $data = null;
            $query = "SELECT * FROM expenses WHERE user_id =? AND YEAR(exp_date) = YEAR(CURRENT_DATE())";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('i',$user_id);
            if ($stmt->execute()){
                $result = $stmt->get_result();
                while ($fetch = $result->fetch_assoc()) {
                    $data[] = $fetch;
                }
            }
            return $data;
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenditure | Sign Up</title>
    <link rel="stylesheet" href="vendors/css/style.css">
    <link rel="stylesheet" href="vendors/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/css/all.css">
</head>
<body class="bg-secondary">

    <div class="container mt-3">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 bg-white shadow p-2 m-2 mt-5" style="border-radius:10px;">
                <div class="">
                <?php
                    include 'model/modal.php';
                    if (isset($_POST['signup'])) {
                        $name = strip_tags($_POST['name']);
                        $email = strip_tags($_POST['email']);
                        $username = strip_tags($_POST['username']);
                        $password = md5($_POST['password']);
                        $c_password = md5($_POST['c_password']);
                        $number = strip_tags($_POST['number']);
                        $image = $_FILES['image'];
                        $model = new Model;
                        $model->signup($name,$email,$username,$password,$c_password,$number,$image);
                    }

                ?>
                    <form class="form-group" enctype="multipart/form-data" method="POST" action="">
                        <label for="name">Name</label>
                        <input type="text" name="name" required placeholder="" required class="form-control"><br>
                        <label for="email">Email</label>
                        <input type="email" name="email" required class="form-control" id=""><br>
                        <label for="username">Username</label>
                        <input type="text" name="username" required class="form-control" id=""><br>
                        <label for="username">Phone number</label>
                        <input type="number" name="number" required class="form-control" id=""><br>
                        <label for="password">Password</label>
                        <input type="password" name="password" required class="form-control"><br>
                        <label for="password">Confirm password</label>
                        <input type="password" name="c_password" required class="form-control"><br>
                        <label for="picture">Choose image</label>
                        <input type="file" name="image" required id=""><br><br>
                        <div style="display:flex;">
                            <button type="submit" class="btn btn-primary mr-auto" name="signup">Submit</button>
                            <a class="btn btn-danger" href="index.php">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- page modal -->
        <?php include 'components/page_modal.php' ?>
    
    <script src="vendors/js/jquery.min.js"></script>
    <script src="vendors/js/popper.min.js"></script>
    <script src="vendors/js/bootstrap.min.js"></script>
</body>
</html>
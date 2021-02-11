<?php session_start(); 
    if (strlen($_SESSION['id']) < 1) {
        header('location:../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Personal income and expenses management ">
    <meta name="author" content="oladayoahmod112@gmail.com">
    <meta name="keywords" content="expenses,income,expenses management,income management">

    <!-- Title Page-->
    <title> Users | Profile </title>

    <!-- Fontfaces CSS-->
    <link href="../vendors/css/font-face.css" rel="stylesheet" media="all">
    <link href="../vendors/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="../vendors/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="../vendors/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="../vendors/css/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- vendors CSS-->
    <link href="../vendors/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="../vendors/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="../vendors/wow/animate.css" rel="stylesheet" media="all">
    <link href="../vendors/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="../vendors/slick/slick.css" rel="stylesheet" media="all">
    <link href="../vendors/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendors/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../vendors/css/theme.css" rel="stylesheet" media="all">
    <link href="../vendors/css/style.css" rel="stylesheet">

</head>

<body class="animsition">
            <!-- header -->
            <?php include '../components/header.php'; ?>
            <div class="container">
                <!-- error message  -->
                    <?php
                        // include '../model/modal.php';
                        // $model = new Model;
                        
                    ?>
                <!-- error message ends -->
            </div>

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Welcome back
                                <span><?= $_SESSION['username']; ?></span>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->

            <!-- STATISTIC-->
                <?php include  '../components/statistics.php'; ?>
            <!-- END STATISTIC-->

                <!-- profile section -->
            <section>
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-md-6">
                            <div class="card shadow">
                              <?php 
                           
                                // if the form is submitted
                                if (isset($_POST['submit'])) {
                                    // session id
                                    $id = $_SESSION['id'];
                                    $name = strip_tags($_POST['name']);
                                    $email = strip_tags($_POST['email']);
                                    $username = strip_tags($_POST['username']);
                                    $password = md5($_POST['password']);
                                    $c_password = md5($_POST['c_password']);
                                    $number = strip_tags($_POST['number']);
                                    // instantiate the model class
                                    $model = new Model;
                                    $model->update_data($id,$name,$email,$username,$password,$c_password,$number);
                                }
                               
                                // instantiate the class
                                $model = new Model;
                                // session id
                                $id = $_SESSION['id'];
                                // get the user data
                               
                              ?>
                              <div class="card-body">
                                <h4 id="form-h4" class=" my-2 text-white list-group-item bg-primary"> Users | Profile</h4>
                                        <?php
                                            $row = $model->user_data($id);
                                            foreach($row as $data){?>
                                            <form action="#" method="POST">
                                                <div class="form-group">
                                                    <label for="fullname">Name</label>
                                                    <input type="text" value="<?= $data['fullname'];?>" class="form-control" name="name" id="" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" value="<?= $data['email'];?>" name="email" id="" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="number">Phone number</label>
                                                    <input type="number" class="form-control" value="<?= $data['phone_num'];?>" name="number" id="" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" value="<?= $data['username'];?>" name="username" id="" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" name="password" id="" placeholder="if null, enter previous one">
                                                </div>
                                                <div class="form-group">
                                                    <label for="confirm password">Confirm password</label>
                                                    <input type="password" class="form-control" name="c_password" id="" placeholder="if null, enter previous one">
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                            </form>
                                            <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
           
            
            <?php include '../components/page_modal.php'; ?>

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2020 Unitech. All rights reserved. Made with love by <a href="https://unitechdev.com">Unitech</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="../vendors/js/jquery.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="../vendors/js/popper.min.js"></script>
    <script src="../vendors/js/bootstrap.min.js"></script>
    <!-- vendors JS       -->
    <script src="../vendors/slick/slick.min.js">
    </script>
    <script src="../vendors/wow/wow.min.js"></script>
    <script src="../vendors/animsition/animsition.min.js"></script>
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="../vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="../vendors/counter-up/jquery.counterup.min.js">
    </script>
    <script src="../vendors/circle-progress/circle-progress.min.js"></script>
    <script src="../vendors/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../vendors/chartjs/Chart.bundle.min.js"></script>
    <script src="../vendors/select2/select2.min.js">
    </script>
    <!-- Main JS-->
    <script src="../vendors/js/main.js"></script>

</body>

</html>

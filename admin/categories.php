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
    <title> Manage | Categories </title>

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

                <!-- category section -->
            <section>
            <div class="container "> 
            <ol class="breadcrumb">
                <li class="active text-danger"><i class="fa fa-minus mr-1"></i>/ Categories Management</li>
            </ol>

        <div class="card shadow">
            <div>
                <h6 class="list-group-item active"><i class="fa fa-minus mr-1"></i>/ Manage Categories</h6>
            </div>
            <div class="card-body">

                <!--  search bar -->
                    <div class="col-md-4 ml-auto">
                        <form action="#" method="POST" class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" type="search" placeholder="search...">
                                <span class="input-group-append">
                                    <button name="searchExp" class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                                                
                                       <!-- <div class="">         -->
                    <div class="table-responsive justify-content-center align-items-center">
                        <table class="table  table-responsive table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Category Name</th>
                                    <th>Category type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    
                                    $model = new Model;
                                    // user id
                                    $user_id = $_SESSION['id'];
                                    $row = $model->manage_categories($user_id);
                                                                 
                                    if (!empty($row)) {
                                        $count = 1;
                                        foreach($row as $rows){
                                           
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td><?= $rows['category_name']; ?></td>
                                                <td><?= $rows['cat_type']; ?></td>
                                                <td style="display:flex;">
                                                    <a href="editcat.php?cat=<?=$rows['id'];?>"><i class="fas fa-edit mr-2 text-primary"></i></a>
                                                    <a href="delete.php?cat=<?=$rows['id']?>"><i class="fas fa-trash text-danger"></i></a>
                                                </td>
                                            </tr>
                                                <?php }} ?>
                                   
                            </tbody>
                        </table>
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

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
    <title> Expenses | Reports | Weekly </title>

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
            <section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--green">
                                <h2 class="number">10,368</h2>
                                <span class="desc">members online</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">388,688</h2>
                                <span class="desc">items sold</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--blue">
                                <h2 class="number">1,086</h2>
                                <span class="desc">this week</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="statistic__item statistic__item--red">
                                <h2 class="number">$1,060,386</h2>
                                <span class="desc">total earnings</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->

                <!-- report section -->
            <section>
            <div class="container "> 
            <ol class="breadcrumb">
                <li class="active text-danger"><i class="fa fa-minus mr-1"></i>/ Expenses Reports</li>
            </ol>

        <div class="card shadow">
            <div>
                <h6 class="list-group-item active"><i class="fa fa-minus mr-1"></i>/ Weekly  Reports</h6>
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
                                                
                    <div class="table-responsive justify-content-center align-items-center">
                    <table class="table  table-responsive table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Item</th>
                                    <th>Cost</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Place</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if (isset($_POST['searchExp'])) {
                                    $modal = new Model;
                                      // user id
                                    $user_id = $_SESSION['id'];
                                    // $search = strip_tags($_POST['search']);
                                    $row = $modal->weekly($user_id); 
                                    // $total_pages = $row['total'];
                                }
                                else{
                                    $modal = new Model;
                                      // user id
                                    $user_id = $_SESSION['id'];
                                    $row =  $modal->weekly($user_id);
                                    // $total_pages = $row['total'];
                                }
                               
                                    if (!empty($row)) {
                                        $count = 1;
                                        foreach($row as $rows){
                                           
                                            ?>
                                            <tr>
                                                <td><?= $count++; ?></td>
                                                <td><?= $rows['exp_name']; ?></td>
                                                <td><?= $rows['exp_amount']; ?></td>
                                                <td><?= $rows['exp_date']; ?></td>
                                                <td><?= $rows['exp_desc']; ?></td>
                                                <td><?= $rows['exp_cat']; ?></td>
                                                <td><?= $rows['place']; ?></td>
                                                <td style="display:flex;">
                                                    <a href="edit.php?exp=<?=$rows['id'];?>"><i class="fas fa-edit mr-2 text-primary"></i></a>
                                                    <a href="delete.php?exp=<?=$rows['id'];?>"><i class="fas fa-trash text-danger"></i></a>
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

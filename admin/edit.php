<?php
      error_reporting(0);
     session_start(); 
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
    <title> Manage | Expenses </title>

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
            <div class="container">
            <ol class="breadcrumb">
                <li class="active text-danger"><i class="fa fa-minus mr-1"></i>/ Expenses</li>
            </ol>

        <div class="card shadow p-3">
            <div>
                <h6 class="list-group-item active mb-2"><i class="fa fa-minus mr-1"></i>/ Edit Expenses</h6>
            </div>
            <?php
                 // check if the expenditure update is set
                if (isset($_POST['expUpdate'])) {
                    $id = $_GET['exp']; //getting the id of the expense
                    $user_id = $_SESSION['id']; // user id
                    $name = strip_tags($_POST['name']);
                    $amount = strip_tags($_POST['amount']);
                    $date = $_POST['date'];
                    $description = strip_tags($_POST['description']);
                    $category = strip_tags($_POST['category']);
                    $place = strip_tags($_POST['place']);
                    $model = new Model;
                    $model->update($id,$user_id,$name,$amount,$date,$description,$category,$place);
                }
                // check if the expenses id is set
                if (isset($_GET['exp'])) {
                    //setting the id
                    $id = $_GET['exp'];
                    // user id
                    $user_id = $_SESSION['id'];
                    $modal = new Model;
                    $rows = $modal->edit($id,$user_id);
                }
                
                    foreach ($rows as $row) {?>
            <!-- form -->
            <form class="form-group p-2" enctype="multipart/form-data" method="POST" action="">
                <label for="item">Item</label>
                <input type="text" value="<?= $row['exp_name']; ?>" class="form-control" name="name" required>
                <label for="item-cost">Item Cost</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">#</div>
                    </div>
                    <input type="number" value="<?= $row['exp_amount']; ?>" class="form-control" name="amount" required>
                </div>
                <label for="item">Item Date</label>
                <input type="date" class="form-control" name="date" value="<?= $row['exp_date']; ?>" required><br>
                <label for="post-category">Item category</label>
                <select class="form-control" name="category" id="" required><br>
                    <option value="" disabled selected><?= $row['exp_cat']; ?></option>
                    <?php 
                        $modal = new Model;
                        //category type
                        $type = 'expenses';
                        // user id
                        $user_id = $_SESSION['id'];
                        $fetch = $modal->fetch_cat($type,$user_id);
                        foreach($fetch as $fetches){?>
                    <option value=<?= $fetches['category_name'];?> ><?= $fetches['category_name'];?></option>
                    <?php }?>	
                </select><br>				
                <label for="item">Item Place</label>
                <input type="text" class="form-control" value="<?= $row['place']; ?>" name="place" required><br>
                <label for="item">Item Description</label>
                <textarea name="description" class="form-control" id="" cols="15"><?= $row['exp_desc']; ?></textarea><br>
                <button type="submit" name="expUpdate" class="btn btn-primary">Update</button>
            </form>
                    <?php } ?>
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

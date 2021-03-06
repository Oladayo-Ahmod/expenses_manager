<?php 
ini_set('display_errors','1');
ini_set('display_startup_errors','1');
error_reporting(E_ALL);
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
    <title>Expenditure | Dashboard</title>

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
    <link href="../vendors/css/style.css" rel="stylesheet" media="all">

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

            <!-- STATISTIC CHART-->
            <section class="statistic-chart">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">statistics</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <!-- CHART-->
                            <div class="statistic-chart-1">
                                <h3 class="title-3 m-b-30">chart</h3>
                                <div class="chart-wrap">
                                    <canvas id="widgetChart5"></canvas>
                                </div>
                                <div class="statistic-chart-1-note">
                                    <span class="big">The Year Expenditure Chart</span>
                                </div>
                            </div>
                            <!-- END CHART-->
                        </div>
                      
                        <div class="col-md-6 col-lg-4">
                            
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC CHART-->

            
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
    <script>
      
const bd_brandProduct3 = 'rgba(0,181,233,0.9)';
const bd_brandService3 = 'rgba(0,173,95,0.9)';
const brandProduct3 = 'transparent';
const brandService3 = '#ecd7c0';

var expenditure_chart = [
                <?php 
                      // dynamic fetching of the months' data        
                      $modal = new Model;
                      $user_id = $_SESSION['id'];
                      $costs = $modal->expenses_chart($user_id);
                      foreach($costs as $cost){?>
                      <?= json_encode($cost['costs']/100) . ','; ?>
                  <?php } ?>''
];
var chart = document.getElementById("widgetChart5");
var myChart = new Chart(chart, {
    type: 'bar',
    data: {
      labels: [
                <?php 
                    $modal = new Model;
                    $user_id = $_SESSION['id'];
                    $month = $modal->month_chart($user_id);          
                    foreach($month as $months){?>
                    <?= json_encode($months['month']) . ','; ?>
                <?php } ?>''
            ],
      datasets: [
        {
          label: 'Expenses',
          backgroundColor: brandService3,
          borderColor: bd_brandService3,
          pointHoverBackgroundColor: '#fff',
          borderWidth: 0,
          data: expenditure_chart,
          pointBackgroundColor: bd_brandService3
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      legend: {
        display: true
      },
      responsive: true,
      scales: {
        xAxes: [{
          gridLines: {
            drawOnChartArea: true,
            color: '#f2f2f2'
          },
          ticks: {
            fontFamily: "Poppins",
            fontSize: 12
          }
        }],
        yAxes: [{
          ticks: {
            beginAtZero: true,
            maxTicksLimit: 5,
            stepSize: 50,
            max: 150,
            fontFamily: "Poppins",
            fontSize: 12
          },
          gridLines: {
            display: false,
            color: '#f2f2f2'
          }
        }]
      },
      elements: {
        point: {
          radius: 3,
          hoverRadius: 4,
          hoverBorderWidth: 3,
          backgroundColor: '#333'
        }
      }

    }
  });
    </script>

</body>

</html>

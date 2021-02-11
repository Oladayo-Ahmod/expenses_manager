<?php 
    $user_id = $_SESSION['id'];
    // yearly expenditure
    $model = new Model;
    $yearly = $model->total_yearly($user_id);
    // monthly
    $model = new Model;
    $monthly = $model->total_monthly($user_id);
    // weekly
    $model = new Model;
    $weekly = $model->total_weekly($user_id);
?>
<section class="statistic statistic2">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--orange">
                                <h2 class="number">
                                <?php
                                    if (empty($weekly['total'])) {
                                        echo '<div class="text-danger">0</div>';
                                    }
                                    else{
                                        echo $weekly['total'];
                                    }
                                    ?>
                                    </h2>
                                <span class="desc">weekly spending</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--blue">
                            <h2 class="number">
                                <?php
                                    if (empty($weekly['total'])) {
                                        echo '<div class="text-danger">0</div>';
                                    }
                                    else{
                                        echo $monthly['total'];
                                    }
                                    ?>
                                    </h2>
                                    <span class="desc">monthly spending</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-calendar-note"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="statistic__item statistic__item--red">
                            <h2 class="number">
                                <?php
                                    if (empty($yearly['total'])) {
                                        echo '<div class="text-danger">0</div>';
                                    }
                                    else{
                                        echo $yearly['total'];
                                    }
                                    ?>
                                    </h2>
                                <span class="desc">yearly spending</span>
                                <div class="icon">
                                    <i class="zmdi zmdi-money"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
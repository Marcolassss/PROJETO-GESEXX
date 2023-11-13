<?php
    require_once "include/header.php";
?>

<?php 
date_default_timezone_set("America/Sao_Paulo");
    $todayExp = $yesterdayExp = $weeklyExp = $monthlyExp = $yearlyExp = $totalExp = 0;

    $current_date = date("Y-m-d " , strtotime("now"));
    $yesterday_date = date("Y-m-d " , strtotime("yesterday"));
    $weekly_date = date("Y-m-d " , strtotime("-1 week"));
    $monthly_date = date("Y-m-d " , strtotime("-1 month"));
    $yearly_date =  date("Y-m-d " , strtotime("-1 year"));

    // Conexao com banco de dados
    require_once "include/database-connection.php";

// Despesa de hoje------------------------------------------------------------------------------------------------
    $sql_command_todayExp = "SELECT price , date FROM expenses Where date= '$current_date' AND email = '$_SESSION[email]' ";
    $result = mysqli_query($conn ,$sql_command_todayExp);
    $rows =  mysqli_num_rows($result);
    
    if($rows > 0){
        while ($rows = mysqli_fetch_assoc($result) ){
            $todayExp += $rows["price"];
        }
    }

// Despesa de ontem--------------------------------------------------------------------------------------------------------
$sql_command_yesterdayExp = "SELECT price , date FROM expenses Where date = '$yesterday_date' AND email = '$_SESSION[email]' ";
$result_y = mysqli_query($conn ,$sql_command_yesterdayExp);
$rows_y =  mysqli_num_rows($result_y);

if($rows_y > 0){
    while ($rows_y = mysqli_fetch_assoc($result_y) ){
        $yesterdayExp += $rows_y["price"];
    }
}

// Despesa semanal------------------------------------------------------------------------------------------------------------
$sql_command_weeklyExp = "SELECT price , date FROM expenses Where date BETWEEN '$weekly_date' AND '$current_date' AND email = '$_SESSION[email]'  ORDER BY date ";
$result_w = mysqli_query($conn , $sql_command_weeklyExp) ;
$rows_w =  mysqli_num_rows($result_w);
if($rows_w > 0){
    while ($rows_w = mysqli_fetch_assoc($result_w) ){
        $weeklyExp += $rows_w["price"];
    }
}

// Despesa mensal -----------------------------------------------------------------------------------------------------------
$sql_command_monthlyExp = "SELECT price , date FROM expenses Where date BETWEEN '$monthly_date' AND '$current_date' AND email = '$_SESSION[email]' ORDER BY date ";
$result_m = mysqli_query($conn , $sql_command_monthlyExp) ;
$rows_m =  mysqli_num_rows($result_m);
if($rows_m > 0){
    while ($rows_m = mysqli_fetch_assoc($result_m) ){
        $monthlyExp += $rows_m["price"];
    }
}

// Despesa anual----------------------------------------------------------------------------------------------------------
$sql_command_yearlyExp = "SELECT price , date  FROM expenses Where date BETWEEN '$yearly_date' AND '$current_date' AND  email = '$_SESSION[email]' ";
$result_year = mysqli_query($conn , $sql_command_yearlyExp) ;
$rows_year =  mysqli_num_rows($result_year);
if($rows_year > 0){
    while($rows_year = mysqli_fetch_assoc($result_year)){
        $yearlyExp += $rows_year['price'];  
    }
}

 

// Despesa total------------------------------------------------------------------------------------------------------
$sql_command_totalExp = "SELECT price , date FROM expenses Where email = '$_SESSION[email]' ORDER BY date ";
$result_t = mysqli_query($conn , $sql_command_totalExp) ;
$rows_t =  mysqli_num_rows($result_t);
if($rows_t > 0){
    while ($rows_t = mysqli_fetch_assoc($result_t) ){
        $totalExp += $rows_t["price"];
    }
}

?>



<h1 class=" display-4 pb-5 pt-4 " > <i> PAINEL </i> </h1>

<div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Despesas do Dia</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $todayExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("jS F " , strtotime("now")); ?></p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Despesas de Ontem</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $yesterdayExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("jS F " , strtotime("yesterday")); ?></p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Despesas dos últimos 7 dias</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $weeklyExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("jS F" , strtotime("-7 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-dollar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-7">
                            <div class="card-body">
                                <h3 class="card-title text-white">Despesas dos últimos 30 dias</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $monthlyExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("jS F" , strtotime("-30 days")); echo " - " . date("jS F " , strtotime("now")); ?></p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class = "col-3">

                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-5">
                            <div class="card-body">
                                <h3 class="card-title text-white">Despesa de um ano</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $yearlyExp; ?></h2>
                                    <p class="text-white mb-0"><?php echo date("d F Y" , strtotime("-1 year")); echo " - " . date("d F Y" , strtotime("now")); ?></p>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card gradient-9">
                            <div class="card-body">
                                <h3 class="card-title text-white">Despesa Total</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white"><?php echo $totalExp; ?></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-usd"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

<?php 
require_once "include/footer.php";
?>
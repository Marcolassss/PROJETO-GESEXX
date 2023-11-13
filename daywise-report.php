<?php 
    require_once "include/header.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>

<?php
        $selectedDateErr = "";
        $selectedDate = "";
        $item = $date = $price =  "";
        $i= 1;

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(empty($_REQUEST["expense_date"])){
                $selectedDateErr =" <p style='color:red'>* Please Select a Date</p>";
            } else {
                $selectedDate = trim($_REQUEST["expense_date"]);
            } 

            if(!empty($selectedDate)){
                
                // database CONEXAOO
                require "include/database-connection.php";

                $sql_query = "SELECT date , item , price FROM expenses WHERE date = '$selectedDate' AND email = '$_SESSION[email]' ";

                $result = mysqli_query($conn , $sql_query);

                $rows = mysqli_num_rows($result);


?>


<!-- TABELA -->

<div class="container" > 
        <h3  class="text-center pt-5 hide">Relatorio de despesa diarias</h3>
        <table  class="table table-bordered table-hover border-primary shadow bg-light hide">
         <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">Date</th>
                 <th scope="col">Item</th>
                  <th scope="col">Price in $</th>
                 </tr>
         </thead>
         <tbody>

<!-- ADICIONAR ITENS -->
         <?php  
               if($rows > 0){
                    while($rows = mysqli_fetch_assoc($result)){
                        $date = $rows["date"];
                        $date = date("jS F" , strtotime($date) );
                        // echo $date;
                        $item =  $rows["item"];
                        $price =  $rows["price"];

                        echo " <tr> <th> {$i}. </th> <th> {$date} </th> <th> {$item} </th> <th> {$price} </th> ";
                        $i++;

                   
                    } 
                    echo "   </tbody> </table>";

                  
                    echo "<style> #form { display:none } </style>";
                    
                    
                    echo " <div class='text-center pt-4 pb-5'> <a href='daywise-report.php' class='btn btn-primary btn-lg'> Check More </a> 
                    <a href='pdf_gen_day.php?date={$selectedDate}' class='btn btn-danger btn-lg text-white'> Save as PDF </a> </div>";
                    
                    
                } else {

                  
                    $selectedDate = date( 'jS F' , strtotime("$selectedDate") );

                    echo " <script>
                                 $(document).ready(function() {
                                     $('#addMsg').text( 'Sorry! No result Found for  $selectedDate. '  );
                                    $('#changeHrefForAdding').attr('href', 'add-expense.php');
                                    $('#showModal').modal('show');
                                    $('.hide').hide();
                                    });
                         </script> ";

                } 

       
            }


    }
?>
</div>




<div class="container mb-5">
    <div id="form" class="pt-5 form-input-content">
        <div class="card login-form mb-0">
            <div class="card-body pt-5 shadow">
                <h4 class="text-center">Relatorio de despesa diarias </h4>
                <form method="POST" action=" <?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">            
                    <div class="form-group">
                        <label >Selecione a data da despesa:</label>
                        <input type="date" class="form-control"  name="expense_date" >  
                        <?php echo $selectedDateErr; ?>                  
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Mostrar" class="btn login-form__btn submit w-10 " name="submit_expense" >
                    </div>
  
                </form>
            </div>
        </div>
    </div>
</div>




<?php 
    require_once "include/footer.php";
?>
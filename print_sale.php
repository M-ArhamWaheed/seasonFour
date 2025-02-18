
<!DOCTYPE html>
<html>
<?php include_once 'includes/head.php';
    

 ?>
<style type="text/css">
    .container{
        height: 100% !important;
        background-color: #fff;
        border-bottom: 1px dashed #000 !important;
    }
    .border{

        border: 1px solid #000 !important;
    }
    .thead_row th{
        color: #000 !important;
        font-size: 18px !important;
        border: 1px solid #000;
        text-align: center;
    }
     tbody td{
    
        border: 1px solid #000;
        text-align: center;
    }
    table{
        width: 100%;
        

    }
    .table_row{

        border: 1px solid #000;
        padding: 0px;
    }
    .tbody_row tr td{
        font-size: 17px;
        font-weight: bolder;
        text-align: center;
        color: #000;

    }
    .tfoot_row tr td{
            font-size: 17px;
        font-weight: bolder;
        color: #000;
        text-align: center;

    }
</style>

<body>
<?php   for ($i=0; $i < 2; $i++) : 
    $totalQTY= 0;
            if($i>0){
           $margin = "margin-top:-270px !important";
           $copy = "Company Copy";
           
       }else{
         $margin = "";
           $copy = "Customer Copy";
       } 

     if ($_REQUEST['type']=="purchase") {
        $nameSHow = 'Supplier';
       $order=fetchRecord($dbc,"purchase","purchase_id",$_REQUEST['id']);
       $comment = $order['purchase_narration'];
        $table_row="390px";
       $getDate=$order['purchase_date'];
         if ($order['payment_type']=="credit_purchase") {
        
            $order_type="credit purchase";
       
            }else{
                $order_type="cash purchase";
            }
    $order_item=mysqli_query($dbc,"SELECT purchase_item.*,product.* FROM purchase_item INNER JOIN product ON purchase_item.product_id=product.product_id WHERE purchase_item.purchase_id='".$_REQUEST['id']."'");
 }else{
     $nameSHow = 'Customer';
  $order=fetchRecord($dbc,"orders","order_id",$_REQUEST['id']);
   $getDate=$order['order_date'];
    $comment = $order['order_narration'];
    $order_item=mysqli_query($dbc,"SELECT order_item.*,product.* FROM order_item INNER JOIN product ON order_item.product_id=product.product_id WHERE order_item.order_id='".$_REQUEST['id']."'");
    if ($order['payment_type']=="credit_sale") {
         $table_row="300px";
        if ($order['payment_type']=="none") {
            $order_type="credit sale";
        }else{
             $order_type=$order['credit_sale_type']." (Credit)";   
        }
    }else{
        $order_type="cash sale";
        $table_row="350px";
    }

}
       ?>
       
<div class="container">
<?php //if ($order['payment_type']!="cash_in_hand"): ?>
                
           
            <header>
                <div class="row">
                     <div class="col-sm-5">
                         <!-- <img src="img/logo/<?=$get_company['logo']?>" width="90" height="90" class="img-fluid float-right" style="margin-top: 10px"> -->
                </div>
        <div class="col-sm-12 text-center">
          <h1 style="margin-left: 0px; color: red;font-weight: bold;font-size: 30px"><?=$get_company['name']?></h1>
          <p style="margin-top: -18px;font-size: 20px;"><u>Mechanical & Electronic Parts</u> </p>
          <p style="margin-top: -10px; font-weight: bolder;font-size: 15px">PH  No. :<?=$get_company['company_phone']?> - <?=$get_company['personal_phone']?></p>
          <p style="margin-top: -15px; font-weight: bolder;font-size: 18px;"><?=$get_company['email']?></p>
          <p style="margin-top: -15px; font-weight: bolder;font-size: 15px"><?=$get_company['address']?> </p>

          
  

          
        </div>
        <center style="width: 100%;margin-top: -5px;"></center>
      </div>
            </header>
             <?php //endif ?>
    <div class="row">
        <div class="pt-2  col-sm-6  ">
        <p class="h4 border p-2 font-weight-bold float-left"> Invoice # <b><?=$_REQUEST['id']?></b></p>
    </div>
    <div class="pt-2   col-sm-6">
        
         <p class="h4 border p-2 font-weight-bold float-right"> Date :  <b>
            <?php //getDateFormat("D d-M-Y h:i a",($order['timestamp']))?>
               <?php 
               echo $date = date('D d-M-Y h:i A', strtotime($order['timestamp'] . " +10 hours"));
               ?> 


            </b></p>
    </div>
    </div>
<div class="row">
        <div class="  col-sm-3  ">
        <p class="h4 border border-bottom-0 text-center p-0 m-0 font-weight-bold"> <?=$nameSHow?> Name </p>
        <p class="h4 border p-0 m-0 font-weight-bold text-center"><b><?=ucwords($order['client_name'])?></b></p>
    </div>
    <div class="col-sm-5">
        <h2 class="text-center p-0 m-0">Bill</h2>
        <h4 class="text-center p-0 m-0"><?=@$order_type?></h4>
    </div>
    <div class="  col-sm-4 ">
        <p class="h4 border border-bottom-0 text-center p-0 m-0 font-weight-bold"> <?=$nameSHow?> Address </p>
        <p class="h4 border p-0 m-0 font-weight-bold text-center"><b><?=$order['client_contact']?></b></p>
    </div>

    </div>
    <div class="row table_row mt-4" style="min-height: <?=$table_row?>;">
        <div class="col-sm-12 p-0">
            <table class="w-100">
                <thead class="thead_row">
                    <th>Sr</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>QUANTITY</th>
                    <th>TOTAL</th>
                </thead>
                <tbody class="tbody_row">
                        <?php  $c=0; while ($r=mysqli_fetch_assoc($order_item)) { $c++;

                       ?>
                        <tr>
                            <td><?=$c?></td>
                            <td ><?=strtoupper($r['product_name'])?> 
                            <?php
                            if($r['product_detail']){
                            ?>
                            (<?=$r['product_detail']?>)
                            <?php
                        }
                            ?>
                        </td>
                            <td ><?=$r['rate']?></td>
                            <td ><?=$r['quantity']?></td>
                            <td ><?=$r['rate']*$r['quantity']?></td>
                        </tr>

                   <?php 
                   $totalQTY += $r['quantity'];
               } ?>
                    </tbody>
                    <tfoot class="tfoot_row">
              
                           <tr>
                            <td colspan="3"></td>
                            <td class="border"><b>Sub Total</b></td>
                            <td class="border"><?=$order['total_amount']?></td>
                            </tr>
                            <tr>
                            <td colspan="3"></td>
                            <td class="border"><b>Total Quantity</b></td>
                            <td class="border"><?=$totalQTY?></td>
                            </tr>
                    <?php
                    if ($order['discount']>0) {
                       
                    
                    ?>
                     <tr>
                        <td colspan="3"></td>
                        <td class="border">DISCOUNT%</td>
                        <td class="border"><?=$order['discount']?>%</td>
                    </tr>
                    <?php
                }
                    ?>
                    <tr>
                        <td colspan="3"></td>
                        <td class="border">FREIGHT</td>
                        
                        <td class="border"><b><?=empty($order['freight'])?"0":$order['freight']?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="border">GRAND TOTAL</td>
                        
                        <td class="border"><b><?=number_format($order['grand_total'],2)?></b></td>
                    </tr>
                    <?php if ($_REQUEST['type']=="order" AND $order['payment_type']=="credit_sale"): ?>
                      
                     <tr>
                        <td colspan="3"></td>
                        <td class="border">Previous Balance</td>
                        
                        <td class="border"><b><?=getcustomerBlance($dbc,$order['customer_account'])-$order['due']?></b></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td class="border">Current Balance</td>
                        
                        <td class="border"><b><?=getcustomerBlance($dbc,$order['customer_account'])?></b></td>
                    </tr>
                    
                    <?php endif; ?>   
                    </tfoot>
            </table>
        </div>
    </div>
    <?php
    if($comment):
    ?>
    <div class="row" >
        <table border="1" class="table table-responsive w-100">
            <tr>
                <th class="h4">Comment</th>
                <td class="h5"><?=$comment?></td>
            </tr>
        </table>
    </div>
    <?php
endif;
    ?>
    <div class="row" style="font-size: 18px">
                    <div class="col-sm-3 h4">
                        Prepared By : __________________ 
                    </div>
                     <div class="col-sm-6 ">
                        <?php
                        if (isset($order['vehicle_no'])) {
                            // code...
                        
                        ?>
                       <p class="4 mt-1 text-center"> Vehicle No : <b><u><?=strtoupper($order['vehicle_no'])?></u></b></p>

                        <?php
                    }
                        ?>
                    <p class="mt-1 text-dark text-center"> Software Developed By :<b>Samz Creation (0345-7573667)</b> </p>
                     <p class="text-dark text-center p-0 m-0"><?=$copy?></p>
                    </div>
                     <div class="col-sm-3 h4">
                        Recevied By  : _________________ 
                    </div>
                </div>
</div> <!-- end of container --> 
<?php endfor; ?>


</body>
</html>
<script type="text/javascript">
    window.print();
 //   window.close();
</script>
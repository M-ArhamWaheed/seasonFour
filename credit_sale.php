 <!DOCTYPE html>
 <html lang="en">
 <?php include_once 'includes/head.php';

  if (!empty($_REQUEST['edit_order_id'])) {
    # code...
    $fetchOrder = fetchRecord($dbc, "orders", "order_id", base64_decode($_REQUEST['edit_order_id']));
    // print_r($fetchOrder);
  }

  ?>

 <body class="horizontal light  ">
   <div class="wrapper">
     <?php include_once 'includes/header.php'; ?>

     <div class="container-fluid">
       <div class="card">
         <div class="card-header card-bg" align="center">

           <div class="row">
             <div class="col-12 mx-auto h4">
               <b class="text-center card-text pb-3"> Sale</b>


               <!-- <a href="#" onclick="reload_page()" class="btn btn-admin float-right btn-sm">Add New</a> -->
             </div>
           </div>

         </div>
         <div class="card-body">
           <form action="php_action/custom_action.php" method="POST" id="sale_order_fm">
             <input type="hidden" name="product_order_id" value="<?= !isset($_REQUEST['edit_order_id']) ? "" : base64_decode($_REQUEST['edit_order_id']) ?>">
             <div class="row form-group">
               <input type="hidden" name="payment_type" id="payment_type" value="credit_sale">
               <input type="hidden" name="form_type" id="form_type" value="credit_sale">
               <input type="hidden" name="price_type" id="price_type" value="sale">
               <input type="hidden" name="quotation_form" id="quotation_form" value="">


               <div class="col-md-4 d-flex ">
                 <div class="w-100 pe-1">
                   <label>ID#</label>
                   <?php $result = mysqli_query($dbc, "
    SHOW TABLE STATUS LIKE 'orders'
");
                    $data = mysqli_fetch_assoc($result);
                    $next_increment = $data['Auto_increment']; ?>
                   <input type="text" name="next_increment" id="next_increment" value="SF-S-<?= @empty($_REQUEST['edit_order_id']) ? $next_increment : $fetchOrder['order_id'] ?>" readonly class="form-control">
                 </div>

                 <div class="w-100 pe-1 pl-1">
                   <label> Date</label>
                   <input type="text" name="order_date" id="order_date" value="<?= @empty($_REQUEST['edit_order_id']) ? date('Y-m-d') : $fetchOrder['order_date'] ?>" readonly class="form-control">
                   <input type="hidden" name="credit_sale_type" value="<?= @$credit_sale_type ?>" id="credit_sale_type">
                 </div>

                 <div class="w-100 pl-1">
                   <label for="Sale Type">Sale Type</label>
                   <select name="sale_type" onchange="saleType(this.value)" class="form-control" id="sale_type">
                     <option <?= isset($_REQUEST['edit_purchase_id']) ? "" : "selected" ?> value="cash" <?= @$fetchOrder['payment_type'] == "cash" ? "selected" : "" ?>>Cash</option>
                     <option value="credit" <?= @$fetchOrder['payment_type'] == "credit" ? "selected" : "" ?>>Credit</option>
                   </select>
                 </div>

               </div>
               <div class="col-sm-2 cash-sale-div1">
                 <label>Customer Number</label>
                 <input type="number" onchange="getCustomer_name(this.value)" value="<?= @$fetchOrder['client_contact'] ?>" autocomplete="off" min="0" class="form-control" name="client_contact" list="phone">
                 <datalist id="phone">
                   <?php
                    $q = mysqli_query($dbc, "SELECT DISTINCT client_contact from orders");
                    while ($r = mysqli_fetch_assoc($q)) {
                    ?>
                     <option value="<?= $r['client_contact'] ?>"><?= $r['client_contact'] ?></option>
                   <?php   } ?>

                 </datalist>
               </div>
               <div class="col-sm-2 cash-sale-div2">
                 <label>Customer Name</label>
                 <input type="text" id="sale_order_client_name" value="<?= @$fetchOrder['client_name'] ?? 'Cash' ?>" class="form-control" autocomplete="off" name="sale_order_client_name" list="client_name">
                 <datalist id="client_name">
                   <?php
                    $q = mysqli_query($dbc, "SELECT DISTINCT client_name FROM orders");
                    while ($r = mysqli_fetch_assoc($q)) {
                    ?>
                     <option value="<?= $r['client_name'] ?>"><?= $r['client_name'] ?></option>
                   <?php   } ?>
                 </datalist>
               </div>
               <div class="col-sm-3 return_days-div">
                 <label>Customer Account</label>
                 <div class="input-group">

                   <select class="form-control searchableSelect" onchange="getBalance(this.value,'customer_account_exp')" name="credit_order_client_name" id="credit_order_client_name" aria-label="Username" aria-describedby="basic-addon1">
                     <option value="">Customer Account</option>
                     <?php
                      $q = mysqli_query($dbc, "SELECT * FROM customers WHERE customer_status =1 AND customer_type='customer'");
                      while ($r = mysqli_fetch_assoc($q)) {
                      ?>
                       <option <?= @($fetchOrder['customer_account'] == $r['customer_id']) ? "selected" : "" ?> data-id="<?= $r['customer_id'] ?>" data-contact="<?= $r['customer_phone'] ?>" value="<?= $r['customer_name'] ?>"><?= $r['customer_name'] ?> | <?= $r['customer_phone'] ?></option>
                     <?php   } ?>
                   </select><br />
                 </div>
                 <div class="input-group-prepend">
                   <span class="input-group-text" id="basic-addon1">Balance : <span id="customer_account_exp">0</span> </span>
                   <span class="input-group-text" id="basic-addon1">Limit : <span id="customer_Limit">0</span> </span>
                   <span class="input-group-text" id="basic-addon1">R Limit : <span id="R_Limit">0</span> </span>
                 </div>



                 <input type="hidden" name="customer_account" id="customer_account" value="<?= @$fetchOrder['customer_account'] ?>">
                 <input type="hidden" name="client_contact" id="client_contact" value="<?= @$fetchOrder['client_contact'] ?>">
                 <input type="hidden" name="R_Limit" id="R_LimitInput" />

               </div>
               <div class="col-sm-1">
                 <label>Comment</label>
                 <input type="text" autocomplete="off" name="order_narration" id="order_narration" value="<?= @$fetchOrder['order_narration'] ?>" class="form-control">

               </div>

               <!-- <div class="col-sm-2">
                 <label>Vehicle NO </label>
                 <input type="text" id="vehicle_no" value="<?= @$fetchOrder['vehicle_no'] ?>" class="form-control" autocomplete="off" name="vehicle_no" list="vehicle_no_list">
                 <datalist id="vehicle_no_list">
                   <?php
                    $q = mysqli_query($dbc, "SELECT DISTINCT vehicle_no FROM orders");
                    while ($r = mysqli_fetch_assoc($q)) {
                    ?>
                     <option value="<?= $r['vehicle_no'] ?>"><?= $r['vehicle_no'] ?></option>
                   <?php   } ?>
                 </datalist>
               </div> -->
               <div class="col-sm-1 return_days-div">
                 <label>Return Days</label>
                 <input type="text" id="return_days" value="<?= @$fetchOrder['return_days'] ?>" class="form-control" autocomplete="off" name="return_days" list="return_days_list">
                 <datalist id="return_days_list">
                   <?php
                    $q = mysqli_query($dbc, "SELECT  return_days FROM orders");
                    while ($r = mysqli_fetch_assoc($q)) {
                    ?>
                     <option value="<?= $r['return_days'] ?>"><?= $r['return_days'] ?></option>
                   <?php   } ?>
                 </datalist>
               </div>
               <div class="col-sm-2">
                 <label>Attach File
                   <?php if (!empty($fetchOrder['order_file'])): ?>
                     <a href="img/uploads/<?= htmlspecialchars($fetchOrder['order_file']) ?>" target="_blank">
                       <p type="button" class="d-inline p-0 m-0">View File</p>
                     </a>
                   <?php endif; ?>
                 </label>
                 <input type="file" autocomplete="off" value="<?= @$fetchOrder['order_file'] ?>" class="form-control" name="order_file">
               </div>
             </div> <!-- end of form-group -->
             <div class="form-group row mb-5">
               <div class="col-6 col-md-1">
                 <label>Code</label>
                 <input type="text" name="product_code" autocomplete="off" id="get_product_code" class="form-control">
               </div>
               <div class="col-6 col-md-2">
                 <label>Products</label>
                 <input type="hidden" id="add_pro_type" value="add">
                 <select class="form-control searchableSelect" id="get_product_name" name="product_id">
                   <option value="">Select Product</option>
                   <?php
                    $result = mysqli_query($dbc, "SELECT * FROM product WHERE status=1 ");
                    while ($row = mysqli_fetch_array($result)) {
                      $getBrand = fetchRecord($dbc, "brands", "brand_id", $row['brand_id']);
                      $getCat = fetchRecord($dbc, "categories", "categories_id", $row['category_id']);
                    ?>

                     <option data-price="<?= $row["current_rate"] ?>" <?= empty($r['product_id']) ? "" : "selected" ?> value="<?= $row["product_id"] ?>">
                       <?= $row["product_name"] ?> </option>

                   <?php   } ?>
                 </select>
                 <span class="text-center w-100" id="instockQty"></span>
               </div>
               <div class="col-6 col-sm-2 col-md-2">
                 <label>Product Details</label>
                 <input type="text" class="form-control" id="get_product_detail">
               </div>
               <div class="col-6 col-sm-2 col-md-2">
                 <label>Price</label>
                 <input type="number" min="0" class="form-control" id="get_product_price">
               </div>
               <div class="col-6 col-sm-1 col-md-1">
                 <label>Final Price</label>
                 <input type="number" min="0" readonly class="form-control" id="get_final_rate">
               </div>
               <div class="col-6 col-sm-2 col-md-2">
                 <label>Quantity</label>
                 <input type="text" class="form-control" id="get_product_quantity" value="1" min="1" name="quantity">
               </div>
               <div class="col-6 col-sm-1 col-md-1">
                 <label>Amount</label>
                 <input type="number" readonly class="form-control" id="get_product_sale_price">
               </div>
               <div class="col-sm-1">
                 <br>
                 <button type="button" class="btn btn-success btn-sm mt-2 float-right" id="addProductPurchase"><i class="fa fa-plus"></i> <b>Add</b></button>
               </div>

             </div>
             <div class="row">
               <div class="col-12">

                 <table class="table  saleTable" id="myDiv">
                   <thead class="table-bordered">
                     <tr>
                       <th class="text-dark">Code</th>
                       <th class="text-dark">Product Name</th>
                       <th class="text-dark">Product Details</th>
                       <th class="text-dark">Unit Price</th>
                       <th class="text-dark">Final Rate</th>
                       <th class="text-dark">Quantity</th>
                       <th class="text-dark">Amount</th>
                       <th class="text-dark">Action</th>
                     </tr>
                   </thead>
                   <tbody class="table table-bordered" id="purchase_product_tb">
                     <?php if (isset($_REQUEST['edit_order_id'])):
                        $q = mysqli_query($dbc, "SELECT  product.*,brands.*,order_item.* FROM order_item INNER JOIN product ON product.product_id=order_item.product_id INNER JOIN brands ON product.brand_id=brands.brand_id   WHERE order_item.order_id='" . base64_decode($_REQUEST['edit_order_id']) . "'");

                        while ($r = mysqli_fetch_assoc($q)) {
                          // print_r($r);
                      ?>
                         <tr id="product_idN_<?= $r['product_id'] ?>">
                           <input type="hidden" data-price="<?= $r['rate'] ?>" data-quantity="<?= $r['quantity'] ?>" id="product_ids_<?= $r['product_id'] ?>" class="product_ids" name="product_ids[]" value="<?= $r['product_id'] ?>">
                           <input type="hidden" id="product_quantites_<?= $r['product_id'] ?>" name="product_quantites[]" value="<?= $r['quantity'] ?>">
                           <input type="hidden" id="product_detail_<?= $r['product_id'] ?>" name="product_detail[]" value="<?= $r['product_detail'] ?>">
                           <input type="hidden" id="product_rate_<?= $r['product_id'] ?>" name="product_rates[]" value="<?= $r['rate'] ?>">
                           <input type="hidden" id="product_totalrate_<?= $r['product_id'] ?>" name="product_totalrates[]" value="<?= $r['rate'] ?>">
                           <input type="hidden" id="product_final_rate_<?= $r['product_id'] ?>" name="product_final_rates[]" value="<?= $r['final_rate'] ?>">
                           <td><?= $r['product_code'] ?></td>
                           <td><?= $r['product_name'] ?></td>
                           <td><?= $r['product_detail'] ?></td>
                           <td><?= $r['rate'] ?></td>
                           <td><?= $r['final_rate'] ?></td>
                           <td><?= $r['quantity'] ?></td>
                           <td><?= (float)$r['rate'] * (float)$r['quantity'] ?></?>
                           </td>
                           <td>

                             <button type="button" onclick="removeByid(`#product_idN_<?= $r['product_id'] ?>`)" class="fa fa-trash text-danger" href="#"></button>
                             <button type="button" onclick="editByid(<?= $r['product_id'] ?>,`<?= $r['product_code'] ?>`,`<?= $r['product_detail'] ?>`,<?= $r['rate'] ?>,<?= $r['quantity'] ?>, <?= $r['final_rate'] ?>)" class="fa fa-edit text-success ml-2 "></button>

                           </td>
                         </tr>
                     <?php }
                      endif ?>
                   </tbody>

                   <tfoot>
                     <tr>
                       <td colspan="5"></td>

                       <td class="table-bordered"> Sub Total :</td>
                       <td class="table-bordered" id="product_total_amount"><?= @$fetchOrder['total_amount'] ?></td>
                       <td class="table-bordered"> </td>
                     </tr>
                     <tr>
                       <td colspan="5"></td>

                       <td class="table-bordered"> Discount :</td>
                       <td class="table-bordered" id="getDiscount">
                         <div class="">


                           <input onkeyup="getOrderTotal()" type="number" id="ordered_discount" class="form-control form-control-sm " value="<?= @empty($_REQUEST['edit_order_id']) ? "0" : $fetchOrder['discount'] ?>" min="0" name="ordered_discount">
                           <input onkeyup="getOrderTotal()" type="number" id="freight" class="form-control form-control-sm d-none" placeholder="Freight" value="0" min="0" name="freight">

                         </div>
                       </td>
                       <td class="table-bordered"> </td>
                     </tr>
                     <tr>
                       <td colspan="5"></td>

                       <td class="table-bordered"> <strong>Net Total :</strong> </td>
                       <td class="table-bordered" id="product_grand_total_amount"><?= @$fetchOrder['grand_total'] ?></td>
                       <td class="table-bordered"> </td>
                     </tr>
                     <tr>
                       <td colspan="5"></td>

                       <td class="table-bordered">Paid :</td>
                       <td class="table-bordered">
                         <div class="form-group row">
                           <div class="col-sm-12">
                             <input type="text" min="0" class="form-control form-control-sm" id="paid_ammount" required onkeyup="getRemaingAmount()" name="paid_ammount" value=" <?= @isset($fetchOrder['paid']) ? $fetchOrder['paid'] : "0" ?>">
                           </div>
                           <!-- <div class="col-sm-6">
                             <div class="custom-control custom-switch">
                               <input type="checkbox" class="custom-control-input" id="full_payment_check">
                               <label class="custom-control-label" for="full_payment_check">Full Payment</label>
                             </div>
                           </div> -->
                         </div>
                       </td>
                       <td class="table-bordered"> </td>
                     </tr>
                     <tr>
                       <td colspan="5"></td>

                       <td class="table-bordered">Account :</td>
                       <td class="table-bordered">

                         <div class="input-group">
                           <select class="form-control" onchange="getBalance(this.value,'payment_account_bl')" name="payment_account" id="payment_account" aria-label="Username" aria-describedby="basic-addon1">

                             <?php $q = mysqli_query($dbc, "SELECT * FROM customers WHERE customer_status =1 AND customer_type='bank'");
                              while ($r = mysqli_fetch_assoc($q)): ?>
                               <option <?= @($fetchOrder['payment_account'] == $r['customer_id']) ? "selected" : "" ?> value="<?= $r['customer_id'] ?>"><?= $r['customer_name'] ?></option>
                             <?php endwhile; ?>
                           </select>
                           <div class="input-group-prepend">
                             <span class="input-group-text" id="basic-addon1">Balance : <span id="payment_account_bl">0</span> </span>
                           </div>
                         </div>
                       </td>
                       <td class="table-bordered"> </td>
                     </tr>
                     <tr>
                       <td colspan="5"></td>

                       <td class="table-bordered">Remaing Amount :</td>
                       <td class="table-bordered"><input type="number" class="form-control form-control-sm" id="remaining_ammount" required readonly name="remaining_ammount" value="<?= @$fetchOrder['due'] ?>">
                       <td class="table-bordered"> </td>
                     </tr>


                   </tfoot>
                 </table>
               </div>
             </div>
             <div class="row">
               <div class="col-sm-12 d-flex justify-content-end">
                 <a href="credit_sale.php?credit_type=15days" class="btn btn-dark pt-2 float-right btn-sm">Cancel</a>
                 <button class="btn btn-admin ml-2 " name="sale_order_btn" value="print" type="submit" id="sale_order_btn">Save and Print</button>

               </div>
             </div>
           </form>
         </div>
       </div> <!-- .row -->
     </div> <!-- .container-fluid -->


   </div> <!-- .wrapper -->

 </body>

 </html>

 <?php include_once 'includes/foot.php'; ?>


 <?php
  if (!empty($_REQUEST['edit_order_id'])) {
  ?>
   <script type="text/javascript">
     var custid = $("#customer_account").val();

     //alert(custid);
     getBalance(custid, 'customer_account_exp');
   </script>
 <?php
  }



  ?>
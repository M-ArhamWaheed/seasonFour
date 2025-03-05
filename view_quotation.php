<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; ?>

<body class="horizontal light  ">
  <div class="wrapper">
    <?php include_once 'includes/header.php'; ?>
    <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header card-bg" align="center">

            <div class="row">
              <div class="col-12 mx-auto h4">
                <b class="text-center card-text">Quotation List</b>


              </div>
            </div>

          </div>
          <div class="card-body">
            <table class="table  dataTable" id="view_orders_tb">
              <thead>
                <tr>
                  <th class="text-dark">Date</th>
                  <th class="text-dark">Customer Name</th>
                  <th class="text-dark">Phone</th>
                  <th class="text-dark">Amount</th>
                  <th class="text-dark">Order Type</th>
                  <th class="text-dark">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $q = mysqli_query($dbc, "SELECT * FROM quotations");
                $c = 0;
                while ($r = mysqli_fetch_assoc($q)) {
                  $c++;
                ?>
                  <tr class="text-capitalize">
                    <td><?= $r['quotation_date'] ?></td>
                    <td><?= ucfirst($r['client_name']) ?></td>
                    <td><?= $r['client_contact'] ?></td>
                    <td><?= $r['total_amount'] ?></td>
                    <td class="text-uppercase"><?= $r['payment_type'] ?></td>
                    <td class="d-flex">
                      <?php if (@$get_company['sale_interface'] == "barcode") {
                        $cash_sale_url = "cash_salebarcode.php";
                        $credit_sale_url = "credit_sale.php";
                      } elseif ($get_company['sale_interface'] == "keyboard") {
                        $cash_sale_url = "cash_salegui.php";
                        $credit_sale_url = "credit_sale.php";
                      } else {
                        $cash_sale_url = "cash_sale.php";
                        $credit_sale_url = "credit_sale.php";
                      }
                      ?>
                      <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin" and $r['payment_type'] == "cash_in_hand"): ?>
                        <form action="<?= $cash_sale_url ?>" method="POST">
                          <input type="hidden" name="edit_order_id" value="<?= base64_encode($r['quotation_id']) ?>">
                          <button type="submit" class="btn btn-admin btn-sm m-1">Edit</button>
                        </form>


                      <?php endif; ?>
                      <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin" and $r['payment_type'] == "quotation"): ?>
                        <form action="quotation.php" method="POST">

                          <input type="hidden" name="edit_order_id" value="<?= base64_encode($r['quotation_id']) ?>">
                          <input type="hidden" name="credit_type" value="<?= $r['credit_sale_type'] ?>">

                          <button type="submit" class="btn btn-admin btn-sm m-1">Edit</button>
                        </form>


                      <?php endif; ?>
                      <?php if (@$userPrivileges['nav_delete'] == 1 || $fetchedUserRole == "admin"): ?>
                        <a href="#" onclick="deleteAlert('<?= $r['quotation_id'] ?>','quotations','quotation_id','view_orders_tb')" class="btn btn-danger btn-sm m-1">Delete</a>


                      <?php endif; ?>


                      <a target="_blank" href="print_sale.php?type=quotation&id=<?= $r['quotation_id'] ?>" class="btn btn-admin2 btn-sm m-1">Print</a>
                    </td>
                  </tr>
                <?php  } ?>
              </tbody>
            </table>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container-fluid -->

    </main> <!-- main -->
  </div> <!-- .wrapper -->

</body>

</html>
<?php include_once 'includes/foot.php'; ?>
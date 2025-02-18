<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php';
if (isset($_REQUEST['edit_product_id'])) {
  $fetchproduct = fetchRecord($dbc, "product", "product_id", base64_decode($_REQUEST['edit_product_id']));
}
$btn_name = isset($_REQUEST['edit_product_id']) ? "Update" : "Add";

?>
<style type="text/css">
  .badge {
    font-size: 15px;
  }
</style>

<body class="horizontal light  ">
  <div class="wrapper">
    <?php include_once 'includes/header.php'; ?>
    <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header card-bg" align="center">

            <div class="row">
              <div class="col-12 mx-auto h4">
                <b class="text-center card-text">Product Management</b>

                <a href="stockreport.php" class="btn btn-admin float-right btn-sm mx-1">Print Stock (Advance)</a>
                <a href="stock.php?type=simple" class="btn btn-admin float-right btn-sm mx-1">Print Stock</a>
                <a href="stock.php?type=amount" class="btn btn-admin float-right btn-sm mx-1">Print Stock With Amount</a>

                <a href="product.php?act=add" class="btn btn-admin float-right btn-sm mx-1">Add New</a>
              </div>
            </div>

          </div>
          <?php if (@$_REQUEST['act'] == "add"): ?>
            <div class="card-body">
              <form action="php_action/custom_action.php" id="add_product_fm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="product_module">
                <input type="hidden" name="product_id" value="<?= @base64_encode($fetchproduct['product_id']) ?>">
                <input type="hidden" id="product_add_from" value="page">


                <div class="form-group row">
                  <div class="col-sm-2 mb-3 mb-sm-0">
                    <label for="">Product Name</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Product Name" name="product_name" required value="<?= @$fetchproduct['product_name'] ?>">
                  </div>
                  <div class="col-sm-2 mb-3 mb-sm-0">
                    <label for="">Product Code</label>
                    <input type="text" class="form-control" id="product_code" placeholder="Product Code" name="product_code" required value="<?= @$fetchproduct['product_code'] ?>">
                  </div>
                  <div class="col-sm-2">
                    <label for="">Product Brand</label>
                    <div id="brandDropdownContainer">
                      <select class="form-control searchableSelect tableData" name="brand_id" id="tableData" size="1">
                        <option value="">Select Brand</option>
                        <?php
                        $result = mysqli_query($dbc, "select * from brands");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <option <?= @($fetchproduct['brand_id'] != $row["brand_id"]) ? "" : "selected" ?> value="<?= $row["brand_id"] ?>"><?= $row["brand_name"] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div id="newBrandDiv" style="display:none;">
                      <input type="text" class="form-control" id="new_brand_name" name="new_brand_name" placeholder="Add New Brand">
                      <input type="hidden" id="new_brand_status" name="new_brand_status" value="1">
                    </div>
                  </div>
                  <div class="col-1 col-md-1">
                    <label class="invisible d-block">.</label>
                    <button type="button" class="btn btn-success btn-sm" id="addBrandBtn">
                      <i class="fa fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm " style="display: none;" id="cancelBrandBtn">Cancel</button>
                  </div>
                  <div class="col-sm-2">
                    <label for="">Product Category</label>
                    <div id="categoryDropdownContainer">
                      <select class="form-control searchableSelect" name="category_id" id="tableData1" size="1">
                        <option value="">Select Category</option>
                        <?php
                        $result = mysqli_query($dbc, "select * from categories");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <option data-price="<?= $row["category_price"] ?>" <?= @($fetchproduct['category_id'] != $row["categories_id"]) ? "" : "selected" ?> value="<?= $row["categories_id"] ?>"><?= $row["categories_name"] ?>-<?= $row["category_price"] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div id="newCategoryDiv" style="display:none;">
                      <input type="text" class="form-control " id="new_category_name" name="new_category_name" placeholder="Add New Category">
                      <input type="hidden" id="new_category_status" name="new_category_status" value="1">
                    </div>
                  </div>
                  <div class="col-1 col-md-1">
                    <label class="invisible d-block">.</label>
                    <button type="button" class="btn btn-danger btn-sm" id="addCategoryBtn">
                      <i class="fa fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm " style="display: none;" id="cancelCategoryBtn">Cancel</button>
                  </div>
                  <div class="col-sm-2 mt-3 mb-sm-0">
                    <label for=""> Rate</label>
                    <input type="text" class="form-control" id="current_rate" placeholder=" Rate" name="current_rate" required value="<?= @$fetchproduct['current_rate'] ?>">
                  </div>
                  <div class="col-sm-3 mt-3">
                    <label for="">Product Alert on Quantity</label>
                    <input type="text" required class="form-control" value="<?= (empty($fetchproduct)) ? 5 : $fetchproduct['alert_at'] ?>" id="alert_at" placeholder="Product Stock Alert" name="alert_at">
                  </div>
                  <div class="col-sm-3 mt-3 mb-sm-0">
                    <label for="">Product Description</label>

                    <textarea class="form-control" name="product_description" placeholder="Product Description"><?= @$fetchproduct['product_description'] ?></textarea>
                  </div>
                  <div class="col-sm-3 mt-3 mb-sm-0">

                    <label for="">Status</label>
                    <select class="form-control" required name="availability" id="availability">
                      <option value="1">Available</option>
                      <option value="0">Not Available</option>
                    </select>

                  </div>
                </div>

                <div class="form-group row">
                  <!-- Product Brand Section -->


                </div>
                <button class="btn btn-admin float-right" type="submit" id="add_product_btn">Save</button>
              </form>
            </div>
          <?php else: ?>
            <div class="card-body">


              <table class="table dataTable col-12" style="width: 100%" id="product_tb">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Brand/Category</th>
                    <?php
                    if ($UserData['user_role'] == 'admin'):
                    ?>
                      <th>Purchase</th>
                    <?php
                    endif;
                    ?>
                    <th>Selling Price</th>
                    <?php if ($get_company['stock_manage'] == 1): ?>
                      <th>Quanity instock</th>
                    <?php endif; ?>
                    <th class="d-print-none
">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $q = mysqli_query($dbc, "SELECT * FROM product WHERE status=1 ");
                  $c = 0;
                  while ($r = mysqli_fetch_assoc($q)) {
                    @$brandFetched = fetchRecord($dbc, "brands", "brand_id", $r['brand_id']);
                    @$categoryFetched = fetchRecord($dbc, "categories", "categories_id", $r['category_id']);
                    $c++;
                  ?>
                    <tr>
                      <td><?= $c ?></td>
                      <td><?= $r['product_code'] ?></td>
                      <td><?= $r['product_name'] ?></td>
                      <td><?= $brandFetched['brand_name'] ?>/<?= $categoryFetched['categories_name'] ?></td>
                      <?php
                      if ($UserData['user_role'] == 'admin'):
                      ?>
                        <td><?= $r['purchase_rate'] ?></td>
                      <?php
                      endif;
                      ?>
                      <td><?= $r['current_rate'] ?>
                      </td>
                      <?php if ($get_company['stock_manage'] == 1): ?>
                        <?php if ($r['quantity_instock'] > $r['alert_at']): ?>
                          <td>

                            <span class="badge p-1 badge-success d-print-none
"><?= $r['quantity_instock'] ?></span>
                          </td>
                        <?php else: ?>
                          <td><span class="badge p-1  badge-danger"><?= $r['quantity_instock'] ?></span> </td>

                        <?php endif; ?>
                      <?php endif; ?>
                      <td class="d-print-none">

                        <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin"): ?>
                          <form action="product.php?act=add" method="POST">
                            <input type="hidden" name="edit_product_id" value="<?= base64_encode($r['product_id']) ?>">
                            <button type="submit" class="btn btn-admin btn-sm m-1 d-inline-block">Edit</button>
                          </form>
                        <?php endif ?>
                        <?php if (@$userPrivileges['nav_delete'] == 1 || $fetchedUserRole == "admin"): ?>
                          <button type="button" onclick="deleteAlert('<?= $r['product_id'] ?>','product','product_id','product_tb')" class="btn btn-admin2 btn-sm  d-inline-block">Delete</button>

                        <?php endif ?>
                        <a href="print_barcode.php?id=<?= base64_encode($r['product_id']) ?>" class="btn btn-primary btn-sm">Barcode</a>
                      </td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>


            <?php endif ?>
            </div>
        </div> <!-- .row -->
      </div> <!-- .container-fluid -->

    </main> <!-- main -->
  </div> <!-- .wrapper -->

</body>

</html>
<?php include_once 'includes/foot.php'; ?>

<script>
  $(document).ready(function() {
    // Show the input field for adding a new Brand when the "plus" button is clicked
    $("#addBrandBtn").click(function() {
      $("#brandDropdownContainer").hide(); // Hide the dropdown
      $("#cancelBrandBtn").show(); // Hide the dropdown
      $("#newBrandDiv").show(); // Show the input field for new brand
    });
    
    // Show the input field for adding a new Category when the "plus" button is clicked
    
    // Hide the input field and show the brand dropdown again
    $("#cancelBrandBtn").click(function() {
      $("#newBrandDiv").hide(); // Hide the input field for new brand
      $("#cancelBrandBtn").hide(); // Hide the dropdown
      $("#brandDropdownContainer").show(); // Show the brand dropdown again
    });
    
    $("#addCategoryBtn").click(function() {
      $("#categoryDropdownContainer").hide(); // Hide the dropdown
      $("#cancelCategoryBtn").show(); // Hide the input field for new brand
      $("#newCategoryDiv").show(); // Show the input field for new category
    });
    // Hide the input field and show the category dropdown again
    $("#cancelCategoryBtn").click(function() {
      $("#cancelCategoryBtn").hide(); // Hide the input field for new brand
      $("#newCategoryDiv").hide(); // Hide the input field for new category
      $("#categoryDropdownContainer").show(); // Show the category dropdown again
    });

  });
</script>
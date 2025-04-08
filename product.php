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

                <!-- <a href="stockreport.php" class="btn btn-admin float-right btn-sm mx-1">Print Stock (Advance)</a>
                <a href="stock.php?type=simple" class="btn btn-admin float-right btn-sm mx-1">Print Stock</a>
                <a href="stock.php?type=amount" class="btn btn-admin float-right btn-sm mx-1">Print Stock With Amount</a> -->

                <!-- <a href="product.php?act=add" class="btn btn-admin float-right btn-sm mx-1">Add New</a> -->
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
                  <div class="col-md-2 mt-3">
                    <label>Product ID#</label>
                    <?php $result = mysqli_query($dbc, "
                                    SHOW TABLE STATUS LIKE 'product'
");
                    $data = mysqli_fetch_assoc($result);
                    $next_increment = $data['Auto_increment']; ?>
                    <input type="text" name="next_increment" id="next_increment"
                      value="SF-PROD-<?= @empty($_REQUEST['edit_purchase_id']) ? $next_increment : $fetchproduct['product_id'] ?>"
                      readonly class="form-control">
                  </div>

                  <div class="col-sm-2 mt-3">
                    <label for="">Product Category</label>
                    <div id="categoryDropdownContainer">
                      <select class="form-control searchableSelect" name="category_id" id="tableData1" size="1">
                        <option value="">Select Category</option>
                        <?php
                        $result = mysqli_query($dbc, "select * from categories");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <option data-price="<?= $row["category_price"] ?>" <?= @($fetchproduct['category_id'] != $row["categories_id"]) ? "" : "selected" ?> value="<?= $row["categories_id"] ?>">
                            <?= $row["categories_name"] ?>-<?= $row["category_price"] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <!-- <div id="newCategoryDiv" style="display:none;">
                      <input type="text" class="form-control " id="new_category_name" name="new_category_name"
                        placeholder="Add New Category">
                      <input type="hidden" id="new_category_status" name="new_category_status" value="1">
                    </div> -->
                  </div>
                  <div class="col-1 col-md-1 mt-3">
                    <label class="invisible d-block">.</label>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#add_category_modal">
                      <i class="fa fa-plus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-danger btn-sm " style="display: none;"
                      id="cancelCategoryBtn">Cancel</button> -->
                  </div>

                  <div class="col-sm-2 mt-3">
                    <label for="">Product Brand</label>
                    <div id="brandDropdownContainer">
                      <select class="form-control searchableSelect tableData" name="brand_id" id="tableData" size="1">
                        <option value="">Select Brand</option>
                        <?php
                        $result = mysqli_query($dbc, "select * from brands");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                          <option <?= @($fetchproduct['brand_id'] != $row["brand_id"]) ? "" : "selected" ?>
                            value="<?= $row["brand_id"] ?>"><?= $row["brand_name"] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-1 col-md-1 mt-3">
                    <label class="invisible d-block">.</label>
                    <button type="button" class="btn btn-success btn-sm" id="addBrandBtn" data-toggle="modal" data-target="#add_brand_modal">
                      <i class="fa fa-plus"></i>
                    </button>
                  </div>

                  <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                    <label for="">Product Code</label>
                    <input type="text" class="form-control" id="product_code" placeholder="Product Code"
                      name="product_code" required value="<?= @$fetchproduct['product_code'] ?>">
                  </div>
                  <div class="col-sm-2 mb-3 mt-3 mb-sm-0">
                    <label for="">Product Name</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Product Name"
                      name="product_name" required value="<?= @$fetchproduct['product_name'] ?>">
                  </div>

                  <div class="col-sm-3 mt-3 mb-sm-0">
                    <label for="">Product Description</label>

                    <textarea class="form-control" name="product_description"
                      placeholder="Product Description"><?= @$fetchproduct['product_description'] ?></textarea>
                  </div>
                  <div class="col-sm-2 mt-3 mb-sm-0">
                    <label for="">Purchase Rate</label>
                    <input type="text" class="form-control" id="purchase_rate" placeholder=" Rate" name="purchase_rate"
                      required value="<?= @$fetchproduct['purchase_rate'] ?>">
                  </div>
                  <div class="col-sm-2 mt-3 mb-sm-0">
                    <label for="">Sale Rate</label>
                    <input type="text" class="form-control" id="current_rate" placeholder=" Rate" name="current_rate"
                      required value="<?= @$fetchproduct['current_rate'] ?>">
                  </div>
                  <div class="col-sm-2 mt-3 mb-sm-0">
                    <label for="">Final Rate</label>
                    <input type="text" class="form-control" id="final_rate" placeholder=" Rate" name="final_rate" required
                      value="<?= @$fetchproduct['final_rate'] ?>">
                  </div>
                  <div class="col-sm-1 mt-3">
                    <label for="">MOQ Alert</label>
                    <input type="text" required class="form-control"
                      value="<?= (empty($fetchproduct)) ? 5 : $fetchproduct['alert_at'] ?>" id="alert_at"
                      placeholder="Product Stock Alert" name="alert_at">
                  </div>

                  <div class="col-sm-2 mt-3 mb-sm-0">

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

              <div class="d-flex justify-content-end mb-3">
                <form action="php_action/download_products.php?action=upload_products" method="POST" enctype="multipart/form-data">
                  <input type="file" name="excel_file" accept=".xlsx, .xls" required>
                  <button type="submit" class="btn btn-success mr-3">Upload Products</button>
                </form>
                <a href="php_action/download_products.php?action=download_products" class="btn btn-primary mr-3">Download Products</a>
                <a href="php_action/download_products.php?action=download_example" class="btn btn-danger">Download Example</a>
              </div>

              <table class="table dataTable col-12" style="width: 100%" id="product_tb">

                <thead>
                  <tr>
                    <!-- <th class="text-dark">#</th> -->
                    <th class="text-dark">Code</th>
                    <th class="text-dark">Name</th>
                    <th class="text-dark" style="width: 20%;">Description</th>
                    <th class="text-dark " style="min-width: 5%;">Category</th>
                    <th class="text-dark" style="width: 15%;">Brand</th>
                    <?php
                    if ($UserData['user_role'] == 'admin'):
                    ?>
                      <th class="text-dark" style="width: 20%;">Purchase Rate</th>
                    <?php
                    endif;
                    ?>
                    <th class="text-dark" style="width: 15%;">Sale Rate</th>
                    <!-- <?php if ($get_company['stock_manage'] == 1): ?>
                      <th class="text-dark">Quanity instock</th>
                    <?php endif; ?> -->
                    <th class="text-dark" style="width: 15%;">Final Rate</th>
                    <th class="d-print-none text-dark " style="width: 15%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $q = mysqli_query($dbc, "SELECT * FROM product ");
                  $c = 0;
                  while ($r = mysqli_fetch_assoc($q)) {
                    @$brandFetched = fetchRecord($dbc, "brands", "brand_id", $r['brand_id']);
                    @$categoryFetched = fetchRecord($dbc, "categories", "categories_id", $r['category_id']);
                    $c++;
                  ?>
                    <tr>
                      <!-- <td><?= $c ?></td> -->
                      <td><?= $r['product_code'] ?></td>
                      <td class="text-capitalize"><?= $r['product_name'] ?></td>
                      <td class="text-capitalize"><?= $r['product_description'] ?></td>
                      <td class="text-capitalize"><?= @$categoryFetched['categories_name'] ?></td>
                      <td class="text-capitalize"><?= @$brandFetched['brand_name'] ?></td>
                      <?php
                      if ($UserData['user_role'] == 'admin'):
                      ?>
                        <td><?= $r['purchase_rate'] ?></td>
                      <?php
                      endif;
                      ?>
                      <td><?= $r['current_rate'] ?>
                      <td><?= $r['final_rate'] ?>
                      </td>
                      <!-- <?php if ($get_company['stock_manage'] == 1): ?>
                        <?php if ($r['quantity_instock'] > $r['alert_at']): ?>
                          <td>

                            <span class="badge p-1 badge-success d-print-none
">        <?= $r['quantity_instock'] ?></span>
                          </td>
                        <?php else: ?>
                          <td><span class="badge p-1  badge-danger"><?= $r['quantity_instock'] ?></span> </td>

                        <?php endif; ?>
                      <?php endif; ?> -->
                      <td class="d-flex">

                        <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin"): ?>
                          <form action="product.php?act=add" method="POST">
                            <input type="hidden" name="edit_product_id" value="<?= base64_encode($r['product_id']) ?>">
                            <button type="submit" class="btn btn-admin btn-sm m-1 d-inline-block">Edit</button>
                          </form>
                        <?php endif ?>
                        <?php if (@$userPrivileges['nav_delete'] == 1 || $fetchedUserRole == "admin"): ?>
                          <button type="button"
                            onclick="deleteAlert('<?= $r['product_id'] ?>','product','product_id','product_tb')"
                            class="btn btn-admin2 btn-sm m-1 d-inline-block">Delete</button>

                        <?php endif ?>
                        <a href="print_barcode.php?id=<?= base64_encode($r['product_id']) ?>"
                          class="btn btn-primary btn-sm m-1">Barcode</a>
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

  <div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="defaultModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <form action="php_action/panel.php" method="POST" role="form" id="formData">
            <div class="msg"></div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="">Name</label>
                <input type="text" class="form-control" value="<?= @$categories['categories_name'] ?>"
                  id="categories_name" name="add_category_name">
                <input type="hidden" class="form-control " value="<?= @$categories['categories_id'] ?>"
                  id="categories_id" name="categories_id">

              </div>

              <div class="col-sm-4">
                <label for="categories_country">Country</label>
                <select class="form-control searchableSelect" id="categories_country" name="categories_country">
                  <option value="<?= @$categories['categories_country'] ?>">Select Country</option>
                  <?php
                  $countries = [
                    "Afghanistan",
                    "Albania",
                    "Algeria",
                    "Andorra",
                    "Angola",
                    "Antigua and Barbuda",
                    "Argentina",
                    "Armenia",
                    "Australia",
                    "Austria",
                    "Azerbaijan",
                    "Bahamas",
                    "Bahrain",
                    "Bangladesh",
                    "Barbados",
                    "Belarus",
                    "Belgium",
                    "Belize",
                    "Benin",
                    "Bhutan",
                    "Bolivia",
                    "Bosnia and Herzegovina",
                    "Botswana",
                    "Brazil",
                    "Brunei",
                    "Bulgaria",
                    "Burkina Faso",
                    "Burundi",
                    "Cabo Verde",
                    "Cambodia",
                    "Cameroon",
                    "Canada",
                    "Central African Republic",
                    "Chad",
                    "Chile",
                    "China",
                    "Colombia",
                    "Comoros",
                    "Congo, Democratic Republic of the",
                    "Congo, Republic of the",
                    "Costa Rica",
                    "Cote d'Ivoire",
                    "Croatia",
                    "Cuba",
                    "Cyprus",
                    "Czech Republic",
                    "Denmark",
                    "Djibouti",
                    "Dominica",
                    "Dominican Republic",
                    "East Timor",
                    "Ecuador",
                    "Egypt",
                    "El Salvador",
                    "Equatorial Guinea",
                    "Eritrea",
                    "Estonia",
                    "Eswatini",
                    "Ethiopia",
                    "Fiji",
                    "Finland",
                    "France",
                    "Gabon",
                    "Gambia",
                    "Georgia",
                    "Germany",
                    "Ghana",
                    "Greece",
                    "Grenada",
                    "Guatemala",
                    "Guinea",
                    "Guinea-Bissau",
                    "Guyana",
                    "Haiti",
                    "Honduras",
                    "Hungary",
                    "Iceland",
                    "India",
                    "Indonesia",
                    "Iran",
                    "Iraq",
                    "Ireland",
                    "Israel",
                    "Italy",
                    "Jamaica",
                    "Japan",
                    "Jordan",
                    "Kazakhstan",
                    "Kenya",
                    "Kiribati",
                    "Korea, North",
                    "Korea, South",
                    "Kosovo",
                    "Kuwait",
                    "Kyrgyzstan",
                    "Laos",
                    "Latvia",
                    "Lebanon",
                    "Lesotho",
                    "Liberia",
                    "Libya",
                    "Liechtenstein",
                    "Lithuania",
                    "Luxembourg",
                    "Madagascar",
                    "Malawi",
                    "Malaysia",
                    "Maldives",
                    "Mali",
                    "Malta",
                    "Marshall Islands",
                    "Mauritania",
                    "Mauritius",
                    "Mexico",
                    "Micronesia",
                    "Moldova",
                    "Monaco",
                    "Mongolia",
                    "Montenegro",
                    "Morocco",
                    "Mozambique",
                    "Myanmar",
                    "Namibia",
                    "Nauru",
                    "Nepal",
                    "Netherlands",
                    "New Zealand",
                    "Nicaragua",
                    "Niger",
                    "Nigeria",
                    "North Macedonia",
                    "Norway",
                    "Oman",
                    "Pakistan",
                    "Palau",
                    "Panama",
                    "Papua New Guinea",
                    "Paraguay",
                    "Peru",
                    "Philippines",
                    "Poland",
                    "Portugal",
                    "Qatar",
                    "Romania",
                    "Russia",
                    "Rwanda",
                    "Saint Kitts and Nevis",
                    "Saint Lucia",
                    "Saint Vincent and the Grenadines",
                    "Samoa",
                    "San Marino",
                    "Sao Tome and Principe",
                    "Saudi Arabia",
                    "Senegal",
                    "Serbia",
                    "Seychelles",
                    "Sierra Leone",
                    "Singapore",
                    "Slovakia",
                    "Slovenia",
                    "Solomon Islands",
                    "Somalia",
                    "South Africa",
                    "South Sudan",
                    "Spain",
                    "Sri Lanka",
                    "Sudan",
                    "Suriname",
                    "Sweden",
                    "Switzerland",
                    "Syria",
                    "Taiwan",
                    "Tajikistan",
                    "Tanzania",
                    "Thailand",
                    "Togo",
                    "Tonga",
                    "Trinidad and Tobago",
                    "Tunisia",
                    "Turkey",
                    "Turkmenistan",
                    "Tuvalu",
                    "Uganda",
                    "Ukraine",
                    "United Arab Emirates",
                    "United Kingdom",
                    "United States",
                    "Uruguay",
                    "Uzbekistan",
                    "Vanuatu",
                    "Vatican City",
                    "Venezuela",
                    "Vietnam",
                    "Yemen",
                    "Zambia",
                    "Zimbabwe"
                  ];

                  foreach ($countries as $country) {
                    // Trim whitespace and compare case-insensitively
                    $selected = (trim(strtolower(@$categories['categories_country'])) == trim(strtolower($country))) ? 'selected' : '';
                  ?>
                    <option <?= $selected ?> value="<?= htmlspecialchars($country) ?>">
                      <?= htmlspecialchars($country) ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>

              </div>


              <div class="col-sm-4">
                <label for=""> Status</label>
                <select class="form-control" id="categories_status" name="categories_status">

                  <option <?= !isset($categories['categories_status']) || $categories['categories_status'] == 1 ? "selected" : "" ?> value="1">Active</option>
                  <option <?= isset($categories['categories_status']) && $categories['categories_status'] == 0 ? "selected" : "" ?> value="0">Inactive</option>
                </select>
              </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-dark float-right" id="formData_btn">Cancel</button>

          <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin" and isset($_REQUEST['edit_brand_id'])): ?>
            <button type="submit" class="btn btn-admin2 float-right" id="formData_btn">Update</button>
          <?php endif ?>
          <?php if (@$userPrivileges['nav_add'] == 1 || $fetchedUserRole == "admin" and !isset($_REQUEST['edit_brand_id'])): ?>
            <button type="submit" class="btn btn-admin float-right" id="formData_btn">Add</button>
          <?php endif ?>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="add_brand_modal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="defaultModalLabel">Add Brand</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">


          <form action="php_action/panel.php" method="POST" role="form" id="formData">
            <div class="msg"></div>
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="">Brand</label>
                <input type="text" class="form-control" value="<?= @$brands['brand_name'] ?>" id="add_brand_name" name="add_brand_name">
                <input type="hidden" class="form-control " value="<?= @$brands['brand_id'] ?>" id="brand_id" name="brand_id">

              </div>
              <div class="col-sm-4">
                <label for="brand_country">Country</label>
                <select class="form-control searchableSelect" id="brand_country" name="brand_country">
                  <option value="">Select Country</option>
                  <?php
                  $countries = [
                    "Afghanistan",
                    "Albania",
                    "Algeria",
                    "Andorra",
                    "Angola",
                    "Antigua and Barbuda",
                    "Argentina",
                    "Armenia",
                    "Australia",
                    "Austria",
                    "Azerbaijan",
                    "Bahamas",
                    "Bahrain",
                    "Bangladesh",
                    "Barbados",
                    "Belarus",
                    "Belgium",
                    "Belize",
                    "Benin",
                    "Bhutan",
                    "Bolivia",
                    "Bosnia and Herzegovina",
                    "Botswana",
                    "Brazil",
                    "Brunei",
                    "Bulgaria",
                    "Burkina Faso",
                    "Burundi",
                    "Cabo Verde",
                    "Cambodia",
                    "Cameroon",
                    "Canada",
                    "Central African Republic",
                    "Chad",
                    "Chile",
                    "China",
                    "Colombia",
                    "Comoros",
                    "Congo, Democratic Republic of the",
                    "Congo, Republic of the",
                    "Costa Rica",
                    "Cote d'Ivoire",
                    "Croatia",
                    "Cuba",
                    "Cyprus",
                    "Czech Republic",
                    "Denmark",
                    "Djibouti",
                    "Dominica",
                    "Dominican Republic",
                    "East Timor",
                    "Ecuador",
                    "Egypt",
                    "El Salvador",
                    "Equatorial Guinea",
                    "Eritrea",
                    "Estonia",
                    "Eswatini",
                    "Ethiopia",
                    "Fiji",
                    "Finland",
                    "France",
                    "Gabon",
                    "Gambia",
                    "Georgia",
                    "Germany",
                    "Ghana",
                    "Greece",
                    "Grenada",
                    "Guatemala",
                    "Guinea",
                    "Guinea-Bissau",
                    "Guyana",
                    "Haiti",
                    "Honduras",
                    "Hungary",
                    "Iceland",
                    "India",
                    "Indonesia",
                    "Iran",
                    "Iraq",
                    "Ireland",
                    "Israel",
                    "Italy",
                    "Jamaica",
                    "Japan",
                    "Jordan",
                    "Kazakhstan",
                    "Kenya",
                    "Kiribati",
                    "Korea, North",
                    "Korea, South",
                    "Kosovo",
                    "Kuwait",
                    "Kyrgyzstan",
                    "Laos",
                    "Latvia",
                    "Lebanon",
                    "Lesotho",
                    "Liberia",
                    "Libya",
                    "Liechtenstein",
                    "Lithuania",
                    "Luxembourg",
                    "Madagascar",
                    "Malawi",
                    "Malaysia",
                    "Maldives",
                    "Mali",
                    "Malta",
                    "Marshall Islands",
                    "Mauritania",
                    "Mauritius",
                    "Mexico",
                    "Micronesia",
                    "Moldova",
                    "Monaco",
                    "Mongolia",
                    "Montenegro",
                    "Morocco",
                    "Mozambique",
                    "Myanmar",
                    "Namibia",
                    "Nauru",
                    "Nepal",
                    "Netherlands",
                    "New Zealand",
                    "Nicaragua",
                    "Niger",
                    "Nigeria",
                    "North Macedonia",
                    "Norway",
                    "Oman",
                    "Pakistan",
                    "Palau",
                    "Panama",
                    "Papua New Guinea",
                    "Paraguay",
                    "Peru",
                    "Philippines",
                    "Poland",
                    "Portugal",
                    "Qatar",
                    "Romania",
                    "Russia",
                    "Rwanda",
                    "Saint Kitts and Nevis",
                    "Saint Lucia",
                    "Saint Vincent and the Grenadines",
                    "Samoa",
                    "San Marino",
                    "Sao Tome and Principe",
                    "Saudi Arabia",
                    "Senegal",
                    "Serbia",
                    "Seychelles",
                    "Sierra Leone",
                    "Singapore",
                    "Slovakia",
                    "Slovenia",
                    "Solomon Islands",
                    "Somalia",
                    "South Africa",
                    "South Sudan",
                    "Spain",
                    "Sri Lanka",
                    "Sudan",
                    "Suriname",
                    "Sweden",
                    "Switzerland",
                    "Syria",
                    "Taiwan",
                    "Tajikistan",
                    "Tanzania",
                    "Thailand",
                    "Togo",
                    "Tonga",
                    "Trinidad and Tobago",
                    "Tunisia",
                    "Turkey",
                    "Turkmenistan",
                    "Tuvalu",
                    "Uganda",
                    "Ukraine",
                    "United Arab Emirates",
                    "United Kingdom",
                    "United States",
                    "Uruguay",
                    "Uzbekistan",
                    "Vanuatu",
                    "Vatican City",
                    "Venezuela",
                    "Vietnam",
                    "Yemen",
                    "Zambia",
                    "Zimbabwe"
                  ];

                  foreach ($countries as $country) {
                    // Trim whitespace and compare case-insensitively
                    $selected = (trim(strtolower(@$brands['brand_country'])) == trim(strtolower($country))) ? 'selected' : '';
                  ?>
                    <option <?= $selected ?> value="<?= htmlspecialchars($country) ?>">
                      <?= htmlspecialchars($country) ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>

              </div>
              <div class="col-sm-4">
                <label for="">Brand Status</label>
                <select class="form-control" id="brand_status" name="brand_status">

                  <option <?= isset($brands['brand_status']) && $brands['brand_status'] == 1 ? "selected" : "" ?> value="1">Active</option>
                  <option <?= isset($brands['brand_status']) && $brands['brand_status'] == 0 ? "selected" : "" ?> value="0">Inactive</option>

                </select>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-dark float-right" id="formData_btn">Cancel</button>

          <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin" and isset($_REQUEST['edit_brand_id'])): ?>
            <button type="submit" class="btn btn-admin2 float-right" id="formData_btn">Update</button>
          <?php endif ?>
          <?php if (@$userPrivileges['nav_add'] == 1 || $fetchedUserRole == "admin" and !isset($_REQUEST['edit_brand_id'])): ?>
            <button type="submit" class="btn btn-admin float-right" id="formData_btn">Add</button>
          <?php endif ?>
          </form>
        </div>

      </div>
    </div>
  </div>

</body>

</html>
<?php include_once 'includes/foot.php'; ?>
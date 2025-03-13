<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php';
if (isset($_REQUEST['edit_brand_id'])) {
  $brands = fetchRecord($dbc, "brands", "brand_id", base64_decode($_REQUEST['edit_brand_id']));
}
$btn_name = isset($_REQUEST['edit_brand_id']) ? "Update" : "Add";
?>

<body class="horizontal light  ">
  <div class="wrapper">
    <?php include_once 'includes/header.php'; ?>
    <main role="main" class="main-content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header card-bg" align="center">

            <div class="row">
              <div class="col-12 mx-auto h4">
                <b class="text-center card-text">Brands</b>


                <!-- <a href="brands.php" class="btn btn-admin float-right btn-sm">Add New</a> -->
              </div>
            </div>

          </div>
          <div class="card-body">

            <form action="php_action/panel.php" method="POST" role="form" id="formData">
              <div class="msg"></div>
              <div class="form-group row">
                <div class="col-sm-2 ">
                  <label for="">Brand Category</label>
                  <div id="categoryDropdownContainer">
                    <select class="form-control searchableSelect" name="category_id" id="tableData1" size="1">
                      <option value="">Select Category</option>
                      <?php
                      $result = mysqli_query($dbc, "select * from categories");
                      while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <option data-price="<?= $row["category_price"] ?>" <?= @($brands['category_id'] != $row["categories_id"]) ? "" : "selected" ?> value="<?= $row["categories_id"] ?>">
                          <?= $row["categories_name"] ?>-<?= $row["category_price"] ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>

                </div>
                <div class="col-1 col-md-1 ">
                  <label class="invisible d-block">.</label>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                    data-target="#add_category_modal">
                    <i class="fa fa-plus"></i>
                  </button>
                </div>
                <div class="col-sm-3">
                  <label for="">Brand</label>
                  <input type="text" class="form-control" value="<?= @$brands['brand_name'] ?>" id="add_brand_name"
                    name="add_brand_name">
                  <input type="hidden" class="form-control " value="<?= @$brands['brand_id'] ?>" id="brand_id"
                    name="brand_id">

                </div>
                <div class="col-sm-3">
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
                <div class="col-sm-3">
                  <label for="">Brand Status</label>
                  <select class="form-control" id="brand_status" name="brand_status">

                    <option value="1" <?= isset($brands['brand_status']) && $brands['brand_status'] == 1 ? "selected" : "" ?>>Active</option>
                    <option value="0" <?= isset($brands['brand_status']) && $brands['brand_status'] == 0 ? "selected" : "" ?>>Inactive</option>

                  </select>
                </div>
              </div>
              <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin" and isset($_REQUEST['edit_brand_id'])): ?>
                <button type="submit" class="btn btn-admin2 float-right" id="formData_btn">Update</button>
              <?php endif ?>
              <?php if (@$userPrivileges['nav_add'] == 1 || $fetchedUserRole == "admin" and !isset($_REQUEST['edit_brand_id'])): ?>
                <button type="submit" class="btn btn-admin float-right" id="formData_btn">Add</button>
              <?php endif ?>
            </form>

          </div>

        </div> <!-- .row -->
        
        <div class="card">
          <div class="card-header card-bg" align="center">

            <div class="row">
              <div class="col-12 mx-auto h4">
                <b class="text-center card-text">Brands List</b>


              </div>
            </div>

          </div>
          <div class="card-body">
            <table class="table dataTable" id="tableData">
              <thead>
                <tr>
                  <th class="text-dark">ID</th>
                  <th class="text-dark">Brand Category</th>
                  <th class="text-dark">Brands Name</th>
                  <th class="text-dark">Country</th>
                  <th class="text-dark">Status</th>
                  <th class="text-dark">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php $q = mysqli_query($dbc, "SELECT * FROM brands WHERE brand_status=1 ");
                $c = 0;
                while ($r = mysqli_fetch_assoc($q)) {
                  @$categoryFetched = fetchRecord($dbc, "categories", "categories_id", $r['category_id']);

                  $c++;



                  ?>
                  <tr>
                    <td><?= $c ?></td>
                    <td class="text-capitalize"><?= @$categoryFetched['categories_name'] ?></td>
                    <td class="text-capitalize"><?= $r['brand_name'] ?></td>
                    <td class="text-capitalize"><?= $r['brand_country'] ?></td>
                    <td>
                      <?php if ($r['brand_status'] == 1): ?>
                        Active
                      <?php else: ?>
                        Inactive
                      <?php endif ?>
                    </td>
                    <td class="d-flex">
                      <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin"): ?>
                        <form action="brands.php" method="POST">
                          <input type="hidden" name="edit_brand_id" value="<?= base64_encode($r['brand_id']) ?>">
                          <button type="submit" class="btn btn-admin btn-sm m-1">Edit</button>
                        </form>


                      <?php endif ?>
                      <?php if (@$userPrivileges['nav_delete'] == 1 || $fetchedUserRole == "admin"): ?>

                        <a href="#" onclick="deleteAlert('<?= $r['brand_id'] ?>','brands','brand_id','tableData')"
                          class="btn btn-admin2 btn-sm m-1">Delete</a>
                      <?php endif ?>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>


            </table>

          </div>

        </div> <!-- .row -->

      </div> <!-- .container-fluid -->

    </main> <!-- main -->
  </div> <!-- .wrapper -->

  <!-- add category modal -->
  <div class="modal fade" id="add_category_modal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
          aria-hidden="true">
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

                        <option value="1" <?= isset($categories['categories_status']) && $categories['categories_status'] == 1 ? "selected" : "" ?>>Active</option>
                        <option value="0" <?= isset($categories['categories_status']) && $categories['categories_status'] == 0 ? "selected" : "" ?>>Inactive</option>

                      </select>
                    </div>
                  </div>


              </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-dark float-right"
                  id="formData_btn">Cancel</button>

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
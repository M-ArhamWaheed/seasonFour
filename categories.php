<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php';
if (isset($_REQUEST['edit_categories_id'])) {
  $categories = fetchRecord($dbc, "categories", "categories_id", base64_decode($_REQUEST['edit_categories_id']));


}
$btn_name = isset($_REQUEST['edit_categories_id']) ? "Update" : "Add";
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
                <b class="text-center card-text">Categories</b>


                <!-- <a href="categories.php" class="btn btn-admin float-right btn-sm">Add New</a> -->
              </div>
            </div>

          </div>
          <div class="card-body">

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
              <?php
              //	 if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin" AND isset($_REQUEST['edit_categories_id'])): 
              if (isset($_REQUEST['edit_categories_id'])):
                ?>
                <button type="submit" class="btn btn-admin2 float-right" id="formData_btn">Update</button>
              <?php endif
              ?>
              <?php
              //if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin" AND !isset($_REQUEST['edit_categories_id'])): 
              if (!isset($_REQUEST['edit_categories_id'])):
                ?>
                <button type="submit" class="btn btn-admin float-right" id="formData_btn">Add</button>
              <?php endif ?>
            </form>

          </div>

        </div> <!-- .row -->

        <div class="card">
          <div class="card-header card-bg" align="center">

            <div class="row">
              <div class="col-12 mx-auto h4">
                <b class="text-center card-text">Categories List</b>


              </div>
            </div>

          </div>
          <div class="card-body">
            <table class="table dataTable" id="tableData">
              <thead>
                <tr>
                  <th class="text-dark">ID</th>
                  <th class="text-dark"> Name</th>
                  <!-- <th class="text-dark">Sale Price</th> -->
                  <th class="text-dark">Country</th>
                  <th class="text-dark">Status</th>
                  <th class="text-dark">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php $q = mysqli_query($dbc, "SELECT * FROM categories");
                $c = 0;
                while ($r = mysqli_fetch_assoc($q)) {
                  $c++;



                  ?>
                  <tr>
                    <td><?= $c ?></td>
                    <td class="text-capitalize"><?= $r['categories_name'] ?></td>
                    <td class="text-capitalize"><?= $r['categories_country'] ?></td>
                    <!-- <td><?= $r['category_purchase'] ?></td> -->
                    <td>
                      <?php if ($r['categories_status'] == 1): ?>
                        Active
                      <?php else: ?>
                        Inactive
                      <?php endif ?>
                    </td>
                    <td class="d-flex">
                      <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin"): ?>
                        <form action="categories.php" method="POST">
                          <input type="hidden" name="edit_categories_id" value="<?= base64_encode($r['categories_id']) ?>">
                          <button type="submit" class="btn btn-admin btn-sm m-1">Edit</button>
                        </form>


                      <?php endif ?>
                      <?php if (@$userPrivileges['nav_delete'] == 1 || $fetchedUserRole == "admin"): ?>

                        <a href="#"
                          onclick="deleteAlert('<?= $r['categories_id'] ?>','categories','categories_id','tableData')"
                          class="btn btn-admin2 btn-sm m-1">Delete</a>
                      <?php endif ?>
                      <a target="_blank" href="stock.php?type=simple&category=<?= $r['categories_id'] ?>"
                        class="btn btn-admin  btn-sm m-1">Print Stock</a>
                      <!-- <a target="_blank" href="stock.php?type=amount&category=<?= $r['categories_id'] ?>" class="btn btn-admin2  btn-sm mx-1">Print Stock With Amount</a>
              <a target="_blank" href="stock.php?type=amount&category=<?= $r['categories_id'] ?>&stock=0" class="btn btn-admin2  btn-sm mx-1">Print Stock With Amount + AQ</a> -->

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

</body>

</html>
<?php include_once 'includes/foot.php'; ?>
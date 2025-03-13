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

                    <option <?= @($brands['brand_status'] == 1) ? "selected" : "selected" ?> value="1">Active</option>
                    <option <?= @($brands['brand_status'] == 0) ? "selected" : "" ?> value="0">Inactive</option>
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
                  $c++;



                ?>
                  <tr>
                    <td><?= $c ?></td>
                    <td><?= $r['brand_name'] ?></td>
                    <td><?= $r['brand_country'] ?></td>
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

                        <a href="#" onclick="deleteAlert('<?= $r['brand_id'] ?>','brands','brand_id','tableData')" class="btn btn-admin2 btn-sm m-1">Delete</a>
                      <?php endif ?>
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
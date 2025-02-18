   <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-sm" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <div class="list-group list-group-flush my-n3">
             <div class="list-group-item bg-transparent">
               <div class="row align-items-center">
                 <div class="col-auto">

                   <span class="fe fe-download fe-24"></span>
                 </div>
                 <div class="col">
                   <small><strong>Sale And Purchases (Add Product row)</strong></small>
                   <div class="my-0 small">alt+enter</div>

                 </div>
               </div>
             </div>
             <div class="list-group-item bg-transparent">
               <div class="row align-items-center">
                 <div class="col-auto">
                   <span class="fe fe-box fe-24"></span>
                 </div>
                 <div class="col">
                   <small><strong>Print Sale or Purchase </strong></small>
                   <div class="my-0 small">alt+p</div>

                 </div>
               </div>
             </div>
             <div class="list-group-item bg-transparent">
               <div class="row align-items-center">
                 <div class="col-auto">
                   <span class="fe fe-inbox fe-24"></span>
                 </div>
                 <div class="col">
                   <small><strong>Save Sale And Purchase</strong></small>
                   <div class="my-0 small">alt+s</div>
                 </div>
               </div> <!-- / .row -->
             </div>
           </div> <!-- / .list-group -->
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
         </div>
       </div>
     </div>
   </div>
   <!-- Modal add----------------product              -->
   <div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="defaultModalLabel">Add Product</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="php_action/custom_action.php" id="add_product_fm" method="POST" enctype="multipart/form-data">

           <div class="modal-body">
             <input type="hidden" name="action" value="product_module">
             <input type="hidden" name="product_id" value="<?= @$fetchproduct['product_name'] ?>">
             <input type="hidden" id="product_add_from" value="modal">

             <div class="form-group row">
               <div class="col-sm-3 mt-3 mb-sm-0">
                 <label for="">Product Name</label>
                 <input type="text" class="form-control" id="product_name" placeholder="Product Name" name="product_name" required value="<?= @$fetchproduct['product_name'] ?>">
               </div>
               <div class="col-sm-2 mt-3 mb-sm-0">
                 <label for="">Product Code</label>
                 <input type="text" class="form-control" id="product_code" placeholder="Code" name="product_code" required value="<?= @$fetchproduct['product_code'] ?>">
               </div>
               <div class="col-sm-3 mt-3 mb-sm-0">
                 <label for="">Sale Rate</label>
                 <input type="number" class="form-control" id="current_rate" placeholder=" Rate" name="current_rate" required value="<?= @$fetchproduct['current_rate'] ?>">
               </div>
               <div class="col-sm-4 mt-3 row">
                 <div class="col-10">
                   <label for="">Product Category</label>
                   <div id="categoryDropdownContainer">
                     <select class="form-control searchableSelect" name="category_id" id="category_id" size="1">
                       <option value="">Select Category</option>
                       <?php
                        $result = mysqli_query($dbc, "SELECT * FROM categories");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                         <option data-price="<?= $row["category_price"] ?>" <?= @($fetchproduct['category_id'] != $row["categories_id"]) ? "" : "selected" ?> value="<?= $row["categories_id"] ?>">
                           <?= $row["categories_name"] ?> - <?= $row["category_price"] ?>
                         </option>
                       <?php } ?>
                     </select>
                   </div>
                   <div id="categoryInputContainer" style="display: none;">
                     <input type="text" class="form-control " id="new_category_name" name="new_category_name" placeholder="Add Category Name">
                     <input type="hidden" id="new_category_status" name="new_category_status" value="1">
                   </div>
                 </div>
                 <div class="col-2 mt-2 p-0">
                   <button type="button" class="btn btn-secondary btn-sm mt-4" id="addCategoryBtn">+</button>
                   <button type="button" class="btn btn-danger btn-sm mt-4" style="display: none;" id="cancelCategoryBtn">Cancel</button>
                 </div>

               </div>

               <div class="col-sm-5 mt-3 row">
                 <div class="col-9">
                   <label for="">Product Brand</label>
                   <div id="brandDropdownContainer">
                     <select class="form-control searchableSelect" name="brand_id" id="brand_id" size="1">
                       <option value="">Select Brand</option>
                       <?php
                        $result = mysqli_query($dbc, "select * from brands");
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                         <option <?= @($fetchproduct['brand_id'] != $row["brand_id"]) ? "" : "selected" ?> value="<?= $row["brand_id"] ?>"><?= $row["brand_name"] ?></option>
                       <?php } ?>
                     </select>
                   </div>
                   <div id="brandInputContainer" style="display: none;">
                     <input type="text" class="form-control " id="new_brand_name" name="new_brand_name" placeholder="Add Brand Name">
                     <input type="hidden" id="new_brand_status" name="new_brand_status" value="1">
                   </div>
                 </div>
                 <div class="col-3 mt-2 p-0">
                   <button type="button" class="btn btn-secondary btn-sm mt-4" id="addBrandBtn">+</button>
                   <button type="button" class="btn btn-danger btn-sm mt-4" style="display: none;" id="cancelBrandBtn">Cancel</button>
                 </div>
               </div>
               <div class="col-sm-7 mt-3 mb-sm-0">
                 <label for="">Product Description</label>

                 <textarea class="form-control" name="product_description" placeholder="Product Description"><?= @$fetchproduct['product_description'] ?></textarea>
               </div>



             </div>
             <div class="modal-footer">
               <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
               <button class="btn btn-admin float-right" type="submit" id="add_product_btn">Save</button>
             </div>
         </form>
       </div>
     </div>
   </div>

   <!-- Modal add----------------product              -->
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
               <div class="col-sm-6">
                 <label for="">Brand</label>
                 <input type="text" class="form-control" value="<?= @$brands['brand_name'] ?>" id="add_brand_name" name="add_brand_name">
                 <input type="hidden" class="form-control " value="<?= @$brands['brand_id'] ?>" id="brand_id" name="brand_id">
               </div>
               <div class="col-sm-6">
                 <label for="">Brand Status</label>
                 <select class="form-control" id="brand_status" name="brand_status">
                   <option <?= @($brands['brand_status'] == 0) ? "selected" : "" ?> value="0">Inactive</option>
                   <option <?= @($brands['brand_status'] == 1) ? "selected" : "selected" ?> value="1">Active</option>
                 </select>
               </div>
             </div>
             <hr>
             <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>

             <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin" and isset($_REQUEST['edit_brand_id'])): ?>
               <button type="submit" class="btn btn-admin2 float-right" id="formData_btn">Update</button>
             <?php endif ?>
             <?php if (@$userPrivileges['nav_add'] == 1 || $fetchedUserRole == "admin" and !isset($_REQUEST['edit_brand_id'])): ?>
               <button type="submit" class="btn btn-admin float-right" id="formData_btn">Add</button>
             <?php endif ?>
           </form>

         </div>
         <div class="modal-footer"></div>

       </div>
     </div>
   </div>

   <!-- Modal add----------------product              -->
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

           <form action="php_action/panel.php" method="POST" role="form" id="formData1">
             <div class="msg"></div>
             <div class="form-group row">
               <div class="col-sm-3">
                 <label for="">Name</label>
                 <input type="text" class="form-control" value="<?= @$categories['categories_name'] ?>" id="categories_name" name="add_category_name">
                 <input type="hidden" class="form-control " value="<?= @$categories['categories_id'] ?>" id="categories_id" name="categories_id">

               </div>
               <div class="col-sm-3">
                 <label for=""> Status</label>
                 <select class="form-control" id="categories_status" name="categories_status">

                   <option <?= @($categories['categories_status'] == 1) ? "selected" : "selected" ?> value="1">Active</option>
                   <option <?= @($categories['categories_status'] == 0) ? "selected" : "" ?> value="0">Inactive</option>
                 </select>
               </div>
             </div>
             <hr>
             <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Close</button>
             <?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin" and isset($_REQUEST['edit_categories_id'])): ?>
               <button type="submit" class="btn btn-admin2 float-right" id="formData_btn">Update</button>
             <?php endif ?>
             <?php if (@$userPrivileges['nav_add'] == 1 || $fetchedUserRole == "admin" and !isset($_REQUEST['edit_categories_id'])): ?>
               <button type="submit" class="btn btn-admin float-right" id="formData1_btn">Add</button>
             <?php endif ?>
           </form>

         </div>

       </div>
     </div>
   </div>


   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/moment.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/simplebar.min.js"></script>
   <script src='js/daterangepicker.js'></script>
   <script src='js/jquery.stickOnScroll.js'></script>
   <script src="js/tinycolor-min.js"></script>
   <script src="js/config.js"></script>
   <script src="js/d3.min.js"></script>
   <script src="js/topojson.min.js"></script>
   <script src="js/datamaps.all.min.js"></script>
   <script src="js/datamaps-zoomto.js"></script>
   <script src="js/datamaps.custom.js"></script>
   <script src="js/Chart.min.js"></script>
   <script src="js/jquery-ui.min.js"></script>

   <script>
     /* defind global options */
     Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
     Chart.defaults.global.defaultFontColor = colors.mutedColor;
   </script>
   <script src="js/gauge.min.js"></script>
   <script src="js/jquery.sparkline.min.js"></script>
   <script src="js/apexcharts.min.js"></script>
   <script src="js/apexcharts.custom.js"></script>
   <script src='js/jquery.mask.min.js'></script>
   <script src='js/select2.min.js'></script>
   <script src='js/jquery.steps.min.js'></script>
   <script src='js/jquery.validate.min.js'></script>
   <script src='js/jquery.timepicker.js'></script>
   <script src='js/dropzone.min.js'></script>
   <script src='js/uppy.min.js'></script>
   <script src='js/quill.min.js'></script>
   <script src='js/jquery.dataTables.min.js'></script>
   <script src='js/dataTables.bootstrap4.min.js'></script>
   <script src="js/apps.js"></script>
   <script src="js/custom.js"></script>
   <script src="js/panel.js"></script>
   <script>
     $(document).ready(function() {
       // Show the input field and hide the dropdown
       $('#addBrandBtn').on('click', function() {
         $('#brandDropdownContainer').hide();
         $('#addBrandBtn').hide();
         $('#brandInputContainer').show();
         $('#cancelBrandBtn').show();
         $('#brand_id').val('').trigger('change');
       });

       // Hide the input field and show the dropdown
       $('#cancelBrandBtn').on('click', function() {
         $('#addBrandBtn').show();
         $('#cancelBrandBtn').hide();
         $('#brandInputContainer').hide();
         $('#brandDropdownContainer').show();
         $('#new_brand_name').val(''); // Clear the input
       });
     });
     $(document).ready(function() {
       // Show the input field and hide the dropdown for categories
       $('#addCategoryBtn').on('click', function() {
         $('#categoryDropdownContainer').hide();
         $('#addCategoryBtn').hide();
         $('#categoryInputContainer').show();
         $('#cancelCategoryBtn').show();
         $('#category_id').val('').trigger('change'); // Clear selection
       });

       // Hide the input field and show the dropdown for categories
       $('#cancelCategoryBtn').on('click', function() {
         $('#addCategoryBtn').show();
         $('#cancelCategoryBtn').hide();
         $('#categoryInputContainer').hide();
         $('#categoryDropdownContainer').show();
         $('#new_category_name').val(''); // Clear the input field
       });
     });
   </script>
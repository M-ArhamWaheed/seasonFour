<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php';
$getCustomer = @$_REQUEST['id'];
if (@$getCustomer) {

	$Getdata = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM customers WHERE customer_id = '$getCustomer'"));
}

?>
<style>
	.tag-container {
		display: flex;
		flex-wrap: wrap;
		border: 1px solid #ccc;
		padding: 5px;
		border-radius: 5px;
		min-height: 40px;
	}

	.tag {
		background: #007bff;
		color: #fff;
		padding: 5px 10px;
		margin: 3px;
		border-radius: 3px;
		display: flex;
		align-items: center;
	}

	.tag .remove {
		margin-left: 8px;
		cursor: pointer;
		font-weight: bold;
	}

	input {
		border: none;
		outline: none;
		padding: 5px;
		width: auto;
		flex: 1;
	}
</style>

<body class="horizontal light  ">
	<div class="wrapper">
		<?php include_once 'includes/header.php'; ?>
		<main role="main" class="main-content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">


						<div class="card card-info">
							<div class="card-header text-center h4"><?= ucfirst($_REQUEST['type']) ?> Information</div>
							<div class=" card-body">
								<form action="php_action/custom_action.php" method="post" id="formData">
									<input type="hidden" name="add_manually_user" value="<?= @$_REQUEST['type'] ?>">
									<input type="hidden" name="customer_id" value="<?= @$_REQUEST['id'] ?>">
									<div class="form-group row">
										<div class="col-sm-6 mt-3">

											<label for="email">Name:</label>
											<input type="text" class="form-control" id="customer_name" name="customer_name" required autofocus="true" placeholder="Full Name" value="<?= @$Getdata['customer_name'] ?>">
										</div>

										<?php if ($_REQUEST['type'] != "bank" and $_REQUEST['type'] != "expense"): ?>
											<div class="col-sm-6 mt-3">

												<label for="email">Email:</label>
												<input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Email" value="<?= @$Getdata['customer_email'] ?>">

											</div>
										<?php endif ?>

										<?php if ($_REQUEST['type'] != "expense"): ?>

											<div class="col-sm-6 mt-3">

												<label for="email">Phone:</label>
												<input type="number" class="form-control" id="customer_phone" name="customer_phone" placeholder="Phone" value="<?= @$Getdata['customer_phone'] ?>" required>
											</div>
										<?php endif ?>



										<div class="col-sm-6 mt-3">



											<label for="active">Status:</label>
											<select name="customer_status" required class="form-control ">
												<option value="1" selected>Active</option>
												<option value="0">Inactive</option>
											</select>

										</div>
										<?php if ($_REQUEST['type'] == "supplier"): ?>

											<div class="col-sm-12 mt-3">
												<label for="representatives">Representative :</label>
												<div class="tag-container" style="border: 1px solid #ccc; padding: 5px; min-height: 40px; display: flex; flex-wrap: wrap;"></div>
												<input type="text" class="form-control mt-3" id="representatives" name="representatives" placeholder="Write Here...">
												<input type="hidden" id="representative_values" name="representative_values">
											</div>

											<!-- Hidden field to store JSON data -->
											<input type="hidden" id="existing_tags" value='<?= @$Getdata["representatives"] ?>'>


										<?php endif ?>
									</div>
									<?php if ($_REQUEST['type'] == 'customer') { ?>
										<div class="col-sm-12 my-3 mx-0 px-0">
											<label for="email">Limit Amount:</label>
											<input type="number" class="form-control" id="check_amount" name="check_amount" placeholder="Amount Here" value="<?= @$Getdata['customer_limit'] ?>">
										</div>
									<?php } ?>


									<?php if ($_REQUEST['type'] != "expense"): ?>

										<div class="form-group">
											<label for="address">Address:</label>
											<textarea name="customer_address" id="customer_address" cols="30" rows="4" placeholder="Address" class="form-control"><?= @$Getdata['customer_address'] ?></textarea>
										</div>
									<?php endif ?>


									<div class="modal-footer">
										<?php
										if (isset($_REQUEST['id'])) {
										?>
											<button type="submit" id="formData_btn" class="btn btn-admin2" name="edit_customer">Update</button>
										<?php
										} else {
										?>
											<button type="submit" id="formData_btn" class="btn btn-admin" name="add_customer">ADD</button>
										<?php
										}
										?>
									</div>

								</form>
							</div>
						</div>


					</div>
					<div class="col-sm-12">

						<div class="card card-info mt-3">
							<div class="card-header" align="center">
								<h5><span class="glyphicon glyphicon-user"></span> <?= ucfirst($_REQUEST['type']) ?> Management system</h5>
							</div>
							<div class="card-body">

								<table id="tableData" class=" table dataTable ">

									<thead>
										<tr class="">
											<?php if (@$_REQUEST['type'] == 'expense') { ?>
												<th class="text-dark"> ID</th>
											<?php } ?>
											<?php if (@$_REQUEST['type'] !== 'expense') { ?>
												<th class="text-dark">Date</th>
												<th class="text-dark">Name</th>
												<th class="text-dark">Phone</th>
											<?php } ?>
											<?php if (@$_REQUEST['type'] == 'expense') { ?>
												<th class="text-dark">Date</th>
												<th class="text-dark">Name</th>
												<th class="text-dark">Status</th>
											<?php } ?>
											<?php if (@$_REQUEST['type'] !== 'expense') { ?>
												<?php if (@$_REQUEST['type'] == 'supplier') { ?>
													<th class="text-dark">Representatives </th>
												<?php } ?>
												<?php if (@$_REQUEST['type'] !== 'supplier') { ?>
													<th class="text-dark">Address</th>
													<?php if ($_REQUEST['type'] == 'customer'): ?>
														<th class="text-dark"> Credit LIMIT</th>
													<?php endif; ?>
													<th class="text-dark">Status</th>
												<?php } ?>
											<?php } ?>
											<th class="text-dark">Action</th>



										</tr>
									</thead>
									<tbody>
										<?php $q = mysqli_query($dbc, "SELECT * FROM customers WHERE customer_status =1 AND customer_type='" . $_REQUEST['type'] . "'");
										while ($r = mysqli_fetch_assoc($q)):
											$customer_id = $r['customer_id'];
										?>
											<tr>
												<?php if (@$_REQUEST['type'] == 'expense') { ?>
													<td><?= $r['customer_id'] ?></td>
												<?php } ?>
												<?php if (@$_REQUEST['type'] !== 'expense') { ?>
													<td><?= date('Y-m-d', strtotime($r['customer_add_date'])); ?></td>
													<td class="text-capitalize"><?= $r['customer_name'] ?></td>
													<td><?= $r['customer_phone'] ?></td>
													<?php if (@$_REQUEST['type'] == 'supplier') { ?>
														<td class="text-capitalize">
															<?php
															$representatives = json_decode($r['representatives'], true);
															if (is_array($representatives)) {
																echo implode(', ', $representatives); // Display as a comma-separated list
															} else {
																echo $r['representatives']; // If not an array, display as-is
															}
															?>
														</td>

													<?php } ?>
													<?php if (@$_REQUEST['type'] !== 'supplier' && @$_REQUEST['type']   !== 'expense') { ?>
														<td class="text-capitalize"><?= $r['customer_address'] ?></td>
														<?php if ($_REQUEST['type'] == 'customer'): ?>
															<td><?= $r['customer_limit'] ?></td>
														<?php endif; ?>
														<td class="text-capitalize"><?= $r['customer_status'] == 1 ? 'Active' : 'Inactive' ?></td>
													<?php } ?>

												<?php } ?>
												<?php if (@$_REQUEST['type'] == 'expense') { ?>
													<td><?= $r['customer_add_date'] ?></td>
													<td class="text-capitalize"><?= $r['customer_name'] ?></td>
													<td><?= $r['customer_status'] ?></td>
												<?php } ?>


												<td class="d-flex">
													<!-- <button class="btn btn-admin btn-sm float-right" onclick="SetLimit(<?= $r['customer_id'] ?>,'<?= $r['customer_name'] ?>')" id="limit">Limit</button> -->
													<?php if (@$userPrivileges['nav_edit'] == 1 || $fetchedUserRole == "admin"): ?>
														<form action="customers.php?type=<?= $_REQUEST['type'] ?>" method="POST">
															<input type="hidden" name="id" value="<?= $r['customer_id'] ?>">
															<button type="submit" class="btn btn-admin btn-sm">Edit</button>
														</form>
														<a href="#" onclick="deleteAlert('<?= $r['customer_id'] ?>','customers','customer_id','tableData')" class="btn btn-danger btn-sm ml-1">Delete</a>

													<?php endif ?>

												</td>


											</tr>
										<?php endwhile; ?>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div> <!-- .container-fluid -->

		</main> <!-- main -->
	</div> <!-- .wrapper -->


	<?php
	include_once "limitmodal.php";
	?>
</body>

</html>

<script type="text/javascript">
	function SetLimit(customer_id, customer_name) {

		$("#LimitCustomer").val(customer_id);
		$("#defaultModalLabel").html('Add Limit of : ' + customer_name);
		$('#add_limit_modal').modal('show');

		$.ajax({
			type: 'POST',
			url: 'php_action/custom_action.php',
			data: {
				LimitCustomerajax: customer_id
			},
			dataType: 'json',
			beforeSend: function() {

			},
			success: function(response) {

				if (response.sts == "success") {
					$("#td_check_no").val(response.check_no);
					$("#voucher_bank_name").val(response.bank_name);
					$("#td_check_date").val(response.check_date);
					$("#check_type").val(response.check_type);
					$("#check_amount").val(response.check_amount);
					$("#location_info").val(response.check_location);

				}
			}
		}); //ajax call


	}
</script>



<?php include_once 'includes/foot.php'; ?>

<script>
	$(document).ready(function() {
		let existingTags = $("#existing_tags").val(); // Get stored tags from hidden input
		let tagContainer = $(".tag-container");

		if (existingTags) {
			try {
				let tagsArray = JSON.parse(existingTags); // Parse JSON string to array

				tagsArray.forEach(function(tag) {
					addTag(tag); // Function to create tag UI
				});

				updateHiddenInput(); // Update hidden input field
			} catch (e) {
				console.error("Error parsing existing tags:", e);
			}
		}

		$("#representatives").keypress(function(event) {
			if (event.which === 13) { // Enter key pressed
				event.preventDefault();
				let tagText = $(this).val().trim();

				if (tagText !== "") {
					addTag(tagText);
					updateHiddenInput();
					$(this).val(""); // Clear input field
				}
			}
		});

		function addTag(tagText) {
			let tag = $("<div class='tag'></div>").text(tagText);
			let removeBtn = $("<span class='remove'>&times;</span>").click(function() {
				$(this).parent().remove();
				updateHiddenInput();
			});

			tag.append(removeBtn);
			tagContainer.append(tag);
		}

		function updateHiddenInput() {
			let tags = [];
			$(".tag").each(function() {
				tags.push($(this).text().replace("×", "").trim()); // Remove close button text
			});
			$("#representative_values").val(JSON.stringify(tags)); // Store updated tags as JSON
		}
	});
</script>

				<?php
					if (isset($_POST['submit_cat'])) {
						$cat_name = $_POST['category']; // category name
						$cat_type = "expenses"; // category type
						$user_id = $_SESSION['id']; // user id
						// instantiate the modal class
						$model = new Model;
						$model->add_cat($cat_name,$cat_type,$user_id);
					}
					if (isset($_POST['submit_exp'])) {
						$user_id = $_SESSION['id']; // user id
						$name = strip_tags($_POST['name']);
						$amount = strip_tags($_POST['amount']);
						$date = $_POST['date'];
						$description = strip_tags($_POST['description']);
						$category = strip_tags($_POST['category']);
						$place = strip_tags($_POST['place']);
						$model = new Model;
						$model->add_exp($user_id,$name,$amount,$date,$description,$category,$place);
					}
				?>
						<!-- modal section for category	 -->
					<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" arial-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Add new category</h4>
									<button type="submit" class="close" data-dismiss="modal" arial-label="Close" ><span arial-hidden="true">&times;</span></button>
									
								</div>
								<div class="modal-body">
									<form class="form-group" enctype="multipart/form-data" method="POST" action="">
										<label for="category">Category</label>
                                        <input type="text" name="category" placeholder="enter the category" required class="form-control"><br>
										<button type="submit" class="btn btn-primary" name="submit_cat">Submit</button>
									</form>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-default" data-dismiss="modal">Close
									</button>									
								</div>
							</div>
						</div>
					</div>
					
					<!-- modal section for expenses -->
					<div class="modal fade" id="addexpense" tabindex="-1" role="dialog" arial-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Add expense</h4>
									<button type="submit" class="close" data-dismiss="modal" arial-label="Close" ><span arial-hidden="true">&times;</span></button>
									
								</div>
								<div class="modal-body">
									<form class="form-group" enctype="multipart/form-data" method="POST" action="">
										<label for="item">Item</label>
										<input type="text" class="form-control" name="name" required>
										<label for="item-cost">Item Cost</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<div class="input-group-text">#</div>
											</div>
											<input type="number" class="form-control" name="amount" required>
										</div>
										<label for="item">Item Date</label>
										<input type="date" class="form-control" name="date" required><br>
										<label for="post-category">Item category</label>
										<select class="form-control" name="category" id="" required><br>
											<option value="" disabled selected>choose category</option>
											<?php 
												$modal = new Model;
												//category type
												$type = 'expenses';
												// user id
												$user_id = $_SESSION['id'];
												$fetch = $modal->fetch_cat($type,$user_id);
												foreach($fetch as $fetches){?>
											<option value=<?= $fetches['category_name'];?> ><?= $fetches['category_name'];?></option>
											<?php }?>	
										</select><br>				
										<label for="item">Item Place</label>
										<input type="text" class="form-control" name="place" required><br>
										<label for="item">Item Description</label>
										<textarea name="description" class="form-control" id="" cols="15"></textarea><br>
										<button type="submit" class="btn btn-primary" name="submit_exp">Submit</button>
									</form>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-default" data-dismiss="modal">Close
									</button>									
								</div>
							</div>
						</div>
					</div>
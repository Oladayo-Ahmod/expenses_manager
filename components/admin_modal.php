<!-- modal section for category	 -->
				<?php
					if (isset($_POST['submit_cat'])) {
						$cat_name = $_POST['category']; // category name
						$cat_type = "expenses"; // category type
						// instantiate the modal class
						$model = new Model;
						$model->add_cat($cat_name,$cat_type);
					}
				?>
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
					
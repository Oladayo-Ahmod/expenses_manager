
<!-- modals section for sigunp--->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" arial-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Sign Up</h4>
									<button type="submit" class="close" data-dismiss="modal" arial-label="Close" ><span arial-hidden="true">&times;</span></button>
									
								</div>
								<div class="modal-body">
								<?php
									include 'model/modal.php';
									if (isset($_POST['signup'])) {
										$name = strip_tags($_POST['name']);
										$email = strip_tags($_POST['email']);
										$username = strip_tags($_POST['username']);
										$password = md5($_POST['password']);
										$c_password = md5($_POST['c_password']);
										$model = new Model;
										$model->signup($name,$email,$username,$password,$c_password);
									}

								?>
									<form class="form-group" enctype="multipart/form-data" method="POST" action="">
										<label for="name">Name</label>
                                        <input type="text" name="name" placeholder="" required class="form-control"><br>
										<label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id=""><br>
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control" id=""><br>
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control"><br>
										<label for="password">Confirm password</label>
                                        <input type="password" name="c_password" class="form-control"><br>
										<button type="submit" class="btn btn-primary" name="signup">Submit</button>
									</form>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-default" data-dismiss="modal">Close
									</button>									
								</div>
							</div>
						</div>
					</div>

					<!-- modal section for forgotten password	 -->
					<div class="modal fade" id="f_pass" tabindex="-1" role="dialog" arial-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="myModalLabel">Forgotten Password</h4>
									<button type="submit" class="close" data-dismiss="modal" arial-label="Close" ><span arial-hidden="true">&times;</span></button>
									
								</div>
								<div class="modal-body">
									<form class="form-group" enctype="multipart/form-data" method="POST" action="">
										<label for="name">Email</label>
                                        <input type="email" name="email" placeholder="Enter your email" required class="form-control"><br>
										<button type="submit" class="btn btn-primary" name="submit">Submit</button>
									</form>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-default" data-dismiss="modal">Close
									</button>									
								</div>
							</div>
						</div>
					</div>
					
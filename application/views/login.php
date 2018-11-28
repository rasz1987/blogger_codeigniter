
	<section>
		<div class="container">
			
			<div class="row justify-content-center">
				<div class="col-6 mt-5">
					<div id="msg" >

					</div>
					<form id="myFormLogin" method="POST" action="<?php echo base_url('login'); ?>">
						<div class="form-group">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
						</div>
						<div class="form-group form-check">
							<input type="checkbox" class="form-check-input" id="exampleCheck1">
							<label class="form-check-label" for="exampleCheck1">Check me out</label>
						</div>
						<div class="form-group">
							<a href="#">Password recovery</a> | <a href="#exampleModalCenter" data-toggle="modal" >Create account</a>
						</div>
						<button type="submit" class="btn btn-primary">Login</button>
					</form>
				</div>
			</div>
	
			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Create User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
						<?php
							//Declaration of variables for dropdown
							$opt_q = array_combine(
								array_column($questions, 'id'), 
								array_column($questions, 'question')
							);
						?>
					<form id="myForm" action="<?php echo base_url('save'); ?>" method="post">
						<div class="form-group">
							<label for="name">Name & Lastname:</label>
							<input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter your name" maxlength= "150" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter your lastname" maxlength= "150" required>
						</div>
						<div class="form-group">
							<label for="email">Email & User:</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" maxlength= "150" required>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="user" name="user" placeholder="Enter your user" maxlength= "150" required>
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" maxlength="150" required>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" id="passconf" name="passconf" placeholder="Retype your password" maxlength="150" required>
						</div>
						<hr>
						<div>
							<h5 class="modal-tittle">Questions to recovery password</h5>
						</div>
						<div class="form-group">
							<label for="email">First question:</label>
							<?php echo form_dropdown('firstQ',$opt_q,'','class="form-control"');?>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="firstA" name="firstA" placeholder="Enter your first answer" maxlength= "250" required>
						</div>

						<div class="form-group">
							<label for="email">Second question:</label>
							<?php echo form_dropdown('secondQ',$opt_q,'','class="form-control"'); ?>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="secondA" name="secondA" placeholder="Enter your second answer" maxlength= "250" required>
						</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="save" class="btn btn-success">Save changes</button>
					</form>
					<button id="close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
				</div>
			</div>
			<!-- Modal -->

		</div>
	<script src="<?php echo base_url('assets/js/script_login.js'); ?>"></script>
	</section>
	
	
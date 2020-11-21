<?php
	$msg = '';
	if(isset($_POST['hackathonsubmit'])){        
		$teamname = $_REQUEST['teamname'];
		$teammember = implode(',' ,$_REQUEST['teammember']);
		$themename = $_REQUEST['themename'];
		$colcompname = $_REQUEST['colcompname'];
		$contno = $_REQUEST['contno'];
		$emailid = $_REQUEST['emailid'];
		$role = 'member';
		if($teamname == '' || $teammember == '' || $themename == '' || $colcompname == '' || $contno == '' || $emailid == '')
		{
			$msg = "<div class='alert alert-danger'>(*) Fields are required!</div>";
		}
		elseif ( email_exists( $emailid ) ) {
			$msg =  "<div class='alert alert-danger'>Email Already in use</div>";	
		}
		else{
			$userdata = array(
				'user_login'    =>   trim($teamname),
				'user_email'    =>   $emailid,
				'first_name'    =>   $teamname,
				'user_pass'     => 'ash2020!#@',
				'role' => $role
				);
			 $user = wp_insert_user( $userdata );
			 add_user_meta( $user, 'teammember', $teammember);
			 add_user_meta( $user, 'themename', $themename);
			 add_user_meta( $user, 'companyname', $colcompname);
			 add_user_meta( $user, 'contactno', $contno);
			 add_user_meta( $user, 'ustatus', 0);
			
				if ( $user && !is_wp_error( $user ) ) {
					 $msg =  "<div class='alert alert-success'>Thank you for registring, A validation email has been sent to you. Please click on the link to verify.</div>";
				
			}
			
			}
		
		}
	
?>

<?php if($msg <> '') { echo $msg; } ?>
		<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<div class="row">
		
			<div class="col-md-12" id="dataresults"></div>
					<div class="col-md-6">
						<label for="teamname">Team Name*</label>
						<input type="text" class="form-control" name="teamname" id="teamname" required>
					</div>
					<div class="col-md-6 input_fields_wrap">
						<label for="teammember" style="width:100%;">Team Member* <span class="addmore" style="float:right"><i class="fa fa-plus-circle fa-1x"></i></span></label>
						<input type="text" class="form-control" name="teammember[]" id="teammember" required>
					</div>
					<div class="col-md-6">
						<label for="themename">Theme*</label>
						<select class="form-control" name="themename" id="themename" required>
							<option value="" selected>- Choose --</option>
							<option value="Agriculture">Agriculture</option>
							<option value="Cloud Computing">Cloud Computing</option>
							<option value="Child Welfare">Child Welfare</option>
							<option value="Election">Election</option>
						</select>
					</div>
					<div class="col-md-6">
						<label for="colcompname">College Name/ Company Name*</label>
						<input type="text" class="form-control" name="colcompname" id="colcompname" required>
					</div>
					<div class="col-md-6">
						<label for="contno">Contact No.*</label>
						<input type="number" class="form-control" name="contno" id="contno" required>
					</div>
					<div class="col-md-6">
						<label for="emailid">Email ID*</label>
						<input type="email" class="form-control" name="emailid" id="emailid" required>
					</div>
			        <div class="col-md-12">
						<input type="submit" value="Register" name="hackathonsubmit" id="hackathonsubmit" >
					</div>
				
		</div>
			</form>

<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$txtreg =$txtAppID=$errPL="";
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$txtAppID =trim($_POST['txtAppID']); 
	$txtreg =trim($_POST['txtreg']);
	if($txtAppID!="" && $txtreg!=""){
		$stmt_in = $conn->prepare("SELECT * FROM student_info where sregno=? or sappid=? Limit 1");
		$stmt_in->execute(array($txtreg,$txtAppID));
		$affected_rows_in = $stmt_in->rowCount();
		if($affected_rows_in < 1) 
		{	
			$errPL="Error: The RegNo or App ID does not exist . Contact ICT !!!";
		}else{
			//check if application form is filled
				$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
				$sec="Act_Me";
				$row = $stmt_in->fetch(PDO::FETCH_ASSOC);
				$_SESSION['app_id'] = $row['sappid'];
				$_SESSION['regno'] = $row['sregno'];
				$_SESSION['email_id'] = $row['semail'];
				if($row['sstatus'] =="0"){
					header("location: complete_application.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
				}else{
					header("location: student_account.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
				}
				
			}
	}else{
		$errPL="Error: Empty Data's Provided !!!";
	}									
}
?>
</head>
<body style="width:80%;margin:auto">
<div class="container-fluid" >
		<div class="row">
			<?php
				require_once 'settings/nav_top.php';
			?> 
		</div>
	
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
	<div class="row" style="background-color:#CCFFFF;">
		<!-- middle content ends here where vertical nav slides and news ticker ends -->
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="vertical-spacing:3px;word-spacing:3px;line-height:150%;background-color:#CCCCFF;text-align:justify">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 style="font-weight:bold;background-color:grey;color:white;padding:10px 5px 10px 5px"> About Online Clearance System <h4/>
				<hr/>
				<p style="">Online clearance system is a research work that will help build an effective information management for schools. It is aimed at developing a system for making clearance after graduation hitch free. The designed software will serve as a more reliable and effective means of undertaking students clearance, remove all forms of delay and stress as well as enable you understand the procedures involved as well as how to do your clearance online.</p>
				<p> This project work made use of data collected from the University, materials and journals from various authors and software was developed to effectively achieve the aims of this project...<a class="btn btn-success"href="#">Read more</a></p>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 style="font-weight:bold;background-color:grey;color:white;padding:10px 5px 10px 5px"> Brief Outlines <h4/>
				<hr/>
				<p>The process of clearing students after their graduation required that students be cleared in various departments and information units.<br/>
				Among which are :
				<ol>
					<li>Library fine (Which include Overdue or Lost Library Materials)</li>
					<li>Departmental Dues (Which include all the Departmental Association dues and other Departmental mandatory dues)</li>
					<li>Faculty Dues (Which include all the Faculty Association dues and other Faculty mandatory dues)</li>
					<li>Information and book store charges</li>
					<li>Residence Hall Charges (Rental, Damage and Maintenance Charges among others)</li>
					<li>Return of Athletic Equipments</li>
					<li>Student Union Fine</li>
				</ol>
				</p>
				<p> At each clearance section a staff is assigned the duty to access the students application for clearance and either clear the students for further processing after which the student can now print the clearance acknowledgement slip which will then be forwarded to their respective Faculties...<a class="btn btn-success" href="#">Read more</a></p>
				<h4 style="font-weight:bold;background-color:grey;color:white;padding:10px 5px 10px 5px"><h4/>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;background-color:#CCCCCC;text-align:centre">
			<form role="form"  name="reg_form"  id="form" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
				<h4 style="margin-bottom:20px;background-color:#CCFF33;padding:10px">Please Login - Student</h4>
			<hr/>
				<div class="form-group">
					<label for="txtPasswordC2">Matriculation / Registration N<u>o</u> : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" onkeypress="wipeboxeror('4')" id="txtreg" name="txtreg" value="<?php echo $txtreg;?>" required="true" placeholder="Enter Matriculation / Registration No"/>
					</div>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2">Application ID: </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span> 
						<input type="password" onkeypress="wipeboxeror('4')" class="form-control" id="txtAppID" name="txtAppID" required="true" placeholder="Enter Application ID"/>
					</div>
					<span class="help-block" id="result4" style="color:brown;text-weight:bold;text-align:center;"><?php echo $errPL;?></span>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="submit" name="proceed" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Continue" class="btn btn-primary btn-md"></input>
					</div>
				</div>
				<h4 style="color:yellow;">Forget Your Application ID <a href="#" style="color:black;">Click Here to Retrieve it</a></h4>
			</form>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;">
			<p class="btn btn-success" style="margin-bottom:10px;margin-top:10px;">Step 3 : Check Application / Clearance Status</p>
				<p>Follow the steps bellow :</p>
				<P><ol>
					<li>Click on Check Application Status</li>
					<li>Provide your Application ID and Matriculation / Registration N<u>o</u></li>
					<li style="color:red"><strong>Click Continue</strong></li>
					<li><strong>After Login Successfully Click on Check Application Status</strong></li>
					<li><strong>Your Application / Clearance Slip will be downloaded to your system if the Clearance process is Completed at every departments</strong></li> 
				</ol></P>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;background-color:grey;text-align:centre">
				<hr/>
					<p style="text-align:center"><a href="generate_pin.php"><span class="btn btn-primary">Generate application ID</span></a> | <a href="login_to_profile.php"><span class="btn btn-info">Complete Application</span></a> | <a href="#"><span class="btn btn-success">Check Application Status</span></p>
				<hr/>
			</div>
		</div>
	</div>
	
	<div class="row" style="font-weight:bold;background-color:#CCCCFF;padding:10px 5px 10px 5px">
		<?php
			require_once 'settings/comment.php';
		?>
	</div>
		<?php require_once 'settings/footer_file.php';?>
 </div>
</body>
</html>  

<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$sec="Act_Me";$err=$notice_msg=$er_msg=$er_msg2=$msg2=$msg="";
$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
$link ="0";
if(!isset($_GET['m_']) || !isset($_GET['l_w'])){
		header("location index.php");
}
if($_GET['m_'] != $_SESSION['page_authy'] || $_GET['l_w'] != $sec ){
	header("location index.php");
}

	//verify if all approval is done
	$j_S ="1";
	$stmt_in = $conn->prepare("SELECT * FROM app_status where library=? and department=? and faculty=? and security=? and store=? and hostel=? and athlete=? and sug=? and appid=? Limit 1");
	$stmt_in->execute(array($j_S,$j_S,$j_S,$j_S,$j_S,$j_S,$j_S,$j_S,$_SESSION['app_id']));
	$affected_rows_in = $stmt_in->rowCount();
	if($affected_rows_in >= 1) 
	{
		$link ="1";
		$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
		$sec="Act_Me";
		//header("location: student_account.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
		//application is cleared href="print_Appid.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'"
		$errPL='Your Clearance Application is Completely Cleared .. <a class="btn btn-primary btn-sm" target="_blank" href="print_cleared_application.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">Print</a> the Clearance Slip for further submission to the necessary Department.';
		$notice_msg='<div class="alert alert-success alert-dismissable">
				   <button type="button" class="close" data-dismiss="alert" 
					  aria-hidden="true">
					  &times;
				   </button>'.$errPL.' </div>';
	}else{
		//application is not cleared
		$errPL="Your Application is Not yet Cleared .. Still under Processing.";
		$notice_msg='<div class="alert alert-warning alert-dismissable">
				   <button type="button" class="close" data-dismiss="alert" 
					  aria-hidden="true">
					  &times;
				   </button>'.$errPL.' </div>';
	}
	
	//search for rejected application
	$stmt_in = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on app_status.appid = student_info.sappid where app_status.appid=? Limit 1");
	$stmt_in->execute(array($_SESSION['app_id']));
	$affected_rows_in = $stmt_in->rowCount();
	if($affected_rows_in >= 1) 
	{
		$row = $stmt_in->fetch(PDO::FETCH_ASSOC);

		if($row['library']=="2"){
			$msg = $msg."<li>Library Department</li>";
		}
		if($row['department']=="2"){
			$msg = $msg."<li>".$row['sdept']." Department. </li>";
		}
		if($row['faculty']=="2"){
			$msg = $msg."<li>Faculty of ".$row['sfaculty']."</li>";
		}
		if($row['store']=="2"){
			$msg = $msg."<li>Book Store Section</li>";
		}
		if($row['hostel']=="2"){
			$msg = $msg."<li>Hostel (Hall Reservation) Section</li>";
		}
		if($row['athlete']=="2"){
			$msg = $msg."<li>School Sport Section</li>";
		}
		if($row['sug']=="2"){
			$msg = $msg."<li>Student Union Government Sections</li>";
		}
		if($row['security']=="2"){
			$msg = $msg."<li>Security Sections</li>";
		}
		
		//cleared application
		if($row['library']=="1"){
			$msg2 = $msg2."<li>Library Department</li>";
		}
		if($row['department']=="1"){
			$msg2 = $msg2."<li>".$row['sdept']." Department. </li>";
		}
		if($row['faculty']=="1"){
			$msg2 = $msg2."<li>Faculty of ".$row['sfaculty']."</li>";
		}
		if($row['store']=="1"){ //bursary
			$msg2 = $msg2."<li>Bursary / Finance Department </li>";
		}
		if($row['hostel']=="1"){
			$msg2 = $msg2."<li>Hostel (Hall Reservation) Section</li>";
		}
		if($row['athlete']=="1"){
			$msg2 = $msg2."<li>School Sport Section</li>";
		}
		if($row['sug']=="1"){
			$msg2 = $msg2."<li>Student Union Government Sections</li>";
		}
		if($row['security']=="1"){
			$msg2 = $msg2."<li>Security Sections</li>";
		}
	}
if($msg !=""){
	$msg1 = "<p> Your Clearance Application has been rejected by the bellow Departments / Clearance Section </p>";
	$msg =$msg1 ."<ol>".$msg."</ol>";
	$msg = $msg."<p>Endeavour to meet the Head of above Department or clearance section for to tender your complain for further analysis and clearance !</p>";
	$er_msg='<div class="alert alert-warning alert-dismissable">
				   <button type="button" class="close" data-dismiss="alert" 
					  aria-hidden="true">
					  &times;
				   </button>'.$msg.' </div>';
}

if($msg2 !=""){
	$msg1 = "<p> Your Clearance Application has been Approved (Cleared) by the bellow Departments / Clearance Section </p>";
	$msg2 =$msg1 ."<ol>".$msg2."</ol>";
	$msg2 = $msg2."<p>Always Check to see the progress of your Clearance Application !</p>";
	$er_msg2='<div class="alert alert-info alert-dismissable">
				   <button type="button" class="close" data-dismiss="alert" 
					  aria-hidden="true">
					  &times;
				   </button>'.$msg2.' </div>';
}
$date500 = new DateTime("Now");
$J = date_format($date500,"D");
$Q = date_format($date500,"d-F-Y, h:i:s A");
$dateprint_V = $J.", ".$Q;
$dateprint = "Printed On: ".$J.", ".$Q;	
$txtexit=$txtent=$txtduration=$txtaward=$txtmodestudy=$txtentrance=$txtdept=$txtfaculty=$txttempadd=$txtlgov=$txtPermadd =$txtstate=$txtnationality=$txtreligion=$txtgender=$txtAPhone=$txtPhone=$txtoname=$txtfname=$txttitle=$date_reg="";


	$stmt_in = $conn->prepare("SELECT * FROM student_info where sregno=? or sappid=? Limit 1");
	$stmt_in->execute(array($_SESSION['regno'],$_SESSION['app_id']));
	$affected_rows_in = $stmt_in->rowCount();
	if($affected_rows_in >= 1) 
	{	
		$row = $stmt_in->fetch(PDO::FETCH_ASSOC);
		$txtexit=$row['syearexit'];$txtent=$row['syearent'];$txtduration=$row['scoursedur'];$txtaward=$row['sawardview'];$txtmodestudy=$row['smodestudy'];
		
		$txtentrance=$row['smodeent'];$txtdept=$row['sdept'];$txtfaculty=$row['sfaculty'];$txttempadd=$row['sresidentadd'];$txtlgov=$row['slocalgov'];
		
		$txtPermadd =$row['spermadd'];$txtstate=$row['sstate'];//$txtnationality=$row['snationality'];
		$txtreligion=$row['sreligion'];$txtgender=$row['sgender'];
		
		$txtAPhone=$row['sphonealt'];$txtPhone=$row['sphonemain'];$txtoname=$row['sothername'];$txtfname=$row['sfirstname'];$txttitle=$row['stitle'];
		
		$date500 = new DateTime($row['sregdate']);
		$J = date_format($date500,"D");
		$Q = date_format($date500,"d-F-Y, h:i:s A");
		$dateprint_V = $J.", ".$Q;
		$date_reg = $J.", ".$Q;	
	}			
?>

</head>
<body style="width:80%;margin:auto">
<div class="container-fluid" >
		<div class="row hidden-print">
			<?php
				require_once 'settings/nav_top_login.php';
			?> 
		</div>
	
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
	<div class="row" >
		<div class="imageupload panel panel-info">
			<div class="panel-heading clearfix">
				<h3 class="panel-title pull-left">Welcome - <?php echo $txttitle." ".$txtfname." ".$txtoname; ?></h3>
			</div>
		</div>
		<?php echo $notice_msg;?>
		<?php echo $er_msg;?>
		<?php echo $er_msg2;?>
		<!-- middle content ends here where vertical nav slides and news ticker ends -->
		<form role="form"  name="reg_form"  id="form" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px;">
						<img  style="height:300px" class="img-responsive img-thumbnail" src="resource/<?php echo $_SESSION['app_id'].'.jpg';?>"> </img>
					
			</div>
				<!-- ends copy bootstrap-imageupload. -->
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<h4>Applicant Name : <span><b><?php echo $txttitle." ".$txtfname." ".$txtoname;?></b></span></h4>
				<hr/>
				<h4>Matriculation / Registration N<u>o</u> :<?php echo $_SESSION['regno'];?></h4>
				<hr/>
				<h4>Email Address : <?php echo $_SESSION['email_id'];?></h4>
				<hr/>
				<h4>Application ID : <span style="color:red;"><b><?php echo $_SESSION['app_id'];?></b></span></h4>
				<hr/>
				<h4>Date Of Registration : <span><b><?php echo $date_reg;?></b></span></h4>
				<hr/>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<div id="accordion" class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title ">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> My Application </a>
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="glyphicon glyphicon-chevron-down pull-right"></a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="list-group">
								
								<?php	
									echo '<a style="color:red;text-weight:bold;" class="list-group-item" href="student_account.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&statuscheck='."check".'" >
										<span class="glyphicon glyphicon-dashboard"></span> Check Application Status <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
									</a>';
									if($link =="1"){
										echo '
										<a style="color:black;text-weight:bold;" class="list-group-item"  target="_blank" href="print_cleared_application.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
											<span class="glyphicon glyphicon-print"></span> Print Cleared Application Form <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
										</a>'; 
									}
									echo '
									<a style="color:black;text-weight:bold;" class="list-group-item" target="_blank" href="print_Appid.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
										<span class="glyphicon glyphicon-print"></span> Print Application Form <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
									</a>
									<a href="index.php" class="list-group-item">
										<span class="glyphicon glyphicon-log-out"></span> Log Out  <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
									</a>';
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="row hidden-print" style="font-weight:bold;background-color:#CCCCFF;padding:10px 5px 10px 5px">
		<?php
			require_once 'settings/comment.php';
		?>
	</div>
		<?php require_once 'settings/footer_file.php';?>
 </div>
</body>
</html>  

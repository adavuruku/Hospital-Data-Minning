<?php
session_start();

unset($_SESSION['staff_id']);
unset($_SESSION['work_ryt']);
unset($_SESSION['staff_name']);

require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$txtreg =$txtAppID=$errPL="";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$txtAppID =trim($_POST['txtAppID']); 
	$txtreg =trim($_POST['txtreg']);
	if($txtAppID!="" && $txtreg!=""){
		$stmt_in = $conn->prepare("SELECT * FROM staff_record where staff_id=? and staff_password=?  Limit 1");
		$stmt_in->execute(array($txtreg,$txtAppID));
		$affected_rows_in = $stmt_in->rowCount();
		if($affected_rows_in < 1) 
		{	
			$errPL="Error: The Staff ID or Staff Password does not exist . Contact ICT !!!";
		}else{
			//check if application form is filled
				$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
				$sec="Act_Me";
				$row = $stmt_in->fetch(PDO::FETCH_ASSOC);
				$_SESSION['staff_id'] = $row['staff_id'];
				$_SESSION['staff_password'] = $row['staff_password'];
				$_SESSION['work_ryt'] = $row['staff_ryt'];
				$_SESSION['staff_name'] = $row['staff_name'];
				header("location: staff_account_home.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
			}
	}else{
		$errPL="Error: Empty Data's Provided !!!";
	}									
}


?>

</head>
<body style="width:80%;margin:auto">
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg modal-sm modal-md">
        <div class="modal-content">
            <div class="modal-header label-primary" >
                <button type="button" style="color:RED;font-family:comic sans ms;font-size:20px;font-weight:bold" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:WHITE;font-family:comic sans ms;font-size:25px;font-weight:bold">ABOUT THE PROJECT - HOSPITAL DATA MINING SYSTEM</h4>
            </div>
            <div class="modal-body" style="font-family:comic sans ms;font-size:15px;font-weight:bold">
                <p  >Kogi State University, Anyigba - Kogi State Nigeria.</p>
				<p >The Project Hospital Data Mining System is Design By :</p>
				<p> Amodu Haruna - Reg No : 13MS1029 - Department of Mathematical Science (Computer Science).</p>
				<br>
				<p >For the Partial Fulfillment of the requirement for the Award of Bachelor Degree (Bsc.) in Computer Science - Kogi State University, Anyigba - 2017</p><br>
				<p  style="color:red">Supervised By : Mr. Kazeem Musa Opeyemi .</p>
				
                <p class="text-warning"><small>Copyright © 2017</small></p>
            </div>
            <div class="modal-footer label-primary">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


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
				<h4 style="font-weight:bold;background-color:grey;color:white;padding:10px 5px 10px 5px"> About Hospital Data Mining System System <h4/>
				<hr/>
				  
				<p style="">Data mining is the extraction of hidden predictive information from large database which helps in predicting future trend and behavior thereby helping management make knowledge driven decisions. The data mining tool designed is to aid in quick access and retrieval of patients information to avoid time wasted in retrieving of such data from hospitals data warehouse.</p>
				<p>Data mining, is the extraction of hidden predictive information from large database, is a powerful new technology with great potential to help companies focus on the most important information in their data warehouses.</p>
				
				
				<p>Data mining is ready for application in the business community because it is supported by three technologies that are sufficiently mature: massive data collection, powerful multiprocessor computers and data mining algorithms. In this evolution from business data to business information, each new step has built upon the previous one. For example, dynamic data access is critical for drill-through in data navigation applications, and the ability to store large database is critical to data mining....<a class="btn btn-success"href="#">Read more</a></p>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;background-color:#CCCCCC;text-align:centre">
			<form role="form"  name="reg_form"  id="form" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
				<h4 style="margin-bottom:20px;background-color:#CCFF33;padding:10px">Please Login - Staff</h4>
			<hr/>
				<div class="form-group">
					<label for="txtPasswordC2">Staff ID N<u>o</u> : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
						<input type="text" class="form-control" onkeypress="wipeboxeror('4')" id="txtreg" name="txtreg" value="<?php echo $txtreg;?>" required="true" placeholder="Enter Staff ID No"/>
					</div>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2">Password ID: </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span> 
						<input type="password" onkeypress="wipeboxeror('4')" class="form-control" id="txtAppID" name="txtAppID" required="true" placeholder="Enter Password ID"/>
					</div>
					<span class="help-block" id="result4" style="color:brown;text-weight:bold;text-align:center;"><?php echo $errPL;?></span>
				</div>
				<div class="form-group">
					<div class="input-group">
						<input type="submit" name="proceed" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Continue" class="btn btn-primary btn-md"></input>
					</div>
				</div>
				<h4 style="color:yellow;">Forget Your Password <a href="#" style="color:black;">Click Here to Retrieve it</a></h4>
			</form>
			</div>

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

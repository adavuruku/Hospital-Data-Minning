<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$sec="Act_Me";$err="";
$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
if(!isset($_GET['m_']) || !isset($_GET['l_w'])){
		header("location index.php");
}
if($_GET['m_'] != $_SESSION['page_authy'] || $_GET['l_w'] != $sec ){
	header("location index.php");
}

$date500 = new DateTime("Now");
$J = date_format($date500,"D");
$Q = date_format($date500,"d-F-Y, h:i:s A");
$dateprint_V = $J.", ".$Q;
$dateprint = "Printed On: ".$J.", ".$Q;
$j_S ="1";
	$stmt_in = $conn->prepare("SELECT * FROM app_status where library=? and department=? and faculty=? and security=? and store=? and hostel=? and athlete=? and sug=? and appid=? Limit 1");
	$stmt_in->execute(array($j_S,$j_S,$j_S,$j_S,$j_S,$j_S,$j_S,$j_S,$_SESSION['app_id']));
	$affected_rows_in = $stmt_in->rowCount();
	if($affected_rows_in < 1) 
	{
		$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
		$sec="Act_Me";
		//header("location: student_account.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
	}
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
	
	//name of approvals
	$library = $sport = $sug = $security = $store = $hostel = $faculty =$dept ="";
	$stmt_in = $conn->prepare("SELECT * FROM staff_record");
	$stmt_in->execute();
	$affected_rows_in = $stmt_in->rowCount();
	if($affected_rows_in >= 1) 
	{
		while($row = $stmt_in->fetch(PDO::FETCH_ASSOC)){
			//name of clearance staffs
			if($library =="" ){
				$library = $row ['clearance_section'] == "Library" ? $row ['staff_name']  : "";
			}
			if($sport =="" ){
				$sport = $row ['clearance_section'] == "Sports" ? $row ['staff_name']  : "";
			}
			if($sug =="" ){
				$sug = $row ['clearance_section'] == "SUG" ? $row ['staff_name']  : "";
			}
			if($security =="" ){
				$security = $row ['clearance_section'] == "Security" ? $row ['staff_name']  : "";
			}
			if($store =="" ){
				$store = $row ['clearance_section'] == "Bursary" ? $row ['staff_name'] : "";
			}
			if($hostel =="" ){
				$hostel = $row ['clearance_section'] == "Hostel" ? $row ['staff_name'] : "";
			}
			
			if($row ['clearance_section'] =="Faculty" && $faculty ==""){
				$faculty = $row ['staff_faculty'] == $txtfaculty ? $row ['staff_name'] : "";
			}
			if($row ['clearance_section'] =="Department" && $dept ==""){
				$dept = $row ['staff_dept'] == $txtdept ? $row ['staff_name'] : "";
			}
		}
	}
	
	//date of approvals
	$libraryd = $sportd = $sugd = $securityd = $stored = $hosteld = $facultyd =$deptd ="";
	$stmt_in = $conn->prepare("SELECT * FROM app_status where appid=? Limit 1");
	$stmt_in->execute(array($_SESSION['app_id']));
	$affected_rows_in = $stmt_in->rowCount();
	if($affected_rows_in >= 1) 
	{
		$row = $stmt_in->fetch(PDO::FETCH_ASSOC);
			//date of clearance staffs
			$date500 = new DateTime($row['libraryDate']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y, h:i:s A");
			$dateprint_V = $J.", ".$Q;
			$libraryd = $J.", ".$Q;	
			
			$date500 = new DateTime($row['athleteDate']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y, h:i:s A");
			$dateprint_V = $J.", ".$Q;
			$sportd = $J.", ".$Q;
			
			$date500 = new DateTime($row['sugDate']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y, h:i:s A");
			$dateprint_V = $J.", ".$Q;
			$sugd = $J.", ".$Q;
			
			$date500 = new DateTime($row['storeDate']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y, h:i:s A");
			$dateprint_V = $J.", ".$Q;
			$stored = $J.", ".$Q;
			 
			$date500 = new DateTime($row['hostelDate']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y, h:i:s A");
			$dateprint_V = $J.", ".$Q;
			$hosteld = $J.", ".$Q;
			
			$date500 = new DateTime($row['facultyDate']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y, h:i:s A");
			$dateprint_V = $J.", ".$Q;
			$facultyd = $J.", ".$Q;
			
			$date500 = new DateTime($row['departmentDate']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y, h:i:s A");
			$dateprint_V = $J.", ".$Q;
			$deptd = $J.", ".$Q;
			
			$date500 = new DateTime($row['securityDate']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y, h:i:s A");
			$dateprint_V = $J.", ".$Q;
			$securityd = $J.", ".$Q;	
	}
?>

</head>
<body style="width:95%;margin:auto">
<div class="container-fluid" >
		<div class="row hidden-print">
			<?php
				//require_once 'settings/nav_top_login.php';
			?> 
		</div>
	
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
	<div class="row" >
		<div class="imageupload panel panel-info hidden-print">
			<div class="panel-heading clearfix">
				<h3 class="panel-title pull-left"> Online Clearance Application Slip  - <?php echo $dateprint ?> <!--| <a style="color:red" href="<?php //echo 'student_account.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'"';?>" > My Account Home |</a></h3>-->
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px;">
			<!-- records -->
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td><img  style="height:150px" class="img-responsive" src="resource/<?php echo $_SESSION['app_id'].'.jpg';?>"> </img></td>
						<td colspan="2" align="center"><h4><span><b>Delta State School Of Marine Technology, Burutu - Delta State Nigeria.</b></span></h4>
						<p>Knowledge For Discipline & Enterprise.</p>
						<h4><span><b>Approved (Cleared) Clearance Application Slip.</b></span></h4>
						<p><?php echo $dateprint;?></p>
						</td>
						<td><img  style="height:150px" class="img-responsive" src="settings/images/delta.png" /></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td colspan="4" align="left"><h4><b><u>APPLICANT INFORMATION</u></b></h4></td>
					</tr>
					<tr>
						<td><h4>Applicant Name : </h4></td>
						<td><h4><span><b><?php echo $txttitle." ".$txtfname." ".$txtoname;?></b></span></h4></td>
						<td><h4>Matriculation / Registration N<u>o</u> :</h4></td>
						<td><h4><span><b><?php echo $_SESSION['regno'];?></b></span></h4></td>
					</tr>
					<tr>
						<td><h4>Email Address : </h4></td>
						<td><h4><span><b><?php echo $_SESSION['email_id'];?></b></span></h4></td>
						<td><h4>Application ID :</h4></td>
						<td><h4><span><b><?php echo $_SESSION['app_id'];?></b></span></h4></td>
					</tr>
					<tr>
						<td><h4>Department :  </h4></td>
						<td><h4><span><b><?php echo $txtdept;?></b></span></h4></td>
						<td><h4>Faculty : </h4></td>
						<td><h4><span><b><?php echo $txtfaculty;?></b></span></h4></td>
					</tr>
					<tr>
						<td colspan="2" align="right"><h4>Application Date :  </h4></td>
						<td colspan="2" align="left"><h4><span><b><?php echo $date_reg;?></b></span></h4></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td colspan="5" align="left"><h4><b><u>CLEARANCE INFORMATION</u></b></h4></td>
					</tr>
					<tr>
						<th>SNo.</th>
						<th>Cleared By:</th>
						<th>Date Cleared.</th>
						<th>Clearance Section / Department.</th>
					</tr>
					<tr>
						<td><h4>1.</h4></td>
						<td><h4><span><b><?php echo $faculty;?></b></span></h4></td>
						<td><h4><span><b><?php echo $facultyd;?></b></span></h4></td>
						<td><h4><span><b>Faculty</b></span></h4></td>
					</tr>
					<tr>
						<td><h4>2.</h4></td>
						<td><h4><span><b><?php echo $dept;?></b></span></h4></td>
						<td><h4><span><b><?php echo $deptd;?></b></span></h4></td>
						<td><h4><span><b>Department</b></span></h4></td>
					</tr>
					<tr>
						<td><h4>3.</h4></td>
						<td><h4><span><b><?php echo $library;?></b></span></h4></td>
						<td><h4><span><b><?php echo $libraryd;?></b></span></h4></td>
						<td><h4><span><b>Library</b></span></h4></td>
					</tr>
					<tr>
						<td><h4>4.</h4></td>
						<td><h4><span><b><?php echo $store;?></b></span></h4></td>
						<td><h4><span><b><?php echo $stored;?></b></span></h4></td>
						<td><h4><span><b>Bursary / Finally</b></span></h4></td>
					</tr>
					<tr>
						<td><h4>5.</h4></td>
						<td><h4><span><b><?php echo $hostel;?></b></span></h4></td>
						<td><h4><span><b><?php echo $hosteld;?></b></span></h4></td>
						<td><h4><span><b>Hostel</b></span></h4></td>
					</tr>
					<tr>
						<td><h4>6.</h4></td>
						<td><h4><span><b><?php echo $security;?></b></span></h4></td>
						<td><h4><span><b><?php echo $securityd;?></b></span></h4></td>
						<td><h4><span><b>Security</b></span></h4></td>
					</tr>
					<tr>
						<td><h4>7.</h4></td>
						<td><h4><span><b><?php echo $sport;?></b></span></h4></td>
						<td><h4><span><b><?php echo $sportd;?></b></span></h4></td>
						<td><h4><span><b>Athlete / Sports</b></span></h4></td>
					</tr>
					<tr>
						<td><h4>8.</h4></td>
						<td><h4><span><b><?php echo $sug;?></b></span></h4></td>
						<td><h4><span><b><?php echo $sugd;?></b></span></h4></td>
						<td><h4><span><b>S U G (Student Union Government).</b></span></h4></td>
					</tr>
					
				</tbody>
			</table>
			<table class="table table-condensed table-bordered">
				<tbody>
					<tr>
						<td colspan="4" align="left"><h4><b><u>APPLICANT CONFIRMATION SIGNATURE</u></b></h4></td>
					</tr>
					<tr>
						<th>SNo.</th>
						<th>Applicant Name:</th>
						<th>Signature.</th>
						<th>Date Signed.</th>
					</tr>
					<tr height="100px">
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr>
						<td colspan="4"><p style="color:red;text-align:center">Sign and Submit original Copy of this form to Student Affairs office and to DVC Academic office.</p>
						<p style="color:blue;text-align:center">Note: Falsification of this slip will lead to withdrawal from the institution or certificate and be charge for thief and forgery .</p>
						<p style="color:red;text-align:center">Note: Clearance ID / Application ID Will be verified at every point of submission.</p></td>
					</tr>
					<tr>
						<td colspan="4" align="center"><p onClick="window.print();" style="margin-bottom:10px;padding:5px 20px 5px 20px" class="btn btn-primary btn-md">Print Slip</p></td>
					</tr>
				</tbody>
			</table>
		</div>
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

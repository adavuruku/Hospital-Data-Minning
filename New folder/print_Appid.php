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
				<h3 class="panel-title pull-left"> Online Clearance Application Slip  - <?php echo $dateprint ?> <!-- | <a style="color:red" href="<?php //echo 'student_account.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'"';?>" > My Account Home |</a></h3> -->
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px;">
			<!-- records -->
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td><img  style="height:150px" class="img-responsive" src="resource/<?php echo $_SESSION['app_id'].'.jpg';?>"> </img></td>
						<td colspan="2" align="center"><h4><span><b>Delta State School Of Marine Technology, Burutu - Delta State Nigeria.</b></span></h4>
						<p>P M B 10256 - Burutu Delta State.</p>
						<h4><span><b>Clearance Application Slip</b></span></h4>
						<p><?php echo $dateprint;?></p>
						</td>
						<td><img  style="height:150px" class="img-responsive" src="settings/images/delta.png" /></td>
					</tr>
				</tbody>
			</table>
			<table class="table table-condensed">
				<tbody>
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
						<td><h4>Date Of Registration :  </h4></td>
						<td><h4><span><b><?php echo $date_reg;?></b></span></h4></td>
						<td><h4>Main Phone N<u>o</u> : </h4></td>
						<td><h4><span><b><?php echo $txtPhone;?></b></span></h4></td>
					</tr>
					<tr>
						<td><h4>Alternative Phone N<u>o</u> :  </h4></td>
						<td><h4><span><b><?php echo $txtAPhone;?></b></span></h4></td>
						<td><h4>Gender : </h4></td>
						<td><h4><span><b><?php echo $txtgender;?></b></span></h4></td>
					</tr>
					<tr>
						<td><h4>Religion :  </h4></td>
						<td><h4><span><b><?php echo $txtreligion;?></b></span></h4></td>
						<td><h4>Nationality : </h4></td>
						<td><h4><span><b>Nigerian</b></span></h4></td>
					</tr>
					<tr>
						<td><h4>State :  </h4></td>
						<td><h4><span><b><?php echo $txtstate;?></b></span></h4></td>
						<td><h4>Permanent Address : </h4></td>
						<td><h4><span><b><?php echo $txtPermadd;?></b></span></h4></td>
					</tr>
					<tr>
						<td><h4>Residensial Address :  </h4></td>
						<td><h4><span><b><?php echo $txttempadd;?></b></span></h4></td>
						<td><h4>Faculty : </h4></td>
						<td><h4><span><b><?php echo $txtfaculty;?></b></span></h4></td>
					</tr>
					<tr>
						<td><h4>Department :  </h4></td>
						<td><h4><span><b><?php echo $txtdept;?></b></span></h4></td>
						<td><h4>Mode Of Entrance : </h4></td>
						<td><h4><span><b><?php echo $txtentrance;?></b></span></h4></td>
					</tr>
					<tr>
						<td><h4>Mode Of Study :  </h4></td>
						<td><h4><span><b><?php echo $txtmodestudy;?></b></span></h4></td>
						<td><h4>Award in View : </h4></td>
						<td><h4><span><b><?php echo $txtaward;?></b></span></h4></td>
					</tr>
					<tr>
						<td><h4>Course Duration (Years) :  </h4></td>
						<td><h4><span><b><?php echo $txtduration;?> Years.</b></span></h4></td>
						<td><h4>Year Of Entry (YYYY) : </h4></td>
						<td><h4><span><b><?php echo $txtent;?></b></span></h4></td>
					</tr>
					<tr>
						<td colspan="2" align="right"><h4>Year Of Exit (YYYY) :  </h4></td>
						<td colspan="2" align="left"><h4><span><b><?php echo $txtexit;?></b></span></h4></td>
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

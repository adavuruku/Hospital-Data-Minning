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
$display="";
$status ="1";
$date500 = new DateTime("Now");
$J = date_format($date500,"D");
$Q = date_format($date500,"d-F-Y, h:i:s A");
$dateprint_V = $J.", ".$Q;
$dateprint = "Printed On: ".$J.", ".$Q;	

	//library
	if($_SESSION['clearance_section'] =="Library"){
		$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.library =? order by app_status.id desc");
		$stmt_ina->execute(array($status));
		$display = "All Approved Clearance Application For Library Unit";
	}
	//store
	if($_SESSION['clearance_section'] =="Bursary"){
		$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.store =? order by app_status.id desc");
		$stmt_ina->execute(array($status));
		$display = "All Approved Clearance Application For Bursary / Finance Department ";
	}
	//hostel
	if($_SESSION['clearance_section'] =="Hostel"){
		$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.hostel =? order by app_status.id desc");
		$stmt_ina->execute(array($status));
		$display = "All Approved Clearance Application For Hostel Unit";
	}
	//athlete
	if($_SESSION['clearance_section'] =="Sports"){
		$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.athlete =? order by app_status.id desc");
		$stmt_ina->execute(array($status));
		$display = "All Approved Clearance Application For Sports Unit";
	}
	//sug
	if($_SESSION['clearance_section'] =="SUG"){
		$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.sug =? order by app_status.id desc");
		$stmt_ina->execute(array($status));
		$display = "All Approved Clearance Application For Student Union Government (S U G) Unit";
	}
	//security
	if($_SESSION['clearance_section'] =="Security"){
		$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.security =? order by app_status.id desc");
		$stmt_ina->execute(array($status));
		$display = "All Approved Clearance Application For Security Unit";
	}
	if($_SESSION['clearance_section'] =="Faculty"){
		$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where student_info.sfaculty =?  and  app_status.faculty =? order by app_status.id desc");
		$stmt_ina->execute(array($_SESSION['staff_faculty'],$status));
		$display = "All Approved Clearance Application For Faculty of ".$_SESSION['staff_faculty'];
	}
	if($_SESSION['clearance_section'] =="Department"){
		$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where student_info.sdept =?  and  app_status.department =? order by app_status.id desc");
		$stmt_ina->execute(array($_SESSION['staff_dept'],$status));
		$display = "All Approved Clearance Application For Department of ".$_SESSION['staff_dept'];
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
				<h3 class="panel-title pull-left"> <?php echo $display; ?> - <?php echo $dateprint ?> 
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align:centre;padding-top:10px;">
			<!-- records -->
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td><img  style="height:150px" class="img-responsive" src="settings/images/delta.png" /></td>
						<td colspan="2" align="center"><h4><span><b>Delta State School Of Marine Technology, Burutu - Delta State Nigeria.</b></span></h4>
						<p>Knowledge For Discipline & Enterprise.</p>
						<h4><span><b><?php echo $display; ?></b></span></h4>
						<p><?php echo $dateprint; ?></p>
						</td>
						<td><img  style="height:150px" class="img-responsive" src="settings/images/delta.png" /></td>
					</tr>
				</tbody>
			</table>
			<?php
				
				$affected_rows_in = $stmt_ina->rowCount();
				if($affected_rows_in >= 1) 
				{
					echo '<table class="table table-condensed">
							<thead style="background-color:none;color:blue">
								<tr>
									<th>S/N<u>o</u>.</th>
									<th>Name</th>
									<th>Reg N<u>o</u></th>
									<th >Clearance ID</th>
									<th >Faculty</th>
									<th >Department</th>
									<th >Year Entry</th>
									<th >Year Exit</th>
									<th >Mode of Entry / Study</th>
									<th >Gender / Email </th>
									<th >Phone N<u>o</u></th>
									<th >Application Date</th>
								</tr>
							</thead>
							<tbody>';
					$j=1;$data="";
					while($row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC))
					{
						$date500 = new DateTime($row_two['sregdate']);
						$date_reg = date_format($date500,"d/m/Y, h:i:s A");
						$nameAll = $row_two['stitle']." ".$row_two['sfirstname']." ".$row_two['sothername'];
						$data=$data.'<tr >
										<td>'.$j.'</td> 	
										<td>'.$nameAll.'</td>
										<td>'.$row_two['sregno'].'</td>
										<td>'.$row_two['appid'].'</td>
										<td>'.$row_two['sfaculty'].'</td>
										<td>'.$row_two['sdept'].'</td>
										<td>'.$row_two['syearent'].'</td>
										<td>'.$row_two['syearexit'].'</td>
										<td>'.$row_two['smodeent']." / ".$row_two['smodestudy'].'</td>
										<td>'.$row_two['sgender']." / ".$row_two['semail'].'</td>
										<td>'.$row_two['sphonemain']." / ".$row_two['sphonemain'].'</td>
										<td>'.$date_reg.'</td>
										
								</tr>';
								$j=$j + 1;
					}
					$j=$j - 1;
					echo $data.'
					<tr >
						<td colspan="12" align="center" ><h5 style="color:red">You have Approved - '.$j.' - Clearance Application </h5></td>
					</tr>
					<tr >
						<td colspan="12" align="center"><p onClick="window.print();" style="margin-bottom:10px;padding:5px 20px 5px 20px" class="btn btn-primary btn-md">Click to Print</p></td>
					</tr>
					</tbody></table>';
				}else{
				echo '<div class="alert alert-info alert-dismissable">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true">
									  &times;
								   </button><h3>You have Not Approved any Clearance Application Yet..</h3></div>';
				
				}
			?>
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

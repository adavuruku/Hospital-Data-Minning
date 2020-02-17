<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$sec="Act_Me";$err=$notice_msg=$er_msg=$er_msg2=$msg2=$msg="";
$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
if(!isset($_SESSION['staff_id']) || !isset($_SESSION['staff_name'])){
	header("location: index.php");
}
if(!isset($_GET['m_']) || !isset($_GET['l_w'])){
		header("location: index.php");
}
if($_GET['m_'] != $_SESSION['page_authy'] || $_GET['l_w'] != $sec ){
	header("location: index.php");
}

$date500 = new DateTime("Now");
$J = date_format($date500,"D");
$Q = date_format($date500,"d-F-Y, h:i:s A");
$dateprint_V = $J.", ".$Q;
$dateprint = $J.", ".$Q;	

	$stmt_ina = $conn->prepare("SELECT * FROM staff_record ORDER BY del_status ASC");
	$stmt_ina->execute(array());


?>

</head>
<body style="width:100%;margin:auto">
<div class="container-fluid" >
		<div class="row">
			<?php
				//require_once 'settings/nav_top_login.php';
			?> 
		</div>
	
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
	<div class="row" >
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align:centre;padding-top:10px;">
			<div class="row">
				<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<img src="settings/images/headlogo.jpg"  class="img-responsive"></img>
				</div>
			</div>
			<!-- records -->
			<table class="table table-condensed">
				<tbody>
					<tr>
						<td colspan="4" align="center"><h3><span><b>HOSPITAL DATA MINING STAFF LIST REPORT - FMC LOKOJA.</b></span></h3>
						<p><?php echo "Printed On: ".$dateprint; ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
				
				$affected_rows_in = $stmt_ina->rowCount();
				if($affected_rows_in >= 1) 
				{
					echo '<table class="table table-condensed" style="background-color:#FFFFFF;margin-top:5px">
								<thead style="background-color:none;color:blue">
									<tr>
										<th>S/N<u>o</u>.</th>
										<th>Staff Name</th>
										<th>Staff ID N<u>o</u></th>
										<th >Staff Dept</th>
										<th >Staff Address</th>
										<th >Staff Contact</th>
										<th >Date Created</th>
										<th >Access Right</th>
										<th >Status</th>
									</tr>
								</thead>
								<tbody>';
							$j=1;$data="";
					while($row_two1 = $stmt_ina->fetch(PDO::FETCH_ASSOC))
					{
						$date500 = new DateTime($row_two1['date_reg']);
						$J = date_format($date500,"D");
						$Q = date_format($date500,"d-F-Y");
						$dateprint_V = $J.", ".$Q;
						$date_reg = $J.", ".$Q;
						
						$ryt = $row_two1['staff_ryt'] == "1" ? "Complete" : "Restricted";
						$status = $row_two1['del_status'] == "0" ? "Active" : "Blocked";
						$data=$data.'<tr >
										<td>'.$j.'</td> 	
										<td>'.$row_two1['staff_name'].'</td>
										<td>'.$row_two1['staff_id'].'</td>
										<td>'.$row_two1['staff_dept'].'</td>
										<td>'.$row_two1['staff_lgov'].", ".$row_two1['staff_state'].'</td>
										<td>'.$row_two1['staff_phone'].", ".$row_two1['staff_email'].'</td>
										<td>'.$date_reg.'</td>
										<td>'.$ryt.'</td>
										<td>'.$status.'</td>
								</tr>';
						$j=$j + 1;
					
					}
					
						$data=$data.'<tr >
							<td  colspan="9" style="color:red" align="center">All Staff Record as At - '.$dateprint.'</td> 	
						</tr>
						<tr >
							<td  colspan="9" align="center">Federal Medical Centre Lokoja - Kogi State &copy; 2017</td> 	
						</tr>
					<tr class="hidden-print">
						<td colspan="9" align="center"><p onClick="window.print();" style="margin-bottom:10px;padding:5px 20px 5px 20px" class="btn btn-primary btn-md">Click to Print</p></td>
					</tr>
					</tbody></table>';
						echo $data;	
				}else{
					echo '<div class="alert alert-info alert-dismissable">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true">
									  &times;
								   </button><h3>Ooops.. No Record Found !!!..</h3></div>';
				
				}
			?>
		</div>
	</div>
		<?php require_once 'settings/footer_file.php';?>
 </div>
</body>
</html>  

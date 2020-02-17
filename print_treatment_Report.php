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

$card_id_sha_h = SHA1($_GET['c_dp']."SHERIFUADAVURUKU".$_GET['c_dp']);
if($card_id_sha_h != $_GET['mc']){
	echo '<script type="text/javascript">
			window.close();
		</script>';
}
$date500 = new DateTime("Now");
$J = date_format($date500,"D");
$Q = date_format($date500,"d-F-Y, h:i:s A");
$dateprint_V = $J.", ".$Q;
$dateprint = "Printed On: ".$J.", ".$Q;	

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
						<td colspan="4" align="center"><h3><span><b>HOSPITAL TREATMENT REPORT - FMC LOKOJA.</b></span></h3>
						<p><?php echo $dateprint; ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
				$stmt_ina = $conn->prepare("SELECT * FROM treatment_history INNER JOIN patience_record on  treatment_history.card_id = patience_record.card_id INNER JOIN staff_record on  treatment_history.staff_id = staff_record.staff_id where treatment_history.treatment_id =?  Limit 1");
				$stmt_ina->execute(array($_GET['c_dp']));
				$affected_rows_in = $stmt_ina->rowCount();
				if($affected_rows_in >= 1) 
				{
					$row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC);
					
						
						$date500 = new DateTime($row_two['date_record']);
						$J = date_format($date500,"D");
						$Q = date_format($date500,"d-F-Y");
						$dateprint_V = $J.", ".$Q;
						$date_reg = $J.", ".$Q;
						
						$date500 = new DateTime($row_two['card_dob']);
						$J = date_format($date500,"D");
						$Q = date_format($date500,"d-F-Y");
						$dateprint_V = $J.", ".$Q;
						$dob = $J.", ".$Q;
						$labresult = $row_two['doctor_labresult'] != "" ? $row_two['doctor_labresult'] : "None ";
						$labtest = $row_two['doctor_labtest'] != "" ? $row_two['doctor_labtest'] : "None ";
						echo '<table class="table table-condensed">
									<tbody>
									
									<tr >
										<td  colspan="2" align="Left"><h4><b>PATIENT DETAILS</b></h4></td> 	
									</tr>
									<tr >
										<td align="left" width="150px"><h5>Card Owner : </h5></td> 	
										<td  align="left"><h4><b>'.$row_two['card_name'].'</b></h4></td>
									</tr>
									<tr>
										<td align="left" width="50px"><h5>Card ID N<u>o</u> : </h5></td> 	
										<td  align="left" style="color:red"><h4><b>'.$row_two['card_id'].'</b></h4></td>
									</tr>
									<tr >
										<td  align="left"><h5>Gender : </h5></td> 	
										<td align="left"><h5><b>'.$row_two['card_gender'].'</b></h5></td>
									</tr>
									<tr>
										<td align="left"><h5>Date Of Birth :</h5> </td> 	
										<td align="left"><h5><b>'.$dob.'</b></h5></td>
									</tr>
									<tr >
										<td  colspan="2" align="Left"><h4><b>TREATMENT DETAILS</b></h4></td> 	
									</tr>
									<tr >
										<td align="left" width="150px"><h5>Treatment ID N<u>o</u> : </h5></td> 	
										<td  align="left" style="color:red"><h4><b>'.$row_two['treatment_id'].'</b></h5></td>
									</tr>
									<tr >
										<td  align="left" ><h5>Treatment Date : </h5></td> 	
										<td  align="left"><h4><b>'.$date_reg.'</b></h4></td>
									</tr>
									<tr>
										<td  align="left" ><h5>Report By : </h5></td> 	
										<td align="left"><h4><b>'.$row_two['staff_name'].'</b></h4></td>
									</tr>
									<tr >
										<td  align="left"><h5>Patient Complain :</h5> </td> 	
										<td align="left"><h5><b>'.$row_two['card_complain'].'</b></h5></td>
									</tr>
									<tr>
										<td align="left"><h5>Laboratory Test :</h5> </td> 	
										<td align="left"><h5><b>'.$labtest.'</b></h5></td>
									</tr>
									<tr>
										<td align="left"><h5>Laboratory Test Result :</h5> </td> 	
										<td align="left"><h5><b>'.$labresult .'</b></h5></td>
									</tr>
									<tr>
										<td align="left"><h5>Diagnosis / Treatment :</h5> </td> 	
										<td align="left"><h5><b>'.$row_two['doctor_diagnosis'].'</b></h5></td>
									</tr>
									<tr >
										<td  colspan="2" style="color:red" align="center">This is a Complete Report on the Treatment you receive at the Clinic on - '.$date_reg.'.</td> 	
									</tr>
									<tr >
										<td  colspan="2" align="center">Federal Medical Centre Lokoja - Kogi State &copy; 2017</td> 	
									</tr>
								<tr class="hidden-print">
									<td colspan="2" align="center"><p onClick="window.print();" style="margin-bottom:10px;padding:5px 20px 5px 20px" class="btn btn-primary btn-md">Click to Print</p></td>
								</tr>
								</tbody></table>';
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

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
						<td colspan="4" align="center"><h3><span><b>HOSPITAL PATIENT ADMITION REPORT - FMC LOKOJA.</b></span></h3>
						<p><?php echo $dateprint; ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
				$stmt_ina = $conn->prepare("SELECT * FROM admission_history INNER JOIN patience_record on  admission_history.card_id = patience_record.card_id  where admission_history.admission_id =?  Limit 1");
				$stmt_ina->execute(array($_GET['c_dp']));
				$affected_rows_in = $stmt_ina->rowCount();
				if($affected_rows_in >= 1) 
				{
					$row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC);
					
						
						$date500 = new DateTime($row_two['date_admitted']);
						$J = date_format($date500,"D");
						$Q = date_format($date500,"d-F-Y");
						$dateprint_V = $J.", ".$Q;
						$date_reg = $J.", ".$Q;
						
						$date500 = new DateTime($row_two['card_dob']);
						$J = date_format($date500,"D");
						$Q = date_format($date500,"d-F-Y");
						$dateprint_V = $J.", ".$Q;
						$dob = $J.", ".$Q;
						
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
										<td  colspan="2" align="Left"><h4><b>ADMISSION DETAILS</b></h4></td> 	
									</tr>
									<tr >
										<td align="left" width="150px"><h5>Admission ID N<u>o</u> : </h5></td> 	
										<td  align="left" style="color:red"><h4><b>'.$row_two['admission_id'].'</b></h5></td>
									</tr>
									<tr>
										<td  align="left" ><h5>Admitted By : </h5></td> 	
										<td align="left"><h4><b>'.$row_two['staff_add_name'].'</b></h4></td>
									</tr>
									
									<tr >
										<td  align="left"><h5>Purpose Of Admission :</h5> </td> 	
										<td align="left"><h5><b>'.$row_two['admission_purpose'].'</b></h5></td>
									</tr>
									<tr>
										<td align="left"><h5>Place / Section Of Admission :</h5> </td> 	
										<td align="left"><h5><b>'.$row_two['place_admitted'].'</b></h5></td>
									</tr>
									<tr >
										<td  align="left" ><h5>Admission Date : </h5></td> 	
										<td  align="left"><h4><b>'.$date_reg.'</b></h4></td>
									</tr>
									';
									if($row_two['staff_dis_id'] != ""){
										
										$date500 = new DateTime($row_two['date_discharge']);
										$J = date_format($date500,"D");
										$Q = date_format($date500,"d-F-Y");
										$dateprint_V = $J.", ".$Q;
										$date_disreg = $J.", ".$Q;
									echo '<tr >
												<td  colspan="2" align="left"><h4><b>DISCHARGE DETAILS</b></h4></td> 	
											</tr>
											<tr>
												<td  align="left" ><h5> Discharged By : </h5></td> 	
												<td align="left"><h4><b>'.$row_two['staff_dis_name'].'</b></h4></td>
											</tr>
											<tr >
												<td  align="left"><h5>Purpose Of Discharge :</h5> </td> 	
												<td align="left"><h5><b>'.$row_two['purpose_discharge'].'</b></h5></td>
											</tr>
											<tr >
												<td  align="left"><h5>Date Discharged :</h5> </td> 	
												<td align="left"><h5><b>'.$date_disreg.'</b></h5></td>
											</tr>
											';
									
									}
									echo'<tr >
										<td  colspan="2" style="color:red" align="center">This is a Complete Report on of Your Admission on - '.$date_reg.'.</td> 	
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

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
			mywindow.close();
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
						<td colspan="4" align="center"><h3><span><b>HOSPITAL CARD - FMC LOKOJA.</b></span></h3>
						<p><?php echo $dateprint; ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
				$stmt_ina = $conn->prepare("SELECT * FROM patience_record INNER JOIN staff_record on  patience_record.officer_Reg = staff_record.staff_id where patience_record.card_id =?  Limit 1");
				$stmt_ina->execute(array($_GET['c_dp']));
				$affected_rows_in = $stmt_ina->rowCount();
				if($affected_rows_in >= 1) 
				{
					$row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC);
					
						
						$date500 = new DateTime($row_two['card_date']);
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
										<td align="left" width="150px"><h5>Card Owner : </h5></td> 	
										<td  align="left"><h4><b>'.$row_two['card_name'].'</b></h4></td>
									</tr>
									<tr>
										<td align="left" width="50px"><h5>Card ID N<u>o</u> : </h5></td> 	
										<td  align="left" style="color:red"><h4><b>'.$row_two['card_id'].'</b></h4></td>
									</tr>
									
									<tr >
										<td  align="left" ><h5>Registration Date : </h5></td> 	
										<td  align="left"><h4><b>'.$date_reg.'</b></h4></td>
									</tr>
									<tr>
										<td  align="left" ><h5>Registered By : </h5></td> 	
										<td align="left"><h4><b>'.$row_two['staff_name'].'</b></h4></td>
									</tr>
									<tr >
										<td  align="left"><h5>State : </h5></td> 	
										<td align="left"><h5><b>'.$row_two['card_state'].'</b></h5></td>
									</tr>
									<tr>
										<td align="left"><h5>Local Government : </h5></td> 	
										<td align="left"><h5><b>'.$row_two['card_lgov'].'</b></h5></td>
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
										<td  align="left">Phone N<u>o</u> : </h5></td> 	
										<td align="left"><h5><b>'.$row_two['card_phone'].'</b></h5></td>
									</tr>
									<tr>
										<td align="left"><h5>Email Address : </h5></td> 	
										<td align="left"><h5><b>'.$row_two['card_email'].'</b></h5></td>
									</tr>
									<tr >
										<td  align="left"><h5>Permanent Address :</h5> </td> 	
										<td align="left"><h5><b>'.$row_two['card_permadd'].'</b></h5></td>
									</tr>
									<tr>
										<td align="left"><h5>Contact Address :</h5> </td> 	
										<td align="left"><h5><b>'.$row_two['card_tempadd'].'</b></h5></td>
									</tr>
									<tr >
										<td  colspan="2" style="color:red" align="center">Always Come with this Slip Anytime you have appointment with the Hospital or Keep the Card Pin Save.</td> 	
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

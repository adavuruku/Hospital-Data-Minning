<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$sec="Act_Me";$err=$notice_msg=$er_msg=$er_msg2=$msg2=$msg="";
$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
if(!isset($_SESSION['staff_id']) || !isset($_SESSION['staff_name'])){
	header("location: index.php");
}

if($_SERVER['REQUEST_METHOD'] != "POST"){
	header("location: index.php");
}
$date500 = new DateTime("Now");
$J = date_format($date500,"D");
$Q = date_format($date500,"d-F-Y, h:i:s A");
$dateprint_V = $J.", ".$Q;
$dateprint = $J.", ".$Q;	
$search_purpose = "";
if(isset($_POST['search_card']) && isset($_POST['txtsearchC'])){
	$criteria="%".trim($_POST['txtsearchC'])."%";
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id FROM patience_record INNER JOIN staff_record ON patience_record.officer_Reg = staff_record.staff_id Where patience_record.card_id Like ? or card_name Like ? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($criteria,$criteria));
	$search_purpose = "Search Result By Card_ID N<u>o</u> Or Patient Name";
}
//base on Date Of Birth	
if(isset($_POST['search_date']) && isset($_POST['frmdate'])  && isset($_POST['todate'])){
	$date500 = new DateTime($_POST['frmdate']);
	$frmdate = date_format($date500,"Y-m-d");
	
	$date500 = new DateTime($_POST['todate']);
	$todate = date_format($date500,"Y-m-d");
	//echo $todate;
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id FROM patience_record INNER JOIN staff_record ON patience_record.officer_Reg = staff_record.staff_id Where patience_record.card_dob between ? AND ? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($frmdate,$todate));
	$search_purpose = "Search Result Of  All Patient Date of Birth Between - ".$_POST['frmdate']." To - ".$_POST['todate'];
}
//base on date reg
if(isset($_POST['search_date1']) && isset($_POST['frmdate1'])  && isset($_POST['todate1'])){
	
	$date500 = new DateTime($_POST['frmdate1']);
	$frmdate = date_format($date500,"Y-m-d");
	
	$date500 = new DateTime($_POST['todate1']);
	$todate = date_format($date500,"Y-m-d");
	//echo $todate;
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id FROM patience_record INNER JOIN staff_record ON patience_record.officer_Reg = staff_record.staff_id Where patience_record.card_date between ? AND ? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($frmdate,$todate));
	$search_purpose = "Search Result Of All Patient Registered Between - ".$_POST['frmdate1']." To - ".$_POST['todate1'];
}
//base on gender
if(isset($_POST['search_gender']) && isset($_POST['txtgender'])){

	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id FROM patience_record INNER JOIN staff_record ON patience_record.officer_Reg = staff_record.staff_id Where patience_record.card_gender = ? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($_POST['txtgender']));
	$search_purpose = "Search Result Of All Registered ".$_POST['txtgender']." Patient";
}

//base on state
if(isset($_POST['search_state']) && isset($_POST['txtstate'])){

	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id FROM patience_record INNER JOIN staff_record ON patience_record.officer_Reg = staff_record.staff_id Where patience_record.card_state = ? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($_POST['txtstate']));
	$search_purpose = "Search Result Of All Registered Patient From ".$_POST['txtstate']." State";
}
//base on local Government
if(isset($_POST['search_lgov']) && isset($_POST['txtlgov'])){

	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id FROM patience_record INNER JOIN staff_record ON patience_record.officer_Reg = staff_record.staff_id Where patience_record.card_lgov = ? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($_POST['txtlgov']));
	$search_purpose = "Search Result Of All Registered Patient From ".$_POST['txtlgov']." Local Government Area.";
}
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
						<td colspan="4" align="center"><h3><span><b>HOSPITAL DATA MINING PATIENT LIST REPORT - FMC LOKOJA.</b></span></h3>
						<p><?php echo "Printed On: ".$dateprint; ?></p>
						<p><?php echo $search_purpose; ?></p>
						<p><?php echo '<a class="text-right hidden-print" style="text-decoration:none;color:black;" href=print_patient_record.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'> <p><span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Click Here to Return To Your Dash Board - Back To Search <span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span></p></a>'; ?></p>
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
										<th>Card Name</th>
										<th>Card ID N<u>o</u></th>
										<th >Card Gender</th>
										<th >Card DOB</th>
										<th >Card Address</th>
										<th >Card Contact</th>
										<th >Staff Reg.</th>
										<th >Date Registered</th>
										<th></th>
									</tr>
								</thead>
								<tbody>';
							$j=1;$data="";
					while($row_two1 = $stmt_ina->fetch(PDO::FETCH_ASSOC))
					{
						$date500 = new DateTime($row_two1['card_date']);
						$J = date_format($date500,"D");
						$Q = date_format($date500,"d-F-Y");
						$dateprint_V = $J.", ".$Q;
						$date_reg = $J.", ".$Q;
						
						$date500 = new DateTime($row_two1['card_dob']);
						$J = date_format($date500,"D");
						$Q = date_format($date500,"d-F-Y");
						$dateprint_V = $J.", ".$Q;
						$date_reg2 = $J.", ".$Q;
						
					/**	echo '<script type="text/javascript">
								window.open ("http://localhost/fmclokoja/new_patient_print.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&mc='.$card_id_sha.'&c_dp='.$card_id.'", "mywindow","location=0,status=0,toolbar=0,menubar=0,scrollbars=1");
							</script>';**/

						$card_id = $row_two1['card_id'];
						$card_id_sha = SHA1($card_id."SHERIFUADAVURUKU".$card_id);
						
						$address = $row_two1['card_permadd'] == $row_two1['card_tempadd'] ?  $row_two1['card_permadd'] :  $row_two1['card_permadd']." / ". $row_two1['card_tempadd'];
						
						$print_link = '<a class="text-right hidden-print" style="text-decoration:none;color:black;" target="_blank" href=new_patient_print.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&mc='.$card_id_sha.'&c_dp='.$card_id.'> <p><span class="glyphicon glyphicon-print" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Print</p></a>';
						
						$data=$data.'<tr >
										<td>'.$j.'</td> 	
										<td>'.$row_two1['card_name'].'</td>
										<td>'.$row_two1['card_id'].'</td>
										<td>'.$row_two1['card_gender'].'</td>
										<td>'.$date_reg2.'</td>
										<td>'.$row_two1['card_lgov'].", ".$row_two1['card_state']." - ".$address.'</td>
										<td>'.$row_two1['card_phone'].", ".$row_two1['card_email'].'</td>
										<td>'.$row_two1['staff_name'].'</td>
										<td>'.$date_reg.'</td>
										<td>'.$print_link.'</td>
								</tr>';
						$j=$j + 1;
					
					}
					
						$data=$data.'<tr >
							<td  colspan="9" style="color:red" align="center">All Patience Search Record Result as At - '.$dateprint.'</td> 	
						</tr>
						<tr >
							<td  colspan="9" align="center">Federal Medical Centre Lokoja - Kogi State &copy; 2017</td> 	
						</tr>
					<tr class="hidden-print">
						<td colspan="9" align="center"><p onClick="window.print();" style="margin-bottom:10px;padding:5px 20px 5px 20px" class="btn btn-primary btn-md">Click to Print All</p></td>
					</tr>
					</tbody></table>';
						echo $data;	
				}else{
					echo '<div class="alert alert-info alert-dismissable">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true">
									  &times;
								   </button><h3>Ooops.. No Record Found !!!.. | <a class="text-right hidden-print" style="text-decoration:none;color:black;" href=print_patient_record.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'><span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Click Here to Return To Your Dash Board - Back To Search <span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span></a></h3></div>';
				
				}
			?>
		</div>
	</div>
		<?php require_once 'settings/footer_file.php';?>
 </div>
</body>
</html>  

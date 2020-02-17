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
	//search for treatment history
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id, patience_record.card_name, patience_record.card_id FROM treatment_history INNER JOIN staff_record ON treatment_history.staff_id = staff_record.staff_id INNER JOIN patience_record ON treatment_history.card_id = patience_record.card_id Where treatment_history.card_id Like ? ORDER BY treatment_history.id ASC");
	$stmt_ina->execute(array($criteria));
	
	//search for admission
	$stmt_inaa = $conn->prepare("SELECT *, patience_record.card_name, patience_record.card_id FROM admission_history INNER JOIN patience_record ON admission_history.card_id = patience_record.card_id Where admission_history.card_id Like ? ORDER BY admission_history.id ASC");
	$stmt_inaa->execute(array($criteria));
	$search_purpose = "Search Result Of Treatment History On Card_ID N<u>o</u>";
}
//base on Date Of Birth	
if(isset($_POST['search_date']) && isset($_POST['frmdate'])  && isset($_POST['todate'])){
	$date500 = new DateTime($_POST['frmdate']);
	$frmdate = date_format($date500,"Y-m-d");

	$date500 = new DateTime($_POST['todate']);
	$todate = date_format($date500,"Y-m-d");
	
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM treatment_history INNER JOIN staff_record ON treatment_history.staff_id = staff_record.staff_id INNER JOIN patience_record ON treatment_history.card_id = patience_record.card_id Where patience_record.card_dob between ? AND ? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($frmdate,$todate));
	
	//search for admission
	$stmt_inaa = $conn->prepare("SELECT *, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM admission_history INNER JOIN patience_record ON admission_history.card_id = patience_record.card_id Where patience_record.card_dob between ? AND ? ORDER BY patience_record.id ASC");
	$stmt_inaa->execute(array($frmdate,$todate));
	$search_purpose = "Search Result Of Treatment History Of Date Of Birth Between - ".$_POST['frmdate']." To - ".$_POST['todate'];
}
//base on date reg
if(isset($_POST['search_date1']) && isset($_POST['frmdate1'])  && isset($_POST['todate1'])){
	
	$date500 = new DateTime($_POST['frmdate1']);
	$frmdate = date_format($date500,"Y-m-d");
	
	$date500 = new DateTime($_POST['todate1']);
	$todate = date_format($date500,"Y-m-d");
	
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM treatment_history INNER JOIN staff_record ON treatment_history.staff_id = staff_record.staff_id INNER JOIN patience_record ON treatment_history.card_id = patience_record.card_id Where treatment_history.date_record between ? AND ? ORDER BY treatment_history.id ASC");
	$stmt_ina->execute(array($frmdate,$todate));
	
	//search for admission
	$stmt_inaa = $conn->prepare("SELECT *, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM admission_history INNER JOIN patience_record ON admission_history.card_id = patience_record.card_id Where admission_history.date_admitted between ? AND ? ORDER BY admission_history.id ASC");
	$stmt_inaa->execute(array($frmdate,$todate));
	$search_purpose = "Search Result Of Treatment History Registered Between - ".$_POST['frmdate1']." To - ".$_POST['todate1'];
	
}
//base on gender
if(isset($_POST['search_gender']) && isset($_POST['txtgender'])){
	
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM treatment_history INNER JOIN staff_record ON treatment_history.staff_id = staff_record.staff_id INNER JOIN patience_record ON treatment_history.card_id = patience_record.card_id Where patience_record.card_gender=? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($_POST['txtgender']));
	
	//search for admission
	$stmt_inaa = $conn->prepare("SELECT *, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM admission_history INNER JOIN patience_record ON admission_history.card_id = patience_record.card_id Where patience_record.card_gender=? ORDER BY patience_record.id ASC");
	$stmt_inaa->execute(array($_POST['txtgender']));

	$search_purpose = "Search Result Of Treatment History For All ".$_POST['txtgender']." Patient";
}

//base on state
if(isset($_POST['search_state']) && isset($_POST['txtstate'])){
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM treatment_history INNER JOIN staff_record ON treatment_history.staff_id = staff_record.staff_id INNER JOIN patience_record ON treatment_history.card_id = patience_record.card_id Where patience_record.card_state=? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($_POST['txtstate']));
	
	//search for admission
	$stmt_inaa = $conn->prepare("SELECT *, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM admission_history INNER JOIN patience_record ON admission_history.card_id = patience_record.card_id Where patience_record.card_state=? ORDER BY patience_record.id ASC");
	$stmt_inaa->execute(array($_POST['txtstate']));
	
	$search_purpose = "Search Result Of Treatment History For All Patient From ".$_POST['txtstate']." State";
}
//base on local Government
if(isset($_POST['search_lgov']) && isset($_POST['txtlgov'])){
	$stmt_ina = $conn->prepare("SELECT *,staff_record.staff_name,staff_record.staff_id, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM treatment_history INNER JOIN staff_record ON treatment_history.staff_id = staff_record.staff_id INNER JOIN patience_record ON treatment_history.card_id = patience_record.card_id Where patience_record.card_lgov=? ORDER BY patience_record.id ASC");
	$stmt_ina->execute(array($_POST['txtlgov']));
	
	//search for admission
	$stmt_inaa = $conn->prepare("SELECT *, patience_record.card_name, patience_record.card_id,patience_record.card_dob, patience_record.id FROM admission_history INNER JOIN patience_record ON admission_history.card_id = patience_record.card_id Where patience_record.card_lgov=? ORDER BY patience_record.id ASC");
	$stmt_inaa->execute(array($_POST['txtlgov']));
	
	$search_purpose = "Search Result Of Treatment History For All Patient From ".$_POST['txtlgov']." Local Government Area.";
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
						<td colspan="4" align="center"><h3><span><b>HOSPITAL DATA MINING TREATMENT HISTORY REPORT - FMC LOKOJA.</b></span></h3>
						<p><?php echo "Printed On: ".$dateprint; ?></p>
						<p><?php echo $search_purpose; ?></p>
						<p><?php echo '<a class="text-right hidden-print" style="text-decoration:none;color:black;" href=treatment_report_generation.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'> <p><span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Click Here to Return To Your Dash Board - Back To Search <span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span></p></a>'; ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
				//admission report
				$affected_rows_in = $stmt_ina->rowCount();
				if($affected_rows_in >= 1) 
				{
					echo '<h5>TREATMET HISTORY</h5>
							<table class="table table-condensed" style="background-color:#FFFFFF;margin-top:5px">
								<thead style="background-color:none;color:blue">
									<tr>
										<th>S/N<u>o</u>.</th>
										<th>Card Name</th>
										<th>Card ID N<u>o</u></th>
										<th >Card Gender</th>
										<th >Card DOB</th>
										<th >Treatment ID N<u>o</u></th>
										<th >Complain</th>
										<th >Lab Test / Result.</th>
										<th >Diagnosis.</th>
										<th >Date Reg.</th>
										<th></th>
									</tr>
								</thead>
								<tbody>';
							$j=1;$data="";
					while($row_two1 = $stmt_ina->fetch(PDO::FETCH_ASSOC))
					{
						$date500 = new DateTime($row_two1['date_record']);
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

						$card_id = $row_two1['treatment_id'];
						$card_id_sha = SHA1($card_id."SHERIFUADAVURUKU".$card_id);
						
						
						$print_link = '<a class="text-right hidden-print" style="text-decoration:none;color:black;" target="_blank" href=print_treatment_Report.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&mc='.$card_id_sha.'&c_dp='.$card_id.'> <p><span class="glyphicon glyphicon-print" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Print</p></a>';
						
						$data=$data.'<tr >
										<td>'.$j.'</td> 	
										<td>'.$row_two1['card_name'].'</td>
										<td>'.$row_two1['card_id'].'</td>
										<td>'.$row_two1['card_gender'].'</td>
										<td>'.$date_reg2.'</td>
										<td>'.$row_two1['treatment_id'].'</td>
										<td>'.$row_two1['card_complain'].'</td>
										<td>Labt Test : '.$row_two1['doctor_labtest'].". - / - Result : ".$row_two1['doctor_labresult'].'.</td>
										<td>Diagnosis : '.$row_two1['doctor_diagnosis'].", - By : ".$row_two1['staff_name'].'.</td>
										<td>'.$row_two1['date_record'].'</td>
										<td>'.$print_link.'</td>
								</tr>';
						$j=$j + 1;
					
					}
					
						$data=$data.'<tr >
							<td  colspan="9" style="color:red" align="center">All Patience Treatment History Search Result as At - '.$dateprint.'</td> 	
						</tr>
					</tbody></table>';
						echo $data;	
				}else{
					echo '<div class="alert alert-info alert-dismissable hidden-print">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true">
									  &times;
								   </button><h5>Ooops.. No Treatment Record Found !!!.. | <a class="text-right hidden-print" style="text-decoration:none;color:black;" href=treatment_report_generation.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'><span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Click Here to Return To Your Dash Board - Back To Search <span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span></a></h5></div>';
				
				}
			?>
			<?php
				//ADMISSION HISTORY
				$affected_rows_in = $stmt_inaa->rowCount();
				if($affected_rows_in >= 1) 
				{
					echo '<h5>ADMISSION HISTORY</h5>
							<table class="table table-condensed" style="background-color:#FFFFFF;margin-top:5px">
								<thead style="background-color:none;color:blue">
									<tr>
										<th>S/N<u>o</u>.</th>
										<th>Card Name</th>
										<th>Card ID N<u>o</u></th>
										<th>Card Gender / DOB</th>
										<th>Admission ID N<u>o</u></th>
										<th>Admission Details</th>
										<th>Discharge Details</th>
										<th></th>
									</tr>
								</thead>
								<tbody>';
							$j=1;$data="";
					while($row_two1 = $stmt_inaa->fetch(PDO::FETCH_ASSOC))
					{
						
						$date500 = new DateTime($row_two1['card_dob']);
						$J = date_format($date500,"D");
						$Q = date_format($date500,"d-F-Y");
						$dateprint_V = $J.", ".$Q;
						$date_reg2 = $J.", ".$Q;

						$card_id = $row_two1['admission_id'];
						$card_id_sha = SHA1($card_id."SHERIFUADAVURUKU".$card_id);
						
						
						$print_link = '<a class="text-right hidden-print" style="text-decoration:none;color:black;" target="_blank" href=print_admitted_Report.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&mc='.$card_id_sha.'&c_dp='.$card_id.'> <p><span class="glyphicon glyphicon-print" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Print</p></a>';
						
						$admission_details ="Admission Purpose: - ".$row_two1['admission_purpose'].", Admitted AT : ".$row_two1['place_admitted'].", - Admitted By : ".$row_two1['staff_add_name'].", - On : ".$row_two1['date_admitted'];
						
						$discharge_details ="Discharge Reason: - ".$row_two1['purpose_discharge'].", - Discharged By : ".$row_two1['staff_dis_name'].", - On : ".$row_two1['date_discharge'];
						
						$data=$data.'<tr >
										<td>'.$j.'</td> 	
										<td>'.$row_two1['card_name'].'</td>
										<td>'.$row_two1['card_id'].'</td>
										<td>'.$row_two1['card_gender']." / ".$date_reg2.'</td>
										<td>'.$row_two1['admission_id'].'</td>
										<td>'.$admission_details.'.</td>
										<td>'.$discharge_details.'.</td>
										<td>'.$print_link.'</td>
								</tr>';
						$j=$j + 1;
					
					}
					
						$data=$data.'<tr >
							<td  colspan="9" style="color:red" align="center">All Patience Admission History Search Result as At - '.$dateprint.'</td> 	
						</tr>
					</tbody></table>';
						echo $data;	
				}else{
					echo '<div class="alert alert-info alert-dismissable hidden-print">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true">
									  &times;
								   </button><h5 >Ooops.. No Admission Record Found !!!.. | <a class="text-right hidden-print" style="text-decoration:none;color:black;" href=treatment_report_generation.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'><span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Click Here to Return To Your Dash Board - Back To Search <span class="glyphicon glyphicon-home" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span></a></h5></div>';
				
				}
				echo '<tr class="hidden-print">
						<td colspan="10" align="center"><p align="centre" onClick="window.print();" style="margin-bottom:10px;padding:5px 20px 5px 20px" class="btn btn-primary btn-md">Click to Print</p></td>
					</tr>';
			?>
		</div>
	</div>
		<?php require_once 'settings/footer_file.php';?>
 </div>
</body>
</html>  

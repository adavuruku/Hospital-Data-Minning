<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$sec="Act_Me";$err=$notice_msg=$er_msg=$er_msg2=$msg2=$msg="";

if(!isset($_SESSION['staff_id']) || !isset($_SESSION['staff_name'])){
	header("location: index.php");
}

$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");


if(!isset($_GET['m_']) || !isset($_GET['l_w'])){
	if(!isset($_POST['sec']) || !$_POST['page_authy']){
		header("location: index.php");
	}
}else{
	if($_GET['m_'] != $_SESSION['page_authy'] || $_GET['l_w'] != $sec ){
		header("location: index.php");
	}
}

$errPL=" Record Discharge / Cleared Admitted Patient - All * Field are Compulsory !!";
$notice_msg='<div class="alert alert-info alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$errPL.' </div>';
$txtcomplain = $txtlabtest = $txtlabtestresult = $txtdiagnosis = $txtout = $txtplace = $txtpurpose =""; $txtsearch="";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search'])){
	$txtsearch = trim($_POST['txtsearch']);
	if(isset($_SESSION['card_d'])){
		unset($_SESSION['card_d']);
	}
	if($txtsearch != ""){
		$txtout = "";
		$stmt_ina = $conn->prepare("SELECT * FROM admission_history INNER JOIN patience_record on  admission_history.card_id = patience_record.card_id  where admission_history.admission_id =?  Limit 1");
		$stmt_ina->execute(array($txtsearch));
		$affected_rows_in = $stmt_ina->rowCount();
		if($affected_rows_in >= 1) 
		{
			$row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC);
			$date500 = new DateTime($row_two['date_admitted']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y");
			$dateprint_V = $J.", ".$Q;
			$dob = $J.", ".$Q;	
			$_SESSION['card_d'] = $row_two['admission_id'];
			$msgAll = 'Admission ID No. :'.$row_two['admission_id'].'</h5><br/>
						<br/><h5> Patience Card ID No. :'.$row_two['card_id'].'</h5><br/>
						<h5> Patience Name :'.$row_two['card_name'].'</h5><br/>
						<h5> Patience Gender :'.$row_two['card_gender'].'</h5><br/>
						<h5> Patience Date Of Admission :'.$dob.'</h5><br/>';
			$txtout='<div class="alert alert-info alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$msgAll.' </div>';		
					
		}else{
			if(isset($_SESSION['card_d'])){
				unset($_SESSION['card_d']);
			}
			$txtout='<div class="alert alert-warning alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>No Record Found For The Admission Pin Details - '.$txtsearch.' </div>';
		}
	}
}
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
			
	$txtpurpose =trim($_POST['txtpurpose']);
	       
	if($txtpurpose=="" || !isset($_SESSION['card_d']))
		{
			$err = $errPL = "Unable to Save Record.. Please Verify Your Entries to Ensure they are all Provided !!";
			$notice_msg='<div class="alert alert-danger alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$errPL.' </div>';
		}else{
			
				$sth = $conn->prepare("UPDATE admission_history SET staff_dis_id=?, staff_dis_name=?, purpose_discharge=?,date_discharge=now() where admission_id=? Limit 1");
				if($sth->execute(array($_SESSION['staff_id'],$_SESSION['staff_name'],$txtpurpose,$_SESSION['card_d']))){
					//redirect to preview page
					$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
					$sec="Act_Me";
					$card_id = $_SESSION['card_d'];
					//header("location: staf_account_home.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
					$err = $errPL = "Success: New Record Created and Saved Successfully!!";
							$notice_msg='<div class="alert alert-success alert-dismissable">
									   <button type="button" class="close" data-dismiss="alert" 
										  aria-hidden="true">
										  &times;
									   </button>'.$errPL.' </div>';
							$card_id_sha = SHA1($card_id."SHERIFUADAVURUKU".$card_id);		   
						echo '<script type="text/javascript">
								window.open ("http://localhost/fmclokoja/print_admitted_Report.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&mc='.$card_id_sha.'&c_dp='.$card_id.'", "mywindow","location=0,status=0,toolbar=0,menubar=0,scrollbars=1");
							</script>';
				}else{
							$err = $errPL = "Unable to Save and Preview Your Application.. Please Verify Your Entries to Ensure they are all Provided !!";
							$notice_msg='<div class="alert alert-danger alert-dismissable">
									   <button type="button" class="close" data-dismiss="alert" 
										  aria-hidden="true">
										  &times;
									   </button>'.$errPL.' </div>';
					
					}
			
		}
}



/**$stmt_in = $conn->prepare("REPLACE INTO newMytest (id,name_goods, gprice, state) VALUES(90,'dano',500,'Bauchi')");
$stmt_in->execute();
//$stmt_in->execute();
if($stmt_in->execute()) 
{
	echo 'Replaced !!';
}**/
?>

</head>
<body style="width:80%;margin:auto">
<div class="container-fluid" >
		<div class="row hidden-print">
			<?php
				require_once 'settings/nav_top_staff.php';
			?> 
		</div>
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
	<div class="row" >
		<div class="imageupload panel panel-primary">
			<div class="panel-heading clearfix">
				<h3 class="panel-title pull-left">Welcome - <?php echo $_SESSION['staff_name']; ?> , To Staff Dashboard !!</h3>
			</div>
		</div>
		
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-bottom:10px">
				<?php echo $notice_msg;?>
				<!-- search form -->
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-primary" style="margin-bottom:5px;margin-top:5px;text-align:centre;padding-top:5px;background-color:#CCCCFF">
						
						<h4>Enter Patience Admission ID N<u>o</u> To Search </h4>
						<hr/>
						<form role="form"  name="search_form"  id="form2" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
						
							
							    <div class="form-group">
									<label for="txtsearch" class="control-label col-xs-3">Enter Admission ID N<u>o</u> : <span style="color:red">(*)</span></label>
									<div class="col-xs-6">
										<input type="text" class="form-control"  id="txtsearch" name="txtsearch" value="<?php  echo $txtsearch;?>" required="true" placeholder="Enter Patience Admission PIN (e.g 1234567812ADM)" />
									</div>
									<div class="col-xs-3">
										<input type="submit" name="search" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Search Record" class="btn btn-primary btn-md"></input>
									</div>
								</div>
						</form>
							
				</div>
					<?php echo $txtout; ?>
				<!-- search form close-->
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				
				<form role="form"  name="reg_form"  id="form" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
				
					<input type="hidden" name="page_authy" value="<?php echo $_SESSION['page_authy']?>" ></input>
					<input type="hidden" name="sec" value="<?php echo $sec ?>" ></input>
						<div class="form-group">
							<label for="txtpurpose"> Purpose Of Discharge : <span style="color:red">(*)</span></label> 
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
								<textarea class="form-control"  rows="4" id="txtpurpose" name="txtpurpose" required="true" placeholder="Enter Purpose of Discharging Patient">
									<?php echo $txtpurpose;?>
								</textarea>
							</div>
						</div>
						
			
						<div class="form-group pull-right">
							<div class="input-group">
								<input type="submit" name="submit" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Save Discharge Record" class="btn btn-primary btn-md"></input>
							</div>
						</div>
				</form>
				
			</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<!-- Staff Navigation-->
				<?php require_once ('settings/staff_left_nav.php');?>
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

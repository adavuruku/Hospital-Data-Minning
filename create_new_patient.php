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

$errPL=" Register New Patient (Create Card) - All * Field are Compulsory !!";
$notice_msg='<div class="alert alert-info alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$errPL.' </div>';
$txtlgov=$txtstate=$txtgender=$txtPhone=$txtoname=$txtfname=$txttitle=$txtemail=$txtstaffid=$txttempadd =$txtPermadd=$txtdob = "";
$txttitle="Select Title"; $txtgender="Select Gender";$txtstate="Select State" ;$txtlgov="Select Local Government";

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
			
	$txtlgov=$_POST['txtlgov'];
	$txtstate=$_POST['txtstate'];$txtgender=$_POST['txtgender'];$txtPhone=trim($_POST['txtPhone']);
	$txtoname=trim($_POST['txtoname']);$txtfname=trim($_POST['txtfname']);$txttitle=$_POST['txttitle'];
	$txtemail=trim($_POST['txtemail']);$txtdob=trim($_POST['txtdob']);
	$txtPermadd=trim($_POST['txtPermadd']);
	$txttempadd=trim($_POST['txttempadd']);
	
	       
	if($txttempadd=="" || $txtPermadd=="" || $txtPhone=="" || $txtoname=="" || $txtfname=="" || $txtdob=="" ||
		$txttitle=="Select Title" || $txtgender=="Select Gender" || $txtstate=="Select State" || $txtlgov=="Select Local Government")
		{
			$err = $errPL = "Unable to Save Your Application.. Please Verify Your Entries to Ensure they are all Provided !!";
			$notice_msg='<div class="alert alert-danger alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$errPL.' </div>';
		}else{
				//generate ID
				$date500 = new DateTime($txtdob);
				$txtdob = date_format($date500,"Y-m-d");
				
				
				$date500 = new DateTime();
				$theyear = date_format($date500,"y");
				$numL=mt_rand(100000,999999);
				$card_id = "FMCL".$theyear.$numL;
				$sth = $conn->prepare("REPLACE INTO patience_record (card_id, card_name, card_gender,card_phone,card_state,card_lgov,card_email,card_permadd,card_tempadd,card_dob,officer_Reg,card_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,now())");
				$sth->bindValue (1, $card_id);
				$sth->bindValue (2, $txttitle." " .$txtfname." ".$txtoname);
				$sth->bindValue (3, $txtgender);
				$sth->bindValue (4, $txtPhone);
				$sth->bindValue (5, $txtstate);
				$sth->bindValue (6, $txtlgov);
				$sth->bindValue (7, $txtemail);
				$sth->bindValue (8, $txtPermadd);
				$sth->bindValue (9, $txttempadd);
				$sth->bindValue (10, $txtdob);
				$sth->bindValue (11, $_SESSION['staff_id']);
				if($sth->execute()){
					//redirect to preview page
					$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
					$sec="Act_Me";
					//header("location: staf_account_home.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
					$err = $errPL = "Success: New Record Created and Saved Successfully!!";
							$notice_msg='<div class="alert alert-success alert-dismissable">
									   <button type="button" class="close" data-dismiss="alert" 
										  aria-hidden="true">
										  &times;
									   </button>'.$errPL.' </div>';
							$card_id_sha = SHA1($card_id."SHERIFUADAVURUKU".$card_id);		   
						echo '<script type="text/javascript">
								window.open ("http://localhost/fmclokoja/new_patient_print.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&mc='.$card_id_sha.'&c_dp='.$card_id.'", "mywindow","location=0,status=0,toolbar=0,menubar=0,scrollbars=1");
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
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<?php echo $notice_msg;?>
				<form role="form"  name="reg_form"  id="form" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
				
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<input type="hidden" name="page_authy" value="<?php echo $_SESSION['page_authy']?>" ></input>
				<input type="hidden" name="sec" value="<?php echo $sec ?>" ></input>
						<div class="form-group">
							<label for="txtPasswordC2"> Tile: <span style="color:red">(*)</span></label>
							<select class="form-control" name="txttitle">
								<option value="<?php echo $txttitle; ?>" ><?php echo $txttitle; ?></option>
								<option value="Doc.">Doc.</option>
								<option value="Nurse.">Nurse.</option>
								<option value="Mr.">Mr.</option>
								<option value="Mrs.">Mrs.</option>
								<option value="Miss.">Miss.</option>
							</select>
						</div>
						<div class="form-group">
							<label for="txtPasswordC2">First Name : <span style="color:red">(*)</span></label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
								<input type="text" class="form-control" onkeypress="wipeboxeror('4')" id="txtfname" name="txtfname" value="<?php  echo $txtfname;?>" required="true" placeholder="Enter Your First Name" />
							</div>
						</div>
						<div class="form-group">
							<label for="txtPasswordC2">Other Name : <span style="color:red">(*)</span></label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
								<input type="text" class="form-control" onkeypress="wipeboxeror('4')" id="txtoname" name="txtoname" value="<?php echo $txtoname;?>" required="true" placeholder="Enter Other Names " />
							</div>
						</div>
						<div class="form-group">
							<label for="txtPasswordC2"> Gender: <span style="color:red">(*)</span></label>
							<select class="form-control" name="txtgender">
								<option value="<?php echo $txtgender; ?>" ><?php echo $txtgender; ?></option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="txtdob">Date Of Birth :<span style="color:red">(*)</span></label> 
							<div class="input-group date" data-provide="datepicker">
								
								<input type="text" class="form-control"  id="txtdob" name="txtdob" value="<?php echo $txtdob;?>" required="true" />
								<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							</div>
						</div>
							
						<div class="form-group">
							<label for="txtPhone">Phone N<u>o</u> : <span style="color:red">(*)</span></label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
								<input type="text" class="form-control" onkeydown="return noNumbers(event,this)" id="txtPhone" name="txtPhone" value="<?php echo $txtPhone;?>" required="true" placeholder="Enter Main Phone No" />
							</div>
						</div>
						<div class="form-group">
							<label for="txtPhone">Email ID : </label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
								<input type="email" class="form-control" id="txtemail" name="txtemail" value="<?php echo $txtemail;?>" placeholder="Enter Your Email Address" />
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
						
						<div class="form-group">
							<label for="txtPasswordC2"> State: <span style="color:red">(*)</span></label>
							<select class="form-control" id="cmbstate" name="txtstate" onchange="stateComboChange();">
								
								<option value="<?php echo $txtstate; ?>" ><?php echo $txtstate; ?></option>
								<option value="Abuja" title="Abuja">Abuja</option>
								<option value="Abia" title="Abia">Abia</option>
								<option value="Adamawa" title="Adamawa">Adamawa</option>
								<option value="Akwa Ibom" title="Akwa Ibom">Akwa Ibom</option>
								<option value="Anambra" title="Anambra">Anambra</option>
								<option value="Bauchi" title="Bauchi">Bauchi</option>
								<option value="Bayelsa" title="Bayelsa">Bayelsa</option>
								<option value="Benue" title="Benue">Benue</option>
								<option value="Bornu" title="Bornu">Bornu</option>
								<option value="Cross River" title="Cross River">Cross River</option>
								<option value="Delta" title="Delta">Delta</option>
								<option value="Ebonyi" title="Ebonyi">Ebonyi</option>
								<option value="Edo" title="Edo">Edo</option>
								<option value="Ekiti" title="Ekiti">Ekiti</option>
								<option value="Enugu" title="Enugu">Enugu</option>
								<option value="Gombe" title="Gombe">Gombe</option>
								<option value="Imo" title="Imo">Imo</option>
								<option value="Jigawa" title="Jigawa">Jigawa</option>
								<option value="Kaduna" title="Kaduna">Kaduna</option>
								<option value="Kano" title="Kano">Kano</option>
								<option value="Katsina" title="Katsina">Katsina</option>
								<option value="Kebbi" title="Kebbi">Kebbi</option>
								<option  value="Kogi" title="Kogi">Kogi</option>
								<option value="Kwara" title="Kwara">Kwara</option>
								<option value="Lagos" title="Lagos">Lagos</option>
								<option value="Nassarawa" title="Nassarawa">Nassarawa</option>
								<option value="Niger" title="Niger">Niger</option>
								<option value="Ogun" title="Ogun">Ogun</option>
								<option value="Ondo" title="Ondo">Ondo</option>
								<option value="Osun" title="Osun">Osun</option>
								<option value="Oyo" title="Oyo">Oyo</option>
								<option value="Plateau" title="Plateau">Plateau</option>
								<option value="Rivers" title="Rivers">Rivers</option>
								<option value="Sokoto" title="Sokoto">Sokoto</option>
								<option value="Taraba" title="Taraba">Taraba</option>
								<option value="Yobe" title="Yobe">Yobe</option>
								<option value="Zamfara" title="Zamfara">Zamfara</option>
							</select>
						</div>
						<div class="form-group">
									<label for="txtPasswordC2"> Local Government: <span style="color:red">(*)</span></label>
									<select class="form-control" id="cmblgov" name="txtlgov">
										<option value="<?php echo $txtlgov; ?>" ><?php echo $txtlgov; ?></option>
									</select>
								</div>
						<div class="form-group">
							<label for="txtPasswordC2">Permanent Address : <span style="color:red">(*)</span></label> 
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
								<textarea class="form-control"  rows="4" id="txtPermadd" name="txtPermadd" required="true" placeholder="Enter Permanent Address">
									<?php echo $txtPermadd;?>
								</textarea>
							</div>
						</div>
						<div class="form-group">
							  <label for="c_address"></label>
							  <label class="checkbox-inline">
									<input type="checkbox" id="samedetails"  onclick="samedetails1();"> Click here if Temporary and Permanent Address is thesame.
							</label>
						</div>
						<div class="form-group">
							<label for="txtPasswordC2">Residensial Address : <span style="color:red">(*)</span></label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
								<textarea class="form-control" rows="4" id="txttempadd" name="txttempadd" required="true" placeholder="Enter Residensial Address">
									<?php echo $txttempadd;?>
								</textarea>
							</div>
						</div>
						<div class="form-group pull-right">
							<div class="input-group">
								<input type="submit" name="submit" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Save Record" class="btn btn-primary btn-md"></input>
							</div>
						</div>
					</div>
				</form>
				
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

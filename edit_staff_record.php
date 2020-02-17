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

$errPL=" Edit Staff Record (Note Staff ID Can't be change rather the account should be block and another be created for reference purpose - All * Field are Compulsory !!";
$notice_msg='<div class="alert alert-info alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$errPL.' </div>';
$txtdept=$txtlgov=$txtstate=$txtgender=$txtPhone=$txtoname=$txtfname=$txttitle=$txtryt =$txtemail=$txtstaffP=$txtstaffid="";$txtsearch=$txtout="";
$txttitle="Select Title"; $txtgender="Select Gender";$txtstate="Select State" ;$txtlgov="Select Local Government";$txtdept="Select Department" ;$txtryt ='Select Staff Access Right';
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search'])){
	$txtsearch = trim($_POST['txtsearch']);
	if(isset($_SESSION['card_d'])){
		unset($_SESSION['card_d']);
	}
	if($txtsearch != ""){
		$txtout = "";
		$stmt_ina = $conn->prepare("SELECT * FROM staff_record where staff_id = ?  Limit 1");
		$stmt_ina->execute(array($txtsearch));
		$affected_rows_in = $stmt_ina->rowCount();
		if($affected_rows_in >= 1) 
		{
			$row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC);
			$date500 = new DateTime($row_two['date_reg']);
			$J = date_format($date500,"D");
			$Q = date_format($date500,"d-F-Y");
			$dateprint_V = $J.", ".$Q;
			$dob = $J.", ".$Q;	
			$_SESSION['card_d'] = $row_two['staff_id'];
			$path ="";
			if($row_two['del_status'] =="1"){
				$path ='<p style="color:red;">This Account is Blocked / Deleted To Enable / Activate the Account  <a style="color:black;text-weight:bold;"  href="edit_staff_record.php?m_='.$_SESSION['page_authy'].'&access='.$row_two['staff_id'].'&l_w='.$sec.'">
						Click Here To Activate Account </a></p>';
			}
			$msgAll = 'Staff ID No. : '.$row_two['staff_id'].'</h5><br/>
						<br/><h5> Staff Name. : '.$row_two['staff_name'].'</h5><br/>
						<h5> Date Created : '.$dob.'</h5><br/>'.$path;
			$txtout='<div class="alert alert-info alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$msgAll.' </div>';
			$txtdept=$row_two['staff_dept']; $txtlgov=$row_two['staff_lgov'];$txtstate=$row_two['staff_state'];$txtgender=$row_two['staff_gender'];$txtPhone=$row_two['staff_phone'];$txtfname=$row_two['staff_name'];$txtemail=$row_two['staff_email'];$txtstaffP=$row_two['staff_password'];
					
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
//search ends
//activate account
if(isset($_GET['access']) && isset($_SESSION['card_d'])){
	$sth = $conn->prepare("UPDATE staff_record SET del_status=? where staff_id=? Limit 1");
	if($sth->execute(array("0",$_SESSION['card_d']))){
		
		$err = $errPL = "Success: The Account has been Reactivated Successfully!!";
				$notice_msg='<div class="alert alert-success alert-dismissable">
						   <button type="button" class="close" data-dismiss="alert" 
							  aria-hidden="true">
							  &times;
						   </button>'.$errPL.' </div>';
	}else{
				$err = $errPL = "Unable to Update Record.. Please Verify Your Entries to Ensure they are all Provided !!";
				$notice_msg='<div class="alert alert-danger alert-dismissable">
						   <button type="button" class="close" data-dismiss="alert" 
							  aria-hidden="true">
							  &times;
						   </button>'.$errPL.' </div>';
		
		}

}
//blcoking begins
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete']) && isset($_SESSION['card_d'])){
	$sth = $conn->prepare("UPDATE staff_record SET del_status=? where staff_id=? Limit 1");
	if($sth->execute(array("1",$_SESSION['card_d']))){
		
		$err = $errPL = "Success: The Account has been Blocked Successfully!!";
				$notice_msg='<div class="alert alert-success alert-dismissable">
						   <button type="button" class="close" data-dismiss="alert" 
							  aria-hidden="true">
							  &times;
						   </button>'.$errPL.' </div>';
	}else{
				$err = $errPL = "Unable to Update Record.. Please Verify Your Entries to Ensure they are all Provided !!";
				$notice_msg='<div class="alert alert-danger alert-dismissable">
						   <button type="button" class="close" data-dismiss="alert" 
							  aria-hidden="true">
							  &times;
						   </button>'.$errPL.' </div>';
		
		}
}
//update Begins
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])){
			
	$txtdept=$_POST['txtdept'];$txtlgov=$_POST['txtlgov'];
	$txtstate=$_POST['txtstate'];$txtgender=$_POST['txtgender'];$txtPhone=trim($_POST['txtPhone']);
	$txtoname=trim($_POST['txtoname']);$txtfname=trim($_POST['txtfname']);$txttitle=$_POST['txttitle'];
	$txtryt =$_POST['txtryt'];$txtemail=trim($_POST['txtemail']);$txtstaffP=trim($_POST['txtstaffP']);
	
	       
	if( $txtstaffP=="" || $txtPhone=="" || $txtoname=="" || $txtfname=="" || $txtstaffP=="" ||  !isset($_SESSION['card_d']) ||
		$txttitle=="Select Title" || $txtryt=="Select Staff Access Right" || $txtgender=="Select Gender" || $txtstate=="Select State" || $txtlgov=="Select Local Government" || $txtdept=="Select Department")
		{
			$err = $errPL = "Unable to Save and Preview Your Application.. Please Verify Your Entries to Ensure they are all Provided !!";
			$notice_msg='<div class="alert alert-danger alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$errPL.' </div>';
		}else{
				$sth = $conn->prepare("REPLACE INTO staff_record (staff_id, staff_name, staff_gender,staff_dept,staff_phone,staff_state,staff_lgov,staff_email,staff_password,staff_ryt,officer_Reg,date_reg) VALUES (?,?,?,?,?,?,?,?,?,?,?,now())");
				$sth->bindValue (1, $_SESSION['card_d']);
				$sth->bindValue (2, $txttitle." " .$txtfname." ".$txtoname);
				$sth->bindValue (3, $txtgender);
				$sth->bindValue (4, $txtdept);
				$sth->bindValue (5, $txtPhone);
				$sth->bindValue (6, $txtstate);
				$sth->bindValue (7, $txtlgov);
				$sth->bindValue (8, $txtemail);
				$sth->bindValue (9, $txtstaffP);
				$sth->bindValue (10, $txtryt);
				$sth->bindValue (11, $_SESSION['staff_id']);
				if($sth->execute()){
					//redirect to preview page
					$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
					$sec="Act_Me";
					//header("location: staf_account_home.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
					$err = $errPL = "Success:Staff Record Was Updated and Saved Successfully!!";
							$notice_msg='<div class="alert alert-success alert-dismissable">
									   <button type="button" class="close" data-dismiss="alert" 
										  aria-hidden="true">
										  &times;
									   </button>'.$errPL.' </div>';
						
				}else{
							$err = $errPL = "Unable to Save Your Application.. Please Verify Your Entries to Ensure they are all Provided !!";
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
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-primary" style="margin-bottom:5px;margin-top:5px;text-align:centre;padding-top:5px;background-color:#CCCCFF">
						
						<h4>Enter Staff ID N<u>o</u> To Search </h4>
						<hr/>
						<form role="form"  name="search_form"  id="form2" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
						
							
							    <div class="form-group">
									<label for="txtsearch" class="control-label col-xs-3">Enter Staff ID N<u>o</u> : <span style="color:red">(*)</span></label>
									<div class="col-xs-6">
										<input type="text" class="form-control"  id="txtsearch" name="txtsearch" value="<?php  echo $txtsearch;?>" required="true" placeholder="Enter Staff ID No " />
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
								<option value="Engr.">Engr.</option>
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
								<input type="text" class="form-control" onkeypress="wipeboxeror('4')" id="txtoname" name="txtoname" value="<?php echo $txtoname;?>" placeholder="Enter Other Names " />
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
							<label for="txtstaffP">Staff Password : <span style="color:red">(*)</span></label>
							<div class="input-group">
								<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
								<input type="password" class="form-control" onkeypress="wipeboxeror('4')" id="txtstaffP" name="txtstaffP" value="<?php echo $txtstaffP;?>" required="true" placeholder="Enter Staff Pasword " />
							</div>
						</div>
						<div class="form-group">
							<label for="txtPasswordC2"> Department : <span style="color:red">(*)</span></label>
							<select class="form-control" id="department" name="txtdept">
								<option value="<?php echo $txtdept; ?>" ><?php echo $txtdept; ?></option>
								<option value="Pharmacy" >Account</option>
								<option value="Doctor" >Doctor</option>
								<option value="Nurse" >Nurse</option>
								<option value="Pharmacy" >Pharmacy</option>
								<option value="Pharmacy" >Consultant</option>
								<option value="Lab Tech" >Lab Tech</option>
								<option value="Labourer" >Labourer</option>
								<option value="Labourer" >Management</option>
								<option value="Labourer" >Others</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

						
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
							<label for="txtryt"> Access Right : <span style="color:red">(*)</span></label>
							<select class="form-control" name="txtryt">
								<option value="<?php echo $txtryt; ?>" ><?php echo $txtryt; ?></option>
								<option value="1">Full Right</option>
								<option value="2">Restricted</option> 
							</select>
						</div>
						<div class="form-group pull-right">
							<div class="input-group">
								<input type="submit" name="delete" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Block / Close Account" class="btn btn-primary btn-md"></input>
								<input type="submit" name="submit" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Update Account" class="btn btn-primary btn-md"></input>
							</div>
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

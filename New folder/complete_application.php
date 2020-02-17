<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$sec="Act_Me";$err="";
$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
if(!isset($_GET['m_']) || !isset($_GET['l_w'])){
	if(!isset($_POST['sec']) || !$_POST['page_authy']){
		header("location index.php");
	}
}else{
	if($_GET['m_'] != $_SESSION['page_authy'] || $_GET['l_w'] != $sec ){
		header("location index.php");
	}
}
$errPL=$_SESSION['email_id']." , Still Processing Online Clearance Application Form";
$notice_msg='<div class="alert alert-info alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$errPL.' </div>';
					   
if(!isset($_GET['m_']) || !isset($_GET['l_w'])){
	if($_POST['page_authy'] != $_SESSION['page_authy'] || $_POST['sec'] != $sec ){
		header("location index.php");
	}
}

function ak_img_resize($target, $newcopy, $w, $h, $ext) 
{
    list($w_orig, $h_orig) = getimagesize($target);
    $scale_ratio = $w_orig / $h_orig;
    if (($w / $h) > $scale_ratio) {
           $w = $h * $scale_ratio;
    } else {
           $h = $w / $scale_ratio;
    }
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 80);
	water_mark_image($target,$ext);
}

$txtexit=$txtent=$txtduration=$txtaward=$txtmodestudy=$txtentrance=$txtdept=$txtfaculty=$txttempadd=$txtlgov=$txtPermadd =$txtstate=$txtnationality=$txtreligion=$txtgender=$txtAPhone=$txtPhone=$txtoname=$txtfname=$txttitle="";
$txttitle="Select Title"; $txtreligion="Select Religion";$txtgender="Select Gender";$txtstate="Select State" ;$txtlgov="Select Local Government";$txtmodestudy="Select Mode of Study" ; $txtaward="Select Award"; $txtdept="Select Department" ;$txtfaculty="Select Faculty" ;$txtentrance="Select Entrance Mode";


	$stmt_in = $conn->prepare("SELECT * FROM student_info where sregno=? or sappid=? Limit 1");
		$stmt_in->execute(array($_SESSION['regno'],$_SESSION['app_id']));
		$affected_rows_in = $stmt_in->rowCount();
		if($affected_rows_in >= 1) 
		{	
			$row = $stmt_in->fetch(PDO::FETCH_ASSOC);
			$txtexit=$row['syearexit'];$txtent=$row['syearent'];$txtduration=$row['scoursedur'];$txtaward=$row['sawardview'];$txtmodestudy=$row['smodestudy'];
			
			$txtentrance=$row['smodeent'];$txtdept=$row['sdept'];$txtfaculty=$row['sfaculty'];$txttempadd=$row['sresidentadd'];$txtlgov=$row['slocalgov'];
			
			$txtPermadd =$row['spermadd'];$txtstate=$row['sstate'];//$txtnationality=$row['snationality'];
			$txtreligion=$row['sreligion'];$txtgender=$row['sgender'];
			
			$txtAPhone=$row['sphonealt'];$txtPhone=$row['sphonemain'];$txtoname=$row['sothername'];$txtfname=$row['sfirstname'];$txttitle=$row['stitle'];
		}
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']))
{
	$txtexit=trim($_POST['txtexit']);$txtent=trim($_POST['txtent']);$txtduration=trim($_POST['txtduration']);$txtaward=$_POST['txtaward'];$txtmodestudy=$_POST['txtmodestudy'];
			
	$txtentrance=trim($_POST['txtentrance']);$txtdept=$_POST['txtdept'];$txtfaculty=$_POST['txtfaculty'];$txttempadd=trim($_POST['txttempadd']);$txtlgov=$_POST['txtlgov'];
	
	$txtPermadd =trim($_POST['txtPermadd']);$txtstate=$_POST['txtstate'];//$txtnationality=$row['snationality'];
	$txtreligion=$_POST['txtreligion'];$txtgender=$_POST['txtgender'];
	
	$txtAPhone=trim($_POST['txtAPhone']);$txtPhone=trim($_POST['txtPhone']);$txtoname=trim($_POST['txtoname']);$txtfname=trim($_POST['txtfname']);$txttitle=$_POST['txttitle'];
	//echo $txtAPhone;
	       
	if( $txtexit=="" || $txtent=="" || $txtduration=="" || $txttempadd=="" || $txtPermadd=="" || $txtPhone=="" || $txtoname=="" || $txtfname=="" || 
		$txttitle=="Select Title" || $txtreligion=="Select Religion" || $txtgender=="Select Gender" || $txtstate=="Select State" || $txtlgov=="Select Local Government" || $txtmodestudy=="Select Mode of Study" || $txtaward=="Select Award" || $txtdept=="Select Department" || $txtfaculty=="Select Faculty" || $txtentrance=="Select Entrance Mode")
		{
			$err = $errPL = "Unable to Save and Preview Your Application.. Please Verify Your Entries to Ensure they are all Provided !!";
			$notice_msg='<div class="alert alert-danger alert-dismissable">
					   <button type="button" class="close" data-dismiss="alert" 
						  aria-hidden="true">
						  &times;
					   </button>'.$errPL.' </div>';
		}else{
		
			//update record
			if($_FILES['image-file']['name']=="")
			{
				$err = $errPL = "Unable to Save and Preview Your Application.. Please Verify Your Entries to Ensure they are all Provided !!";
						$notice_msg='<div class="alert alert-danger alert-dismissable">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true">
									  &times;
								   </button>'.$errPL.' </div>';
				
			}else{
				
				$tmpName  = $_FILES['image-file']['tmp_name'];
				$extension = substr(strrchr($_FILES['image-file']['name'], "."), 1);
				$newpath= $_SESSION['app_id'].".$extension";
				$moveto= "resource/".$newpath;
				move_uploaded_file($tmpName,$moveto);
				
				$stmt = $conn->prepare("UPDATE student_info SET syearexit = ?, syearent = ?, scoursedur = ?, sawardview = ?, smodestudy = ?, smodeent = ?, sdept = ?, sfaculty = ?, sresidentadd = ?, slocalgov = ?, spermadd = ?, sstate = ?, sreligion = ?, sgender = ?, sphonealt = ?, sphonemain = ?, sothername = ?, sfirstname = ?, stitle = ?, snationality=?, sregdate=now() where sregno=? or sappid=? Limit 1");
				if($stmt->execute(array(
					$txtexit, $txtent, $txtduration, $txtaward, $txtmodestudy,$txtentrance, $txtdept, $txtfaculty, $txttempadd, $txtlgov, 
					$txtPermadd, $txtstate, $txtreligion, $txtgender,$txtAPhone, $txtPhone, $txtoname, $txtfname,$txttitle,"Nigeria", $_SESSION['regno'], $_SESSION['app_id']
				))){
						
						//redirect to preview page
						$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
						$sec="Act_Me";
						header("location: registration_preview.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
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
}			
?>

</head>
<body style="width:80%;margin:auto">
<div class="container-fluid" >
		<div class="row">
			<?php
				require_once 'settings/nav_top_login.php';
			?> 
		</div>
	
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
	<div class="row" >
		<div class="imageupload panel panel-info">
			<div class="panel-heading clearfix">
				<h3 class="panel-title pull-left">Complete Your Online Clearance Application Form</h3>
			</div>
		</div>
		<?php echo $notice_msg;?>
		<!-- middle content ends here where vertical nav slides and news ticker ends -->
		<form role="form"  name="reg_form"  id="form" class="form-vertical" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px;">
				<!-- start copy bootstrap-imageupload. -->
				<input type="hidden" name="page_authy" value="<?php echo $_SESSION['page_authy']?>" ></input>
				<input type="hidden" name="sec" value="<?php echo $sec ?>" ></input>
				<div class="imageupload panel panel-primary" id="my-imageupload">
					<div class="panel-heading clearfix">
						<h3 class="panel-title pull-left">Upload Passport - jpg / jpeg - <= 500kb - 250 X 250</h3>
					</div>
					<div class="file-tab panel-body">
						<label class="btn btn-default btn-file">
							<span>Browse</span>
							<!-- The file is stored here. -->
							<input type="file" name="image-file">
						</label>
						<button type="button" class="btn btn-default">Remove</button>
					</div>
				</div>
				<h4>Matriculation / Registration N<u>o</u> : <?php echo $_SESSION['regno'];?></h4>
				<hr/>
				<h4>Email Address : <?php echo $_SESSION['email_id'];?></h4>
				<hr/>
				<h4>Application ID : <span style="color:red;"><b><?php echo $_SESSION['app_id'];?></b></span></h4>
				<hr/>
				<!-- ends copy bootstrap-imageupload. -->
				<script src="settings/js/bootstrap-imageupload.js"></script>
				<script>
					var $imageupload = $('.imageupload');
					$imageupload.imageupload();
					$('#my-imageupload').imageupload({
						allowedFormats: [ 'jpg','jpeg' ],
						maxFileSizeKb: 500,
						maxWidth: auto,
						maxHeight: 250
					});
				</script>
				<div class="form-group">
					<label for="txtPasswordC2"> Tile: </label>
					<select class="form-control" name="txttitle">
						<option value="<?php echo $txttitle; ?>" ><?php echo $txttitle; ?></option>
						<option value="Mr.">Mr.</option>
						<option value="Mrs.">Mrs.</option>
						<option value="Miss.">Miss.</option>
					</select>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2">First Name : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<input type="text" class="form-control" onkeypress="wipeboxeror('4')" id="txtfname" name="txtfname" value="<?php  echo $txtfname;?>" required="true" placeholder="Enter Your First Name" />
					</div>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2">Other Name : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<input type="text" class="form-control" onkeypress="wipeboxeror('4')" id="txtoname" name="txtoname" value="<?php echo $txtoname;?>" required="true" placeholder="Enter Other Names " />
					</div>
				</div>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<div class="form-group">
					<label for="txtPhone">Main Phone N<u>o</u> : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<input type="text" class="form-control" onkeydown="return noNumbers(event,this)" id="txtPhone" name="txtPhone" value="<?php echo $txtPhone;?>" required="true" placeholder="Enter Main Phone No" />
					</div>
				</div>
				<div class="form-group">
					<label for="txtAPhone">Alternative Phone N<u>o</u> <span style="color:red">(Optional)</span> : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<input type="text" class="form-control" onkeydown="return noNumbers(event,this)" id="txtAPhone" name="txtAPhone" value="<?php  echo $txtAPhone;?>"  placeholder="Enter Alternative Phone No" />
					</div>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2"> Gender: </label>
					<select class="form-control" name="txtgender">
						<option value="<?php echo $txtgender; ?>" ><?php echo $txtgender; ?></option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2"> Religion : </label>
					<select class="form-control" name="txtreligion">
						<option value="<?php echo $txtreligion; ?>" ><?php echo $txtreligion; ?></option>
						<option value="Islam">Islam</option>
						<option value="Christianity">Christianity</option>
						<option value="Others">Others</option>
					</select>
				</div>
				<!-- <div class="form-group">
					<label for="txtPasswordC2"> Nationality: </label>
					<select class="form-control" name="txtnationality">
						<option value="Select Nationality">Select Nationality</option>
						<option value="Nigerian">Nigerian</option>
						<option value="Others">Others</option>
					</select>
				</div> -->
				<div class="form-group">
					<label for="txtPasswordC2"> State: </label>
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
					<label for="txtPasswordC2"> Local Government: </label>
					<select class="form-control" id="cmblgov" name="txtlgov">
						<option value="<?php echo $txtlgov; ?>" ><?php echo $txtlgov; ?></option>
					</select>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2">Permanent Address : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<textarea class="form-control"  rows="2" id="txtPermadd" name="txtPermadd" required="true" placeholder="Enter Permanent Address">
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
					<label for="txtPasswordC2">Residensial Address : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<textarea class="form-control" rows="2" id="txttempadd" name="txttempadd" required="true" placeholder="Enter Residensial Address">
							<?php echo $txttempadd;?>
						</textarea>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<div class="form-group">
					<label for="txtPasswordC2"> Faculty : </label> 
					<select class="form-control" name="txtfaculty" id="faculty" onchange="schoolComboChange();">    
						<option value="<?php echo $txtfaculty; ?>" ><?php echo $txtfaculty; ?></option>
						<option value="Agriculture">Agriculture</option>
						<option value="Bussiness Studies">Bussiness Studies</option>
						<option value="Engineering">Engineering</option>
						<option value="Environmental Studies">Environmental Studies</option>
						<option value="Science">Science</option>
					</select>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2"> Department : </label>
					<select class="form-control" id="department" name="txtdept">
						<option value="<?php echo $txtdept; ?>" ><?php echo $txtdept; ?></option>
					</select>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2"> Mode Of Entrance : </label>
					<select class="form-control" name="txtentrance">
						<option value="<?php echo $txtentrance; ?>" ><?php echo $txtentrance; ?></option>
						<option value="Utme">Utme</option>
						<option value="DEntry">DEntry</option> 
					</select>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2" > Mode Of Study: </label>
					<select class="form-control" name="txtmodestudy">
						<option value="<?php echo $txtmodestudy; ?>" ><?php echo $txtmodestudy; ?></option>
						<option value="Full Time">Full Time</option>
						<option value="Part Time">Part Time</option>
					</select>
				</div>
				<div class="form-group">
					<label for="txtPasswordC2" > Award in View : </label>
					<select class="form-control" name="txtaward">
						<option value="<?php echo $txtaward; ?>" ><?php echo $txtaward; ?></option>
						<option value="Diploma">Diploma</option>
						<option value="Degree">Degree</option>
						<option value="Ijmb">Ijmb</option>
					</select>
				</div>
				<div class="form-group">
					<label for="txtduration">Course Duration (Years) : </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<input type="text" onkeydown="return noNumbers(event,this)" class="form-control" id="txtduration" name="txtduration" value="<?php echo $txtduration;?>" required="true" placeholder="Enter Alternative Phone No" />
					</div>
				</div>
				<div class="form-group">
					<label for="txtent"> Year Of Entry (YYYY): </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<input type="text" onkeydown="return noNumbers(event,this)" class="form-control" id="txtent" name="txtent" value="<?php  echo $txtent;?>" required="true" placeholder="Enter Year of Admission" />
					</div>
				</div>
				<div class="form-group">
					<label for="txtexit"> Year of Exit (YYYY): </label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
						<input type="text" onkeydown="return noNumbers(event,this)" class="form-control" onkeypress="wipeboxeror('4')" id="txtexit" name="txtexit" value="<?php  echo $txtexit;?>" required="true" placeholder="Enter Year of Graduation" />
					</div>
					<span class="help-block" id="result4" style="color:brown;text-weight:bold;text-align:center;"><?php echo $err;?></span>
				</div>
				<div class="form-group pull-right">
					<div class="input-group">
						<input type="submit" name="submit" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Submit Application" class="btn btn-primary btn-md"></input>
					</div>
					
				</div>
			</div>
		</form>
	</div>

	<div class="row" style="font-weight:bold;background-color:#CCCCFF;padding:10px 5px 10px 5px">
		<?php
			require_once 'settings/comment.php';
		?>
	</div>
		<?php require_once 'settings/footer_file.php';?>
		
 </div>
</body>
</html>  

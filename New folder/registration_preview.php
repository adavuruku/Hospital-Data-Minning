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



$txtexit=$txtent=$txtduration=$txtaward=$txtmodestudy=$txtentrance=$txtdept=$txtfaculty=$txttempadd=$txtlgov=$txtPermadd =$txtstate=$txtnationality=$txtreligion=$txtgender=$txtAPhone=$txtPhone=$txtoname=$txtfname=$txttitle="";


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
		//update record
		$stmt = $conn->prepare("UPDATE student_info SET sstatus = ?, sregdate=now() where sregno=? or sappid=? Limit 1");
		if($stmt->execute(array("1", $_SESSION['regno'], $_SESSION['app_id']
		))){
			//insert to staff record
				$sth = $conn->prepare ("INSERT INTO app_status (appid) VALUES (?)");	
				$sth->bindValue (1, $_SESSION['app_id']);
				if($sth->execute()){
					//redirect to home page
					$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
					$sec="Act_Me";
					header("location: student_account.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
				}
		}else{
				$err = $errPL = "Unable to Save and Preview Your Application.. Please Verify Your Entries to Ensure they are all Provided !!";
				$notice_msg='<div class="alert alert-danger alert-dismissable">
						   <button type="button" class="close" data-dismiss="alert" 
							  aria-hidden="true">
							  &times;
						   </button>'.$errPL.' </div>';
		
		}
}
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['edit']))
{
	//redirect to home page
	$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
	$sec="Act_Me";
	header("location: complete_application.php?m_=".$_SESSION['page_authy']."&l_w=".$sec);
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
					<div class="file-tab panel-body">
						<img  style="height:200px" class="img-responsive img-thumbnail" src="resource/<?php echo $_SESSION['app_id'].'.jpg';?>"> </img>
					</div>
				</div>
				<h4>Applicanr Name : </h4>
				<h4><span><b><?php echo $txttitle." ".$txtfname." ".$txtoname;?></b></span></h4>
				<hr/>
				<h4>Matriculation / Registration N<u>o</u> :<?php echo $_SESSION['regno'];?></h4>
				<hr/>
				<h4>Email Address : <?php echo $_SESSION['email_id'];?></h4>
				<hr/>
				<h4>Application ID : <span style="color:red;"><b><?php echo $_SESSION['app_id'];?></b></span></h4>
				<hr/>
				<h4>Main Phone N<u>o</u> : <span><b><?php echo $txtPhone;?></b></span></h4>
				<hr/>
				
			</div>
				<!-- ends copy bootstrap-imageupload. -->
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<h4>Alternative Phone N<u>o</u> : <span><b><?php echo $txtAPhone;?></b></span></h4>
				<hr/>
				<h4>Gender : <span><b><?php echo $txtgender;?></b></span></h4>
				<hr/>
				<h4>Religion : <span><b><?php echo $txtreligion;?></b></span></h4>
				<hr/>
				<h4>Nationality : <span><b>Nigerian</b></span></h4>
				<hr/>
				<h4>State : <span><b><?php echo $txtstate;?></b></span></h4>
				<hr/>
				<h4>Local Government : <span><b><?php echo $txtlgov;?></b></span></h4>
				<hr/>
				<h4>State : <span><b><?php echo $txtstate;?></b></span></h4>
				<hr/>
				<h4>Permanent Address : </h4>
				<h4><span><b><?php echo $txtPermadd;?></b></span></h4>
				<hr/>
				<h4>Residensial Address : </h4>
				<h4><span><b><?php echo $txttempadd;?></b></span></h4>
				<hr/>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<h4>Faculty : <span><b><?php echo $txtfaculty;?></b></span></h4>
				<hr/>
				<h4>Department : <span><b><?php echo $txtdept;?></b></span></h4>
				<hr/>
				<h4>Mode Of Entrance : <span><b><?php echo $txtentrance;?></b></span></h4>
				<hr/>
				<h4>Mode Of Study : <span><b><?php echo $txtmodestudy;?></b></span></h4>
				<hr/>
				<h4>Award in View : <span><b><?php echo $txtaward;?></b></span></h4>  
				<hr/>
				<h4>Course Duration (Years) : <span><b><?php echo $txtduration." Years.";?></b></span></h4>
				<hr/>
				<h4>Year Of Entry (YYYY) : <span><b><?php echo $txtent;?></b></span></h4>
				<hr/>
				<h4>Year Of Exit (YYYY) : <span><b><?php echo $txtexit;?></b></span></h4>
				<hr/>
				<div class="form-group pull-left">
					<div class="input-group">
						<input type="submit" name="edit" style="margin-bottom:10px;padding:5px 20px 5px 20px" value="Edit Application" class="btn btn-warning btn-md"></input>
					</div>
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

<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$sec="Act_Me";$err=$notice_msg=$er_msg=$er_msg2=$msg2=$msg="";

if(!isset($_SESSION['staff_id']) || !isset($_SESSION['staff_name'])){
	header("location: index.php");
}
$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
$link ="0";
if(!isset($_GET['m_']) || !isset($_GET['l_w'])){
		header("location: index.php");
}
if($_GET['m_'] != $_SESSION['page_authy'] || $_GET['l_w'] != $sec ){
	header("location index.php");
}

		

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
				<?php 
				$stmt_in = $conn->prepare("SELECT * FROM staff_record where staff_id=? Limit 1");
				$stmt_in->execute(array($_SESSION['staff_id']));
				$affected_rows_in = $stmt_in->rowCount();
				if($affected_rows_in >= 1) 
				{	
					$row = $stmt_in->fetch(PDO::FETCH_ASSOC);
					echo '<table class="table table-condensed">
							<thead style="background-color:grey;color:white;font-size:20px">
								<th>
									<td colspan="2" align="left"> STAFF RECORD</td>
								</th>
							</thead>
							<tbody style="background-color:none;color:none;font-size:20px">
								<tr>
									<td align="left" width="150px">Staff Name : </td>
									<td align="left">'.$row['staff_name'].'</td>
								</tr>
								<tr><td colspan="2"></td></tr>
								<tr>
									<td align="left">Staff ID No : </td>
									<td align="left">'.$row['staff_id'].'</td>
								</tr>
								<tr>
									<td align="left">Email ID : </td>
									<td align="left">'.$row['staff_email'].'</td>
								</tr>
								<tr><td colspan="2"></td></tr>
								<tr>
									<td align="left">Phone No : </td>
									<td align="left">'.$row['staff_phone'].'</td>
								</tr>
								<tr>
									<td align="left">State : </td>
									<td align="left">'.$row['staff_state'].'</td>
								</tr>
								<tr>
								<td colspan="2"></td></tr>
								<tr>
									<td align="left">Local Gov\'t : </td>
									<td align="left">'.$row['staff_lgov'].'</td>
								</tr>
								<tr>
									<td align="left">Department : </td>
									<td align="left">'.$row['staff_dept'].'</td>
								</tr>
								<tr><td colspan="2"></td></tr>
								<tr>
									<td align="left">Gender : </td>
									<td align="left">'.$row['staff_gender'].'</td>
								</tr>
								<tr style="background-color:grey;color:white;text-align:center;font-size:20px">
									<td colspan="2" > &copy; 2017</td>
								</tr>
							</tbody>
						</table>';			
				}else{
					header("location index.php");
				}	
				?>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-print" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
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

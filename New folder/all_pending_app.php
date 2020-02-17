<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$sec="Act_Me";$err=$notice_msg=$er_msg=$er_msg2=$msg2=$msg="";
$_SESSION['page_authy'] = SHA1("W@YERADAVURUKUSTAS#YUR");
$link ="0";
if(!isset($_GET['m_']) || !isset($_GET['l_w'])){
		header("location index.php");
}
if($_GET['m_'] != $_SESSION['page_authy'] || $_GET['l_w'] != $sec ){
	header("location index.php");
}

//update
if(isset($_GET['appid']) && isset($_GET['opr'])){
	$status ="0";
	$app_id = strip_tags(htmlspecialchars_decode($_GET['appid']));
	if($_GET['opr'] =="approve"){
		$status = "1"; 
	}elseif($_GET['opr'] =="disapprove"){
		$status = "0";
	}elseif($_GET['opr'] =="reject"){
		$status = "2";
	}
	$stmt_ina="";
	if($_SESSION['clearance_section'] =="Library"){
		$stmt_ina = $conn->prepare("UPDATE app_status SET library = ?, libraryDate = now() where appid =? limit 1");
	}
	//store
	if($_SESSION['clearance_section'] =="Bursary"){
		$stmt_ina = $conn->prepare("UPDATE app_status SET store = ?, storeDate = now() where appid =? limit 1");
	}
	//hostel
	if($_SESSION['clearance_section'] =="Hostel"){
		$stmt_ina = $conn->prepare("UPDATE app_status SET hostel = ?, hostelDate = now() where appid =? limit 1");
	}
	//athlete
	if($_SESSION['clearance_section'] =="Sports"){
		$stmt_ina = $conn->prepare("UPDATE app_status SET athlete = ?, athleteDate = now() where appid =? limit 1");
	}
	//sug
	if($_SESSION['clearance_section'] =="SUG"){
		$stmt_ina = $conn->prepare("UPDATE app_status SET sug = ?, sugDate = now() where appid =? limit 1");
	}
	//security
	if($_SESSION['clearance_section'] =="Security"){
		$stmt_ina = $conn->prepare("UPDATE app_status SET security = ?, securityDate = now() where appid =? limit 1");
	}
	if($_SESSION['clearance_section'] =="Faculty"){
		$stmt_ina = $conn->prepare("UPDATE app_status SET faculty = ? , facultyDate = now()where appid =? limit 1");
	}
	if($_SESSION['clearance_section'] =="Department"){
		$stmt_ina = $conn->prepare("UPDATE app_status SET department = ?, departmentDate = now()  where appid =? limit 1");
	}
	$stmt_ina->execute(array($status,$app_id));
}

$my_file_two =$stmt_ina= $stmt_inaa="";
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
		<div class="imageupload panel panel-info">
			<div class="panel-heading clearfix">
				<h3 class="panel-title pull-left">Welcome - <?php echo $_SESSION['staff_name']; ?> , To Staff Dashboard !!</h3>
			</div>
		</div>
		<!-- middle content ends here where vertical nav slides and news ticker ends -->
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<!-- Start list. -->
				<?php
				$my_file_two =$stmt_ina= $stmt_inaa="";
					$status="0";
				
					//library
					if($_SESSION['clearance_section'] =="Library"){
						$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.library =?");
						$stmt_inaa = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.library =?");
						$stmt_ina->execute(array("0"));
						$stmt_inaa->execute(array("0"));
					}
					//store
					if($_SESSION['clearance_section'] =="Bursary"){
						$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.store =?");
						$stmt_inaa = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.store =?");
						$stmt_ina->execute(array("0"));
						$stmt_inaa->execute(array("0"));
					}
					//hostel
					if($_SESSION['clearance_section'] =="Hostel"){
						$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.hostel =?");
						$stmt_inaa = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.hostel =?");
						$stmt_ina->execute(array("0"));
						$stmt_inaa->execute(array("0"));
					}
					//athlete
					if($_SESSION['clearance_section'] =="Sports"){
						$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.athlete =?");
						$stmt_inaa = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.athlete =?");
						$stmt_ina->execute(array("0"));
						$stmt_inaa->execute(array("0"));
					}
					//sug
					if($_SESSION['clearance_section'] =="SUG"){
						$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.sug =?");
						$stmt_inaa = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.sug =?");
						$stmt_ina->execute(array("0"));
						$stmt_inaa->execute(array("0"));
					}
					//security
					if($_SESSION['clearance_section'] =="Security"){
						$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.security =?");
						$stmt_inaa = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where app_status.security =?");
						$stmt_ina->execute(array("0"));
						$stmt_inaa->execute(array("0"));
					}
					if($_SESSION['clearance_section'] =="Faculty"){
						$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where student_info.sfaculty =?  and  app_status.faculty =?");
						$stmt_inaa = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where student_info.sfaculty =?  and  app_status.faculty =?");
						$stmt_ina->execute(array($_SESSION['staff_faculty'],"0"));
						$stmt_inaa->execute(array($_SESSION['staff_faculty'],"0"));
					}
					if($_SESSION['clearance_section'] =="Department"){
						$stmt_ina = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where student_info.sdept =?  and  app_status.department =?");
						$stmt_inaa = $conn->prepare("SELECT * FROM app_status INNER JOIN student_info on  app_status.appid = student_info.sappid where student_info.sdept =?  and  app_status.department =?");
						$stmt_ina->execute(array($_SESSION['staff_dept'],"0"));
						$stmt_inaa->execute(array($_SESSION['staff_dept'],"0"));
					}
					$affected_rows_in = $stmt_ina->rowCount();
					if($affected_rows_in >= 1) 
					{
						while($row_two = $stmt_ina->fetch(PDO::FETCH_ASSOC))
						{
							$date500 = new DateTime($row_two['sregdate']);
							$J = date_format($date500,"D");
							$Q = date_format($date500,"d-F-Y, h:i:s A");
							$dateprint_V = $J.", ".$Q;
							$dateprint = $J.", ".$Q;	
							$nameAll = $row_two['stitle']." ".$row_two['sfirstname']." ".$row_two['sothername'];
							$id_link =" id=".'"'.$row_two['sappid'].'"';
							echo '<div style="width:70%; margin:auto;" '.$id_link.' class="modal fade">
									<div style="width:100%;" class="modal-dialog">
										<div style="width:100%;" class="modal-content">
											<div class="modal-header label-primary">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title" style="color:yellow;">'.$nameAll.' Profile</h4>
											</div>
											<div style="width:100%;" class="modal-body">
											<table class="table table-condensed">
											<tbody>
												<tr>
													<td align="center"><img  style="height:150px" class="img-responsive" src="resource/'.$row_two['appid'].'.jpg'.'"/></td>
													
													<td><br/><br/><br/><h4 style="text-align:center"><a href=all_pending_app.php?m_='.$_SESSION['page_authy'].'&appid='.$row_two['appid'].'&l_w='.$sec.'&opr='."approve".'><span class="btn btn-primary">Approve Application</span></a></h4></td>
													
													<td><br/><br/><br/><h4 style="text-align:center"><a href=all_pending_app.php?m_='.$_SESSION['page_authy'].'&appid='.$row_two['appid'].'&l_w='.$sec.'&opr='."disapprove".'><span class="btn btn-warning">Disapprove Application</span></a></h4></td>
													
													<td><br/><br/><br/><h4 style="text-align:center"><a href=all_pending_app.php?m_='.$_SESSION['page_authy'].'&appid='.$row_two['appid'].'&l_w='.$sec.'&opr='."reject".' ><span class="btn btn-danger">Reject Application</span></a></h4></td>
												</tr>
												<tr>
													<td><h4>Applicant Name : </h4></td>
													<td><h4><span><b>'.$nameAll.'</b></span></h4></td>
													<td><h4>Matriculation / Registration N<u>o</u> :</h4></td>
													<td><h4><span><b>'.$row_two['sregno'].'</b></span></h4></td>
												</tr>
												<tr>
													<td><h4>Faculty :  </h4></td>
													<td><h4><span><b>'.$row_two['sfaculty'].'</b></span></h4></td>
													<td><h4>Department : </h4></td>
													<td><h4><span><b>'.$row_two['sdept'].'</b></span></h4></td>
												</tr>
												<tr>
													<td><h4>Gender : </h4></td>
													<td><h4><span><b>'.$row_two['sgender'].'</b></span></h4></td>
													<td><h4>Email Address :</h4></td>
													<td><h4><span><b>'.$row_two['semail'].'</b></span></h4></td>
												</tr>
												<tr>
													<td><h4>Phone N<u>o</u> : </h4></td>
													<td><h4><span><b>'.$row_two['sphonemain'].'</b></span></h4></td>
													<td><h4>Alternative Phone N<u>o</u> :</h4></td>
													<td><h4><span><b>'.$row_two['sphonealt'].'</b></span></h4></td>
												</tr>
												<tr>
													<td><h4>Mode Of Entrance : </h4></td>
													<td><h4><span><b>'.$row_two['smodeent'].'</b></span></h4></td>
													<td><h4>Mode Of Study :</h4></td>
													<td><h4><span><b>'.$row_two['smodestudy'].'</b></span></h4></td>
												</tr>
												<tr>
													<td><h4>Award in View : </h4></td>
													<td><h4><span><b>'.$row_two['sawardview'].'</b></span></h4></td>
													<td><h4>Course Duration (Years) :</h4></td>
													<td><h4><span><b>'.$row_two['scoursedur'].' Years.</b></span></h4></td>
												</tr>
												<tr>
													<td><h4>Year Of Entry (YYYY) : </h4></td>
													<td><h4><span><b>'.$row_two['syearent'].'</b></span></h4></td>
													<td><h4>Year Of Exit (YYYY) :</h4></td>
													<td><h4><span><b>'.$row_two['syearexit'].'</b></span></h4></td>
												</tr>
												<tr>
													<td ><h4>Application ID :  </h4></td>
													<td><h4><span><b>'.$row_two['appid'].'</b></span></h4></td>
													<td ><h4>Application Date :  </h4></td>
													<td><h4><span><b>'.$dateprint.'</b></span></h4></td>
												</tr>
											</tbody>
										</table>
										</div>	
										<div class="modal-footer label-primary">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
						</div>';
						}
						echo '<p id="process" style="color:blue;text-align:center;"></p>
						<a class="text-right" style="text-decoration:none;color:black;" target="_blank" href=all_pending_print.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'><h4><span class="glyphicon glyphicon-print" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Print</h4></a>
						<table class="table table-condensed" style="background-color:#FFFFFF;margin-top:5px">
								<thead style="background-color:none;color:blue">
									<tr>
										<th>S/N<u>o</u>.</th>
										<th>Applicant Name</th>
										<th>Applicant Reg N<u>o</u></th>
										<th >Clearance ID</th>
										<th ></th>
									</tr>
								</thead>
								<tbody>';
							$j=1;$data="";
							
							while($row_two1 = $stmt_inaa->fetch(PDO::FETCH_ASSOC))
							{
								$path_two = "href=".'"#'.$row_two1['sappid'].'"'; 
								
								$nameAll = $row_two1['stitle']." ".$row_two1['sfirstname']." ".$row_two1['sothername'];
								$data=$data.'<tr >
												<td>'.$j.'</td> 	
												<td>'.$nameAll.'</td>
												<td>'.$row_two1['sregno'].'</td>
												<td>'.$row_two1['appid'].'</td>
												<td><p style="color:yellow;cursor:pointer;text-align:center;font-weight:900;background-color:grey;padding:5px;" '.$path_two.' data-toggle="modal"> View Details </p></td>
										</tr>';
								$j=$j + 1;
							}
							echo $data.'</tbody></table><a class="text-right" style="text-decoration:none;color:black;" target="_blank" href=all_pending_print.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'> <h4><span class="glyphicon glyphicon-print" style="cursor:pointer;text-align:center;font-weight:900;padding:5px;"></span>Print</h4></a>';
					}else{
						echo '<div class="alert alert-info alert-dismissable">
								   <button type="button" class="close" data-dismiss="alert" 
									  aria-hidden="true">
									  &times;
								   </button><h3>There is no more Pending Clearance Application ..</h3></div>';
					}
				?>
				<!-- End list. -->
			</div>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" style="margin-bottom:10px;margin-top:10px;text-align:centre;padding-top:10px">
				<div id="accordion" class="panel-group">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title ">
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> My Menu </a>
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="glyphicon glyphicon-chevron-down pull-right"></a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="list-group">
								
								<?php	
									echo '
									<a style="color:black;text-weight:bold;" class="list-group-item" href="staff_account_home.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
										<span class="glyphicon glyphicon-home"></span> My Account Home <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
									</a>
									<a style="color:red;text-weight:bold;" class="list-group-item" href="all_pending_app.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&statuscheck='."check".'" >
										<span class="glyphicon glyphicon-pencil"></span> View All Pending Application <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
									</a>
										<a style="color:black;text-weight:bold;" class="list-group-item"  href="all_rejected_app.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
											<span class="glyphicon glyphicon-list"></span> View All Rejected Application <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
										</a>
									<a style="color:black;text-weight:bold;" class="list-group-item" href="all_approved_app.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
										<span class="glyphicon glyphicon-list"></span> View All Approved Applications <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
									</a>
									
									<a href="staff_login.php" class="list-group-item">
										<span class="glyphicon glyphicon-log-out"></span> Log Out  <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
									</a>';
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
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

<?php
session_start();
require_once 'settings/all_header.php';
require_once 'settings/connection.php';
$errPL=$regno=$txtEmail="";
if(!isset($_SESSION['app_id'])){
	header("location: index.php");
}
$date500 = new DateTime("Now");
$J = date_format($date500,"D");
$Q = date_format($date500,"d-F-Y, h:i:s A");
$dateprint_V = $J.", ".$Q;
$dateprint = "Printed On: ".$J.", ".$Q;	
?>
<script type="text/javascript">
	//$(document).ready(function(){
	//	$("#myModal").modal('show');		
	//});
</script>
</head>
<body style="width:80%;margin:auto">
<div class="container-fluid" >
		<div class="row">
			<?php
				require_once 'settings/nav_top.php';
			?> 
		</div>
	
	<!-- middle content starts here where vertical nav slides and news ticker statr -->
	<div class="row">
		<!-- middle content ends here where vertical nav slides and news ticker ends -->
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 hidden-print" style="vertical-spacing:3px;word-spacing:3px;line-height:150%;background-color:#CCCCFF;text-align:justify">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 style="font-weight:bold;background-color:grey;color:white;padding:10px 5px 10px 5px"> About Online Clearance System <h4/>
				<hr/>
				<p style="">Online clearance system is a research work that will help build an effective information management for schools. It is aimed at developing a system for making clearance after graduation hitch free. The designed software will serve as a more reliable and effective means of undertaking students clearance, remove all forms of delay and stress as well as enable you understand the procedures involved as well as how to do your clearance online.</p>
				<p> This project work made use of data collected from the University, materials and journals from various authors and software was developed to effectively achieve the aims of this project...<a class="btn btn-success"href="#">Read more</a></p>
			</div>
			
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4 style="font-weight:bold;background-color:grey;color:white;padding:10px 5px 10px 5px"> Brief Outlines <h4/>
				<hr/>
				<p>The process of clearing students after their graduation required that students be cleared in various departments and information units.<br/>
				Among which are :
				<ol>
					<li>Library fine (Which include Overdue or Lost Library Materials)</li>
					<li>Departmental Dues (Which include all the Departmental Association dues and other Departmental mandatory dues)</li>
					<li>Faculty Dues (Which include all the Faculty Association dues and other Faculty mandatory dues)</li>
					<li>Information and book store charges</li>
					<li>Residence Hall Charges (Rental, Damage and Maintenance Charges among others)</li>
					<li>Return of Athletic Equipments</li>
					<li>Student Union Fine</li>
				</ol>
				</p>
				<p> At each clearance section a staff is assigned the duty to access the students application for clearance and either clear the students for further processing after which the student can now print the clearance acknowledgement slip which will then be forwarded to their respective Faculties...<a class="btn btn-success" href="#">Read more</a></p>
				<h4 style="font-weight:bold;background-color:grey;color:white;padding:10px 5px 10px 5px"><h4/>
			</div>
		</div>
		<!-- 
		 <div class="hidden-print">content for non print</div> 
		 <div class="visible-print">content for print only</div>
		 -->
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;margin-top:10px;text-align:centre">
			<hr/>
				<h4 style="margin-bottom:20px;background-color:#CCFF33;padding:10px">APPLICATION ID DETAILS </h4> 
				<p class="hidden-print"><span onClick="window.print();" class="btn btn-primary">Click To Print</span></p>
			<hr/>
				
				<h4>Matriculation / Registration N<u>o</u> : <?php echo $_SESSION['regno'];?></h4>
				<hr/>
				<h4>Email Address : <?php echo $_SESSION['email_id'];?></h4>
				<hr/>
				<h4>Application ID : <span style="color:red;"><?php echo $_SESSION['app_id'];?></span></h4>
				<hr/>
				<p>- <?php echo $dateprint;?> - </p>
				<hr/>
				<div class="pull-Right hidden-print">
						<p><a href="login_to_profile.php"><span class="btn btn-primary">Proceed to Complete Application</span></a></p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 hidden-print" style="margin-bottom:10px;margin-top:10px;background-color:grey;text-align:centre">
				<hr/>
					<p class="hidden-print" style="text-align:center"><a href=""><span class="btn btn-primary">Generate application ID</span></a> | <a href="login_to_profile.php"><span class="btn btn-info">Complete Application</span></a> | <a href="login_status.php"><span class="btn btn-success">Check Application Status</span></a></p>
				<hr/>
			</div>
		</div>
	</div>
	
	<div class="row hidden-print" style="font-weight:bold;background-color:#CCCCFF;padding:10px 5px 10px 5px">
		<?php
			require_once 'settings/comment.php';
		?>
	</div>
		<?php require_once 'settings/footer_file.php';?>
	<div class="row clearfix label-primary visible-print" style="margin-top:0px;">
		<footer style="margin-top:15px">
			<h4 style="text-align:center;color:white;">Copyright &copy; 2017 - 	Delta State </h4>
		</footer>
	</div>
 </div>
</body>
</html>  

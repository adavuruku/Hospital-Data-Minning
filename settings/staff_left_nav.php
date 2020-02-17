<?php
?>
<div class="panel panel-primary no-print">
	<div style="color:white;" class="panel-body label-primary" >
		<h5 ><b>My Menu</b></h5>						
	</div> 
	<div class="panel-footer clearfix">
	<div id="accordion" class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title ">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> Register </a>
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="glyphicon glyphicon-chevron-down pull-right"></a>
				</h4>
			</div>
			<div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="list-group">
					
					<?php
					echo '<a style="color:blue;text-weight:bold;" class="list-group-item" href="staff_account_home.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&statuscheck='."check".'" >
							<span class="glyphicon glyphicon-home"></span> My Account Home <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
						</a>';
					if($_SESSION['work_ryt'] =="1" || $_SESSION['work_ryt'] =="2"){
						echo '<a style="color:red;text-weight:bold;" class="list-group-item" href="create_new_staff.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&statuscheck='."check".'" >
							<span class="glyphicon glyphicon-pencil"></span> New Staff Record <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
						</a>
						<a style="color:black;text-weight:bold;" class="list-group-item"  href="create_new_patient.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
								<span class="glyphicon glyphicon-pencil"></span> New Patient Record <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
							</a>
						<a style="color:black;text-weight:bold;" class="list-group-item" href="create_treatment_record.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
							<span class="glyphicon glyphicon-pencil"></span> Register Treatment Record <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
						</a>
						<a style="color:black;text-weight:bold;" class="list-group-item"  href="register_admitted_patient.php.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
								<span class="glyphicon glyphicon-log-out"></span> Register Patient For Admission <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
							</a>
						<a style="color:black;text-weight:bold;" class="list-group-item"  href="discharge_patient.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
								<span class="glyphicon glyphicon-log-out"></span> Check Out Admitted Patient <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
							</a>';
						}
							echo '<a href="index.php" class="list-group-item">
							<span class="glyphicon glyphicon-log-out"></span> Log Out  <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
						</a>';
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Left two Edit -->
	<?php
	if($_SESSION['work_ryt'] =="1"){
	?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title ">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> Edit Record </a>
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="glyphicon glyphicon-chevron-down pull-right"></a>
				</h4>
			</div>
			<div id="collapseTwo" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="list-group">
					<?php	
						echo '<a style="text-weight:bold;" class="list-group-item" href="edit_staff_record.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&statuscheck='."check".'" >
							<span class="glyphicon glyphicon-edit"></span> Edit Staff Record <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
						</a>
							<a style="color:black;text-weight:bold;" class="list-group-item"  href="update_patience_record.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
								<span class="glyphicon glyphicon-edit"></span> Edit Patient Record <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
							</a>
						<a style="color:black;text-weight:bold;" class="list-group-item" href="edit_treatment_record.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
							<span class="glyphicon glyphicon-edit"></span> Edit Treatment Record <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
						</a>';
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title ">
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"> Print Reports </a>
					<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="glyphicon glyphicon-chevron-down pull-right"></a>
				</h4>
			</div>
			<div id="collapseThree" class="panel-collapse collapse">
				<div class="panel-body">
					<div class="list-group">
					<?php	
						echo '<a style="text-weight:bold;" class="list-group-item" target="_blank" href="all_staff_list.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'&statuscheck='."check".'" >
							<span class="glyphicon glyphicon-print"></span> View / Print Staff List <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
						</a>
							<a style="color:black;text-weight:bold;" class="list-group-item"  href="print_patient_record.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
								<span class="glyphicon glyphicon-print"></span> View / Generate Patient Reports <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
							</a>
						<a style="color:black;text-weight:bold;" class="list-group-item" href="treatment_report_generation.php?m_='.$_SESSION['page_authy'].'&l_w='.$sec.'">
							<span class="glyphicon glyphicon-print"></span> View / Generate Treatment Reports <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
						</a>';
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	?>
</div>
</div>
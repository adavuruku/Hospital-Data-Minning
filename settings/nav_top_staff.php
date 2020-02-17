<!-- A -->
		<?php
			$date = new DateTime();
			$current_timestamp = $date->getTimestamp();
		?>
		<script>
		    flag_time = true;
			timer = '';
			setInterval(function(){phpJavascriptClock();},1000);
			
			function phpJavascriptClock()
			{
				if ( flag_time ) {
				timer = <?php echo $current_timestamp;?>*1000;
				}
				var d = new Date(timer);
				months = new Array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');
				
				month_array = new Array('January', 'Febuary', 'March', 'April', 'May', 'June', 'July', 'Augest', 'September', 'October', 'November', 'December');
				
				day_array = new Array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
				
				currentYear = d.getFullYear();
				month = d.getMonth();
				var currentMonth = months[month];
				var currentMonth1 = month_array[month];
				var currentDate = d.getDate();
				currentDate = currentDate < 10 ? '0'+currentDate : currentDate;
				
				var day = d.getDay();
				current_day = day_array[day];
				var hours = d.getHours();
				var minutes = d.getMinutes();
				var seconds = d.getSeconds();
				
				var ampm = hours >= 12 ? 'PM' : 'AM';
				hours = hours % 12;
				hours = hours ? hours : 12; // the hour ’0′ should be ’12′
				minutes = minutes < 10 ? '0'+minutes : minutes;
				seconds = seconds < 10 ? '0'+seconds : seconds;
				var strTime = hours + ':' + minutes+ ':' + seconds + ' ' + ampm;
				timer = timer + 1000;
				/**document.getElementById("demo").innerHTML= currentMonth+' ' + currentDate+' , ' + currentYear + ' ' + strTime ;
				
				document.getElementById("demo1").innerHTML= currentMonth1+' ' + currentDate+' , ' + currentYear + ' ' + strTime ;
				
				document.getElementById("demo2").innerHTML= currentDate+':' +(month+1)+':' +currentYear + ' ' + strTime ;
				
				//document.getElementById("demo3").innerHTML= strTime ;**/
				
				document.getElementById("demo4").innerHTML= current_day + ' , ' +currentMonth1+' ' + currentDate+' , ' + currentYear + ' ' + strTime;
				flag_time = false;
			}

		</script>

<div  class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<img src="settings/images/headlogo.jpg"  class="img-responsive"></img>
			</div>
		
		<!-- navigation menu -->
		<div class="col-xs-12 col-sm-12">
			<nav role="navigation" class="navbar navbar-default">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header navedit">
				<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navedit">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				 <a href="index.php" class="navbar-brand">Sign Out</a>
			</div>
			<!-- Collection of nav links, forms, and other content for toggling -->
			<div id="navbarCollapse" class="collapse navbar-collapse navedit">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#"><?php echo $_SESSION['staff_id'];?></a></li>
				 </ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="#"><?php echo $_SESSION['staff_name'];?></a></li>
					<li class="active"><a id="demo4" href="#"></a></li>
				</ul>
			</div>
		</nav>
	</div>
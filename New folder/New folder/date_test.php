<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0, maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="Linee Classic World Management System">
<meta name="keywords" content="Fahion Design Linee Classic">
<meta name="author" content="Abdulraheem Sherif Adavuruku">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<title>Home | Delta State University </title>
<link rel="icon" href="settings/images/index.gif" type="image/x-icon" />
<link rel="shortcut icon" href="settings/images/index.gif" type="image/x-icon" /> <!-- Always do page picker like this-->

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
<script type="text/javascript" src="js/jquery-3.2.1.js"></script>

<link rel="stylesheet" type="text/css" href="plugins/css/bootstrap-datepicker.css" />
<link rel="stylesheet" type="text/css" href="plugins/css/bootstrap-datepicker3.css" />
<link rel="stylesheet" type="text/css" href="plugins/css/bootstrap-datepicker.min.css" />
<link rel="stylesheet" type="text/css" href="plugins/css/bootstrap-datepicker3.min.css" />
<script type="text/javascript" src="plugins/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="plugins/js/bootstrap-datepicker.min.js"></script>




<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-xs-4">
	<!-- date pivk -->
	<p>Input</p><br/>
	<div class="input-group date" data-provide="datepicker">
		<input type="text" class="form-control">
		<div class="input-group-addon">
			<span class="glyphicon glyphicon-th"></span>
		</div>
	</div><br/>
	<!-- date range -->
	<p>Component</p><br/>
	<div class="input-group date" data-provide="datepicker">
		<input type="text" class="form-control" value="12-02-2012">
		<div class="input-group-addon">
			<span class="glyphicon glyphicon-th"></span>
		</div>
	</div><br/>

	<!-- date range -->
	<p>Date Range</p><br/>
	<div class="input-group input-daterange">
		<input type="text" class="form-control" value="2012-04-05">
		<div class="input-group-addon">to</div>
		<input type="text" class="form-control" value="2012-04-19">
	</div><br/>
	<script type="text/javascript">
	$('.input-daterange input').each(function() {
		$(this).datepicker('clearDates');
	});
	</script>
	<!-- date range stop -->


</div>
</body>
</html>
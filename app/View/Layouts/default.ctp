<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title>Project Sparky</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Project Sparky - by Jordan Hatch">
	<meta name="author" content="Jordan Hatch">

	<!-- The styles -->
	
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>

	<?php
		echo $this->Html->css('bootstrap-classic.css') ."\n";
		echo $this->Html->css('bootstrap-responsive.css') ."\n";
		echo $this->Html->css('charisma-app.css') ."\n";
		echo $this->Html->css('jquery-ui-1.8.21.custom.css') ."\n";
		echo $this->Html->css('fullcalendar.css') ."\n";
		echo $this->Html->css('fullcalendar.print.css') ."\n";
		echo $this->Html->css('chosen.css') ."\n";
		echo $this->Html->css('uniform.default.css') ."\n";
		echo $this->Html->css('colorbox.css') ."\n";
		echo $this->Html->css('jquery.cleditor.css') ."\n";
		echo $this->Html->css('jquery.noty.css') ."\n";
		echo $this->Html->css('noty_theme_default.css') ."\n";
		echo $this->Html->css('elfinder.min.css') ."\n";
		echo $this->Html->css('elfinder.theme.css') ."\n";
		echo $this->Html->css('jquery.iphone.toggle.css') ."\n";
		echo $this->Html->css('opa-icons.css') ."\n";
		echo $this->Html->css('uploadify.css') ."\n";
		echo $this->Html->css('custom.css') ."\n";
		echo $this->Html->script('jquery-1.7.2.min')."\n";
	?>
	<!--<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/charisma-app.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='css/fullcalendar.css' rel='stylesheet'>
	<link href='css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='css/chosen.css' rel='stylesheet'>
	<link href='css/uniform.default.css' rel='stylesheet'>
	<link href='css/colorbox.css' rel='stylesheet'>
	<link href='css/jquery.cleditor.css' rel='stylesheet'>
	<link href='css/jquery.noty.css' rel='stylesheet'>
	<link href='css/noty_theme_default.css' rel='stylesheet'>
	<link href='css/elfinder.min.css' rel='stylesheet'>
	<link href='css/elfinder.theme.css' rel='stylesheet'>
	<link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='css/opa-icons.css' rel='stylesheet'>
	<link href='css/uploadify.css' rel='stylesheet'>-->

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
	<!--<script>
	function get_events(){
		var count = $.ajax({
		    type: "GET",
		    url: "/events/eventcount",
		    async: true
		}).complete(function(){
		    setTimeout(function(){get_events();}, 10000);
		}).responseText;
	    
		$('span#count').text(count);
	}
	$(document).ready(function(){
		get_events();	
	});
	</script>-->
	
	<script>
		$().ready(function(){
			$.ajax({
				dataType: "json",
				url: "/events/eventcount",
				data: { get_param: 'value' },
				success: function (data){
					$('span#count').text(data + " events recorded");
				}
			});
			
		});
	</script>
		
</head>

<body>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="/"><? echo $this->Html->image('sparkylogo.jpg', array('alt' => 'Project Sparky')); ?><span>Project Sparky</span></a>
				
				<div id="eventCount"><span id="count"></span></div>
				
				<!-- user dropdown starts -->
				<?php
					$loggedIn = $this->Session->read('Auth.User');
					if($loggedIn){

				?>
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $this->Session->read('Auth.User.username'); ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><?echo $this->Html->link('Logout', '/users/logout');?></li>
					</ul>
				</div>
				<?php
					}
				?>
				<!-- user dropdown ends -->
				
				
			</div>
		</div>
	</div>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<? if ($loggedIn){ ?><li><a class="ajax-link" href="/projects/index"><i class="icon-home"></i><span class="hidden-tablet"> Projects</span></a></li>
						<li><a class="ajax-link" href="/events/report"><i class="icon-th-list"></i><span class="hidden-tablet"> All Projects Report</span></a></li>
						<li><a class="ajax-link" href="/events/report/marketplace"><i class="icon-th-list"></i><span class="hidden-tablet"> Marketplace Projects Report</span></a></li>
						<li><a class="ajax-link" href="/events/report/kickstart"><i class="icon-th-list"></i><span class="hidden-tablet"> Kickstart Projects Report</span></a></li>
						<li><a class="ajax-link" href="/events/report/vertical"><i class="icon-th-list"></i><span class="hidden-tablet"> Vertical Projects Report</span></a></li>
						<li><a class="ajax-link" href="/events/report/other"><i class="icon-th-list"></i><span class="hidden-tablet"> Other Report</span></a></li>
						<li><a class="ajax-link" href="/events/globalreport"><i class="icon-th-list"></i><span class="hidden-tablet"> Global Event Report</span></a></li>
						<li><a class="ajax-link" href="/events/appusage?fromDate=<?php echo date('Y-m-d', strtotime('-1 month'));?>&toDate=<?php echo date('Y-m-d', strtotime('today'));?>&type=kickstart"><i class="icon-th-list"></i><span class="hidden-tablet"> App Usage Report</span></a></li>
						<? } ?>
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			<!-- content starts -->
			

			
			
			
			<div class="row-fluid">

				<?php //echo $this->Session->flash(); ?>

				<?php echo $this->fetch('content'); ?>

			</div>
					
			
				  

		  
       
					<!-- content ends -->
			</div><!--/#content.span10-->
				</div><!--/fluid-row-->
				
		<hr>

		<div class="modal hide fade" id="myModal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">?</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary">Save changes</a>
			</div>
		</div>

		<footer>
			<p class="pull-left">&copy; <a href="http://usman.it" target="_blank">Infusionsoft</a> 2013</p>
			
		</footer>
		
	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<?php
		echo $this->Html->script('jquery-1.7.2.min')."\n";
		echo $this->Html->script('jquery-ui-1.8.21.custom.min')."\n";
		echo $this->Html->script('bootstrap-transition')."\n";
		echo $this->Html->script('bootstrap-alert')."\n";
		echo $this->Html->script('bootstrap-modal')."\n";
		echo $this->Html->script('bootstrap-dropdown')."\n";
		echo $this->Html->script('bootstrap-scrollspy')."\n";
		echo $this->Html->script('bootstrap-tab')."\n";
		echo $this->Html->script('bootstrap-tooltip')."\n";
		echo $this->Html->script('bootstrap-popover')."\n";
		echo $this->Html->script('bootstrap-button')."\n";
		echo $this->Html->script('bootstrap-collapse')."\n";
		echo $this->Html->script('bootstrap-carousel')."\n";
		echo $this->Html->script('bootstrap-typeahead')."\n";
		echo $this->Html->script('bootstrap-tour')."\n";
		echo $this->Html->script('jquery.cookie')."\n";
		echo $this->Html->script('fullcalendar.min')."\n";
		echo $this->Html->script('jquery.dataTables.min')."\n";
		echo $this->Html->script('excanvas')."\n";
		//echo $this->Html->script('jquery.flot.min')."\n";
		//echo $this->Html->script('jquery.flot.pie')."\n";
		//echo $this->Html->script('jquery.flot.stack')."\n";
		echo $this->Html->script('jquery.chosen.min')."\n";
		echo $this->Html->script('jquery.uniform.min')."\n";
		echo $this->Html->script('jquery.colorbox.min')."\n";
		echo $this->Html->script('jquery.cleditor.min')."\n";
		echo $this->Html->script('jquery.noty')."\n";
		echo $this->Html->script('jquery.elfinder.min')."\n";
		echo $this->Html->script('jquery.raty.min')."\n";
		//echo $this->Html->script('jquery.iphone.toggle.min')."\n";
		echo $this->Html->script('jquery.autogrow-textarea')."\n";
		echo $this->Html->script('jquery.uploadify-3.1.min')."\n";
		//echo $this->Html->script('jquery.history.min')."\n";
		//echo $this->Html->script('jquery.charisma')."\n";
		//echo $this->Html->script('jquery.flot.resize.min')."\n";
	?>
	<?php //var_dump($this->Session->read()); ?>
	
		
</body>
</html>
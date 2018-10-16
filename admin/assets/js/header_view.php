<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Achei de Tudo</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo css_url(); ?>theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                      
 
 		<!-- <link rel="stylesheet" href="<?php echo css_url(); ?>styles.min.css"> -->
    	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
    
        <link rel="stylesheet" type="text/css" href="<?php echo css_url(); ?>font-awesome-ie7.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo css_url(); ?>font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo css_url(); ?>font-awesome-icons.min.css"/>

	 
        <link href='<?php echo css_url(); ?>sidebar-steel.css' rel='stylesheet' type='text/css' media='all'> 
    
            <link href='<?php echo css_url(); ?>default.css' rel='stylesheet' type='text/css' media='all'> 
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
	<!--[if lt IE 9]>
        <link rel="stylesheet" href="assets/css/ie8.css">
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
        <script type="text/javascript" src="assets/plugins/charts-flot/excanvas.min.js"></script>
	<![endif]-->

	<!-- The following CSS are included as plugins and can be removed if unused-->

<link rel='stylesheet' type='text/css' href='<?php echo css_url(); ?>plugins/form-daterangepicker/daterangepicker-bs3.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo css_url(); ?>plugins/fullcalendar/fullcalendar.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo css_url(); ?>plugins/form-markdown/css/bootstrap-markdown.min.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo css_url(); ?>plugins/codeprettifier/prettify.css' /> 
<link rel='stylesheet' type='text/css' href='<?php echo css_url(); ?>plugins/form-toggle/toggles.css' /> 
<link rel="stylesheet" type="text/css" href="<?php echo css_url(); ?>plugins/form-nestable/jquery.nestable.css">

<script type="text/javascript" src="<?php echo asset_url(); ?>plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo asset_url(); ?>plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo asset_url(); ?>plugins/bootstrap/bootstrap.min.js"></script>        

<!-- <script type='text/javascript' src='<?php echo js_url(); ?>jquery-1.10.2.min.js'></script> 
<script type='text/javascript' src='<?php echo js_url(); ?>jqueryui-1.10.3.min.js'></script>  -->
<script type='text/javascript' src='<?php echo js_url(); ?>bootstrap.min.js'></script> 
<script type='text/javascript' src='<?php echo js_url(); ?>enquire.js'></script> 
<script type='text/javascript' src='<?php echo js_url(); ?>jquery.cookie.js'></script> 
<script type='text/javascript' src='<?php echo js_url(); ?>jquery.nicescroll.min.js'></script>
<script type="text/javascript" src="<?php echo js_url(); ?>jquery-mask.js"></script>
<script type='text/javascript' src='<?php echo js_url(); ?>scripts.js'></script> 
<!-- START TEMPLATE -->
<script type="text/javascript" src="<?php echo js_url(); ?>settings.js"></script>
        
        <script type="text/javascript" src="<?php echo js_url(); ?>plugins.js"></script>        
        <script type="text/javascript" src="<?php echo js_url(); ?>actions.js"></script>
        
        <script type="text/javascript" src="<?php echo js_url(); ?>demo_dashboard.js"></script>
        <!-- END TEMPLATE -->
<script>var baseUrl = '<?php echo base_url(); ?>';</script>
</head>
<?php $user = $this->userModel->getUserData($this->session->userdata("user_id")); ?>
<body class="">
<div class="page-container">
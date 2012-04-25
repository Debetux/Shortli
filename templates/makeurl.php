<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Shre.me</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
  	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
	<style>
	hr.large {
	    background: none repeat scroll 0 0 #EBEBEB;
	    border: medium none;
	    height: 8px;
    	margin: 30px 0;
	}
	</style>
	
	<!-- Favicons
	================================================== -->
	
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>
<!-- Primary Page Layout
	================================================== -->

<div class="container">

		<div class="sixteen columns">
			<header>
				<h1 class="remove-bottom" style="margin-top: 40px">Shre.me</h1>
				<small><?php if(!empty($error)) echo $error; else echo 'Simple url shortener.' ?></small>

			</header>
		</div>
		
		<hr class="large">
		
		<?php if(!empty($content)){ ?>
			<div class="sixteen columns">
				<h3>Your link :</h3>
				<?php echo $content; ?>
			</div>	
			<hr/>
		<?php } ?>
		
		<div class="sixteen columns">
			
			<form method="post" action="./makeUrl"/>
				<label for="url">Enter a long url :</label>
				<input type="text" name="url" id="url" placeholder="http://exemple.com/"/>
				
				<label for="alias">Custom alias (optional) :</label>
				<input type="text" name="alias" id="alias"/>
				
				<input type="hidden" name="captcha"/>
				<input type="submit" value="Yeah ! Rock-it baby !"/>
			</form>
			
		</div>
		
		<div class="sixteen columns">
			<p><small>
				
			Powered by <a href="http://www.getskeleton.com/">Skeleton Template</a><br>
			Created by <a href="http://twitter.com/Debetux">@Debetux</a> under <a href="http://opensource.org/licenses/bsd-license.php">BSD Licence</a>, 2011</small>.
			</p>
		</div>

</div>


	<!-- JS
	================================================== -->
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="javascripts/tabs.js"></script>

<!-- End Document
================================================== -->
</body>
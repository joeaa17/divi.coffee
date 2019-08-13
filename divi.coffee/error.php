<?php
define( "DIVI", true );
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DIVI.coffee</title>
	<link rel="apple-touch-icon" sizes="120x120" href="/img/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/img/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/img/favicons/favicon-16x16.png">
	<link rel="manifest" href="/img/favicons/manifest.json">
	<link rel="mask-icon" href="/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="/all.css">
</head>
<body>
    <header class="header -scroll_white">
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main_navbar" aria-expanded="false">
                <span class="sr-only">Menú</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">
                <img src="/img/logo_white.png" alt="" class="logo_white">
                <img src="/img/logo_black.png" alt="" class="logo_black">
              </a>
            </div>
            <?php include_once( "menu.php" ); ?>
          </div><!-- /.container-fluid -->
        </nav>
    </header>

	<div class="wrapper-content">
		<section class="section-welcome section -full-height -page_404" style="background-image: linear-gradient(to top , rgba(0,0,0, 0.5) 0%, rgba(0,0,0,0.5) 100%) , url(/img/ico_coffe_beans.png) ,  url(/img/bg-welcome.png); ">
			<div class="content">
				<div class="page_404-block">
					<div class="page_404-title">Oh derP!</div>
					<p class="page_404-descr">I don't think you should be here .... do you?</p>
					<a href="#" onclick="window.history.back();" class="btn btn-primary btn-xl">Go back</a>
				</div>
			</div>
		</section>
		<footer class="footer -abs_bot">
			<div class="footer-copyright text-center">
				Encke Technologies SRL 2019 :: www.encke.cr
			</div>
		</footer>
	</div>
    <div class="scroll_top">
        <i class="fa fa-chevron-up"></i>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/moment-with-locales.min.js"></script>
    <script src="/js/bootstrap-select.min.js"></script>
    <script src="/js/shuffle.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/slick.min.js"></script>
    <script src="/js/all.js"></script>
<script>
window.setTimeout( function()	{
		window.history.back();
	}, 20000 );
window.setTimeout( function()	{
		window.location.href = "https://divi.coffee";
	}, 21000 );
</script>
</body>
</html>
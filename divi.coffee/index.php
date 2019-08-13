<?php
if( (int)$_SERVER["SERVER_PORT"] != 443 )	{
	header( "Location: https://divi.coffee/" );
	exit();
}
include_once( "../divi.coffee.private/coffee.php" );
$Web = new CafeWeb();
if( isset( $_GET["get_paid"] ) && isset( $_SESSION["payTo"] ) )	{
	print( (float)$Web->get_paid_to_divi_address( $_SESSION["payTo"] ) );
	exit();
}
if( isset( $_GET["update_cart"] ) && isset( $_POST["cart"] ) && ( strlen( $_POST["cart"] ) > 0 ) )	{
	$cart = json_decode( $_POST["cart"] );
	$cart = $Web->set_cart( $cart );
	print( json_encode( $cart? $cart: array() ) );
	exit();
}
$onload = "";
if( isset( $_POST["ship_type"] ) && isset( $_POST["ship_name"] ) && isset( $_POST["ship_address"] ) && isset( $_SESSION["payTo"] ) )	{
	$onload = "window.setTimeout( function() { alert( \"Your order has been completed.\\nYou will receive an email notification shortly!\" ); }, 1000 );";
	$Web->add_order( $Web->get_cart(), (int)$_POST["ship_type"], $_POST["ship_name"], $_POST["ship_email"], $_POST["ship_address"], $_SESSION["payTo"] );
	$Web->set_cart( array() );
}
$categories = $Web->get_categories();
$cart = $Web->get_cart();
$cart = ( $cart? $cart: array() );
$page = "home";
if( isset( $_GET["shop"] ) )	{
	$page = "shop";
}	else if( isset( $_GET["fotos"] ) )	{
	$page = "fotos";
}	else if( isset( $_GET["product"] ) )	{
	$page = "product";
}	else if( isset( $_GET["cart"] ) )	{
	$page = "cart";
}	else if( isset( $_GET["checkout"] ) )	{
	$page = "checkout";
	if( !isset( $_SESSION["payTo"] ) )	{
		$_SESSION["payTo"] = $Web->get_new_divi_address();
	}
}

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
    <link rel="stylesheet" href="/all.css?1">
    <script src="/js/divi.js?5"></script>
</head>
<body>
    <header class="header -scroll_white<?php print( ( $page == "fotos" )? " -black": "" ); ?>">
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
                <img src="/img/logo-click-coffee-white.png" alt="" class="logo_white">
                <img src="/img/logo-click-coffee-brown.png" alt="" class="logo_black">
              </a>
            </div>
            <?php include_once( "menu.php" ); ?>
          </div><!-- /.container-fluid -->
        </nav>
    </header>
    <div class="wrapper-content -page_menu -min_height100">
        <?php include_once( "index_" . $page . ".php" ); ?>
        <footer class="footer -sticky">
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
	<script src="/js/rellax.min.js"></script>
	<script src="/js/slick-lightbox.min.js"></script>
    <script src="js/starr.js"></script>
    <script src="/js/all.js"></script>
<script>
divi.cart = <?php print( json_encode( $cart? $cart: array() ) ); ?>;
divi.categories = <?php print( json_encode( $categories ) ); ?>;
<?php print( $onload ); ?>
</script>
</body>
</html>
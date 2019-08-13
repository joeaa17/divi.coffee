<?php
if( !defined( "DIVI" ) )	{
	header( "Location: https://divi.coffee/" );
	exit();
}
$cart = $Web->get_cart();
if( sizeof( $cart ) > 0 )	{
?>
<section class="section section-title_top" style="background-image: linear-gradient(to top , rgba(0,0,0, 0.5) 0%, rgba(0,0,0,0.5) 100%) , url(img/img-second_bg.jpg); ">
    <div class="container-fluid">
        <div class="menu-title_block ">
            <h2>My Carrito</h2>
            <p>Support struggling programmers stay awake, buy Costa Rican coffee with your DIVI!</p>
        </div>
    </div>
</section>
<section class="section section-shop -cart">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <ol class="breadcrumb product-breadcrump">
                  <li><a href="/">Home</a></li>
                  <li class="active">Cart</li>
                </ol>
                <div class="cart">
                    <div class="cart-table">
                        <div class="row cart-table_title">
                            <div class="col-sm-2 cart-product_img" >
                            </div>
                            <div class="col-sm-3 cart-product_title-block -center">
                                Product
                            </div>
                            <div class="col-sm-2 cart-product_price -center">
                                DIVI
                            </div>
                            <div class="col-sm-2 cart-product_quantity -center">
                                Quantity
                            </div>
                            <div class="col-sm-2 cart-product_total-price -center">
                                Total
                            </div>
                            <div class="col-sm-1 cat-product_del">
                               
                            </div>
                        </div>
<?php
$Total = 0;
for( $i = 0; $i < sizeof( $cart ); $i++ )	{
	$line = ( (int)$cart[$i]->priceDIVI * (int)$cart[$i]->qty );
	$Total += $line;
?><div class="row cart-table_descr">
	<div class="col-sm-2 col-xs-4  cart-product_img" >
		<div class="cart-img">
			<img src="<?php print( $cart[$i]->image ); ?>" alt="">
		</div>
	</div>
	<div class="col-sm-3 col-xs-8 cart-product_title-box -center">
		<div class="cart-product">
			<h5 class="cart-product_title"><?php print( $cart[$i]->name ); ?></h5>
		</div>
	</div>
	<div class="col-sm-2 col-xs-8 cart-product_price -center">
		<div class="cart-price">
			D<?php print( number_format( (int)$cart[$i]->priceDIVI, 0, "", "," ) ); ?>
		</div>
	</div>
	<div class="col-sm-2 cart-product_quantity -center">
		<div>
			<input type="number" size="3" id="QTY<?php print( $i ); ?>" min="1" max="10" value="<?php print( (int)$cart[$i]->qty ); ?>">
		</div>
	</div>
	<div class="col-sm-2  cart-product_total-price -center">
		<div class="cart-price -strong">D<?php print( number_format( $line, 0, "", "," ) ); ?></div>
	</div>
	<div class="col-sm-1  cat-product_del -center">
		<div>
			<a href="javascript:void(0);" onclick="divi.remove( <?php print( $cart[$i]->id ); ?> );" class="cart-close">
				<i class="fa fa-times" aria-hidden="true"></i>
			</a>
		</div>
	</div>
</div><?php
}
?>
                       
                       
                       
                       
                       
                       
                    </div>
                    <div class="cart-checkout_wrapper">
                        <div class="cart-checkout">
                            <a href="/?checkout" class="btn btn-md btn-primary btn-ico btn-upper -mg_rt10">
                                <span>Proceed to Checkout</span>
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="divi.update_quantities();" class="btn btn-secondary btn-md btn-upper">
                                update cart
                            </a>
                            <div class="cart-total">
                                <h5 class="cart-total_title">CART TOTALS:</h5>
                                <div class="cart-total_price">
                                    D<?php print( number_format( $Total, 0, "", "," ) ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}	else	{
	include_once( "index_home.php" );
}
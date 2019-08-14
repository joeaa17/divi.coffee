<?php
if( !defined( "DIVI" ) )	{
	header( "Location: https://divi.coffee/" );
	exit();
}
$cart = $Web->get_cart();
$weight = 0;
for( $i = 0; $i < sizeof( $cart ); $i++ )	{
	$weight += ( (int)$cart[$i]->weight * (int)$cart[$i]->qty );
}
$shipping_costs = $Web->get_shipping_costs( $weight );
if( sizeof( $shipping_costs ) == 0 )	{
	$onload = "window.setTimeout( function() { alert( \"Your order has too many products to be shipped, please remove something from your cart or contact customer service at dev@encke.cr.\" ); }, 1000 );";
	include_once( "index_home.php" );
}	else	{
	$shipping_prices = array();
	if( sizeof( $cart ) > 0 )	{
?>
<section class="section section-title_top" style="background-image: linear-gradient(to top , rgba(0,0,0, 0.5) 0%, rgba(0,0,0,0.5) 100%) , url(img/img-second_bg.jpg); ">
    <div class="container-fluid">
        <div class="menu-title_block">
            <h2 class="pd_bot_0">Pay with DIVI</h2>
        </div>
    </div>
</section>
<section class="section section-checkout">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-md-offset-1">
                <ol class="breadcrumb product-breadcrump">
                  <li><a href="/">Home</a></li>
                  <li><a href="/?cart">Cart</a></li>
                  <li class="active">checkout</li>
                </ol>
            </div>
        </div>
        <div class="checkout">
            <form action="/" method="post" enctype="application/x-www-form-urlencoded">
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                        <h5 class="checkout-title">SHIPPING DETAILS</h5>
                        <div class="checkout-form">
	                        <div class="form-group">
	                            <select class="form-control" name="ship_type" id="ship_type" required onchange="divi.shipping_change();">
<?php
for( $i = 0; $i < sizeof( $shipping_costs ); $i++ )	{
	$shipping_prices[] = (int)$shipping_costs[$i]->priceDIVI;
	print( "<option value=\"" . (int)$i . "\"" . ( ( $i == 0 )? " selected=\"selected\"": "" ) . ">" . $shipping_costs[$i]->name . "</option>" );
}
?>
	                            </select>
	                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="checkout-form_name">Name or Title *</label>
                                        <input type="text" class="form-control" name="ship_name" placeholder="What can we call you *" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="checkout-form_email">Email</label>
                                        <input type="text" class="form-control" name="ship_email" placeholder="Contact for issues / alerts *" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="ship_address" placeholder="Complete Shipping Address" required></textarea>
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-4 half-col-pd-lt">
                        <table class="table checkout-table">
                            <thead>
                              <tr>
                                <th class="text-left">Product</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">DIVI</th>
                              </tr>
                            </thead>
                            <tbody><?php
$Total = 0;
for( $i = 0; $i < sizeof( $cart ); $i++ )	{
	$line = ( (int)$cart[$i]->priceDIVI * (int)$cart[$i]->qty );
	$Total += $line;
?>
<tr>
	<td>
		<div class="checkout-table_product">
			<span class="checkout-table_product-title"><?php print( $cart[$i]->name ); ?></span>
		</div>
	</td>
	<td class="text-center"><?php print( (int)$cart[$i]->qty ); ?></td>
	<td class="text-center">
		<span class="checkout-table_price"><?php print( number_format( $line, 0, "", "," ) ); ?></span>
	</td>
</tr>
<?php } ?>
                            </tbody>
                        </table>
                        <div class="checkout-total clearfix">
                            <h5 class="checkout-total_title">products:<br/>shipping:</h5>
                            <div class="checkout-total_price" style="text-align: right;"><?php print( number_format( $Total, 0, "", "," ) ); ?><br/><span id="shipping_cost"><?php print( number_format( $shipping_costs[0], 0, "", "," ) ); ?></span></div>
                        </div>
                        <div class="checkout-total clearfix" id="send_total_lines">
                            <h5 class="checkout-total_title">send total:</h5>
                            <div class="checkout-total_price" id="send_total"><?php print( number_format( ( $line + $shipping_costs[0] ), 0, "", "," ) ); ?></div>
                            <input type="text" value="<?php print( $_SESSION["payTo"] ); ?>" id="payTo" onclick="divi.copy_pay_to();" style="width: 100%; margin-top: 15px;">
							<p style="font-size: 13px;" onclick="divi.copy_pay_to();">Please make your payment for the total amount ONLY to the address above. NO CHANGE IS GIVEN.</p>
                        </div>
                        <div class="checkout-total clearfix" style="margin-top: -30px;">
                            <h5 class="checkout-total_title">received:</h5>
                            <div class="checkout-total_price" id="total_received">0</div>
                        </div>
                        <div class="checkout-total clearfix" style="margin-top: -30px;" id="balance_line">
                            <h5 class="checkout-total_title">balance:</h5>
                            <div class="checkout-total_price" id="total_balance">0</div>
                        </div>
                        
                        
                        
                        
                        <button type="submit" class="btn btn-md btn-primary btn-ico btn-upper -mg_rt10" value='place order' style="display: none;" id="confirm_order">
                            <span>finalize order</span>
                            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
divi.checkout_total = <?php print( (float)$Total ); ?>;
divi.shipping = <?php print( json_encode( $shipping_costs ) ); ?>;
divi.total_to_pay = <?php print( ( (float)$Total + $shipping_costs[0] ) ); ?>;
window.onload = divi.get_paid;
</script>
<?php
	}	else	{
		include_once( "index_home.php" );
	}
}
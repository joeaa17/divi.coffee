<?php
if( !defined( "DIVI" ) )	{
	header( "Location: https://divi.coffee/" );
	exit();
}
$product = $Web->get_product( (int)$_GET["product"] );
if( $product )	{
?>
<section class="section section-title_top" style="background-image: linear-gradient(to top , rgba(0,0,0, 0.5) 0%, rgba(0,0,0,0.5) 100%) , url(img/img-second_bg.jpg); ">
    <div class="container-fluid">
        <div class="menu-title_block">
            <h2>The best Café</h2>
            <p>Support struggling programmers stay awake, buy Costa Rican coffee with your DIVI!</p>
        </div>
    </div>
</section>
<section class="section section-product -pd_top_0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="product">
                    <ol class="breadcrumb product-breadcrump">
                      <li><a href="/">Home</a></li>
                      <li><a href="/?shop">Shop</a></li>
                      <li class="active"><?php print( $product->name ); ?></li>
                    </ol>
                    <div class="row">
                        <div class="col-md-7 ">
                            <div class="product-img_slider clearfix">
                                <div class="product-img_slider_nav" id="product-img_slider_nav">
                                    <div class="product-img_slider_nav-item">
                                        <a href="javascript:void(0);">
                                        <img src="<?php print( $product->image ); ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="product-img_slider_for">
                                    <div class="item">
                                        <a href="javascript:void(0);">
                                        <img src="<?php print( $product->image ); ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 ">
                            <h3 class="product-inner_title"><?php print( $product->name ); ?></h3>
                            <div class="product-inner_price_block">
                                <div class="product-inner_price_old"><?php print( "<span>&#8353;</span>" . number_format( $product->price, 0, ".", "," ) . " <span>$</span>" . number_format( $product->priceUSD, 2, ".", "," ) . " <span>&euro;</span>" . number_format( $product->priceEUR, 2, ".", "," ) . " <span>&pound;</span>" . number_format( $product->priceGBP, 2, ".", "," ) . "</div>" ); ?><br />
                                <div class="product-inner_price_new"><span>D</span><?php print( number_format( $product->priceDIVI, 0, ".", "," ) ); ?></div>
                            </div>
                            <p class="product-inner_descr"><?php print( $product->short_description ); ?></p>
                            <a href="javascript:void(0);" onclick="divi.add_id( <?php print( $product->id ); ?> );" class="btn btn-md btn-primary btn-upper btn-ico"><span>add to cart</span><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="product-inner_tabs">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#product-inner_tab1" aria-controls="product-inner_tab1" role="tab" data-toggle="tab">Description</a></li>
                        <li role="presentation"><a href="#product-inner_tab2" aria-controls="product-inner_tab2" role="tab" data-toggle="tab">Additional Information</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active fade in" id="product-inner_tab1">
                            <h5 class="product-descr_title"><?php print( $product->name ); ?></h5>
                            <p><?php print( $product->description ); ?></p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="product-inner_tab2">
                            <table class="product-info_table">
                                <tbody>
                                  <tr>
                                    <td class="product-info_title">Product Dimensions</td>
                                    <td><?php print( $product->dimensions ); ?></td>
                                  </tr>
                                  <tr>
                                    <td class="product-info_title">Weight</td>
                                    <td><?php print( $product->weight ); ?> grams</td>
                                  </tr>
                                  <tr>
                                    <td class="product-info_title">Country of origin</td>
                                    <td><?php print( $product->country ); ?></td>
                                  </tr>
                                  <tr>
                                    <td class="product-info_title">Brand</td>
                                    <td><?php print( $product->brand ); ?></td>
                                  </tr>
                                  <tr>
                                    <td class="product-info_title">Format</td>
                                    <td><?php print( $product->format ); ?></td>
                                  </tr>
                                  <tr>
                                    <td class="product-info_title">Manufacturer/Producer</td>
                                    <td><?php print( $product->manufacturer ); ?></td>
                                  </tr>
                                </tbody>
                            </table>
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
<?php
if( !defined( "DIVI" ) )	{
	header( "Location: https://divi.coffee/" );
	exit();
}
?>
<section class="section section-title_top" style="background-image: linear-gradient(to top , rgba(0,0,0, 0.5) 0%, rgba(0,0,0,0.5) 100%) , url(img/img-second_bg.jpg); ">
    <div class="container-fluid">
        <div class="menu-title_block">
            <h2>DIVI.café Online Coffee Shop</h2>
            <p>As our lives base in such a beautiful location, we decided to allow the whole world to be able to obtain the delicate and custom coffee which is saved for the locals.</p>
            <p>The one requirement? We only take DIVI! If you want to get DIVI learn more at <a href="https://www.diviproject.org" target="DIVI">www.diviproject.org</a>.</p>
        </div>
    </div>
</section>
<section class="section section-shop -pdtop0">
    <div class="container-fluid">
        <div class="row">
<?php
for( $i = 0; $i < sizeof( $categories ); $i++ )	{
	for( $n = 0; $n < sizeof( $categories[$i]->products ); $n++ )	{
		print( "<div class=\"col-sm-4 col-md-4 col-lg-3\"><div class=\"shop-item -center\"><a href=\"/?product=" . $categories[$i]->products[$n]->id . "\" class=\"shop-img\"><img src=\"" . $categories[$i]->products[$n]->image . "\" alt=\"\"></a><h5 class=\"shop-title\">" . $categories[$i]->products[$n]->name . "</h5><p class=\"shop-descr\">" . $categories[$i]->products[$n]->subtext . "</p><div class=\"shop-content_bot clearfix\"><div class=\"shop-price\"><span>DIVI</span> " . number_format( $categories[$i]->products[$n]->priceDIVI, 0, ".", "," ) . "</div><div class=\"shop-overlay\"><ul class=\"shop-info_list\"><li><a href=\"javascript:void(0);\" onclick=\"divi.add( " . $i . ", " . $n . " );\"><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i></a></li><li><a href=\"/?product=" . $categories[$i]->products[$n]->id . "\"><i class=\"fa fa-arrow-right\" aria-hidden=\"true\"></i></a></li></ul></div></div></div></div>" );
	}
}
?>
        </div>
    </div>
</section>
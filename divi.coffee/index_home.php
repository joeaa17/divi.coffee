<?php
if( !defined( "DIVI" ) )	{
	header( "Location: https://divi.coffee/" );
	exit();
}
?>
<section class="menu-section">
    <div class="menu-slider">
<?php
for( $i = 0; $i < sizeof( $categories ); $i++ )	{
	$list = "";
	for( $n = 0; ( $n < sizeof( $categories[$i]->products ) ) && ( $n < 3 ); $n++ )	{
		$list .= "<li class=\"tabMenu-item clearfix\" style=\"cursor: pointer;\" onclick=\"document.location.href='/?product=" . $categories[$i]->products[$n]->id . "';\"><div class=\"tabMenu-content\"><div class=\"tabMenu-img\"><img src=\"" . $categories[$i]->products[$n]->image . "\" alt=\"\"></div><div class=\"tabMenu-content_inner\"><p class=\"tabMenu-content-title\">" . $categories[$i]->products[$n]->name . "</p><p class=\"tabMenu-content-descr\">" . $categories[$i]->products[$n]->subtext . "</p></div></div><div class=\"tabMenu-price\"><span style=\"text-align: right;\">&#8353;" . number_format( $categories[$i]->products[$n]->price, 0, ".", "," ) . "<br />$" . number_format( $categories[$i]->products[$n]->priceUSD, 2, ".", "," ) . "<br />&euro;" . number_format( $categories[$i]->products[$n]->priceEUR, 2, ".", "," ) . "<br />&pound;" . number_format( $categories[$i]->products[$n]->priceGBP, 2, ".", "," ) . "<br />D" . number_format( $categories[$i]->products[$n]->priceDIVI, 0, ".", "," ) . "</span></div></li>";
	}
	print( "<div class=\"menu-slider_item\" style=\"background-image: linear-gradient(to top , rgba(0,0,0, 0.5) 0%, rgba(0,0,0,0.5) 100%) , url(" . $categories[$i]->image . "); \"><div class=\"tabMenu -item100\"><div class=\"menu-title_block -slider\"><h2>" . $categories[$i]->name . "</h2><p>" . $categories[$i]->subtext . "</p></div><ul class=\"tabMenu-list -white\">" . $list . "</ul><div class=\"clear\"></div><div class=\"button\"><a href=\"/?shop\">see more</a></div></div></div>" );
}
?>
    </div>
</section>
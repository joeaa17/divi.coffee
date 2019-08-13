<?php
if( !defined( "DIVI" ) )	{
	header( "Location: https://divi.coffee/" );
	exit();
}
$gallery = $Web->get_gallery();
?>
<section class="section-gallery section -page_gallery -overlay_title200 " id="section-gallery">
	<div class="section-overlay-title rellax" data-rellax-speed="1" data-rellax-percentage="0.5">
		<span>Foto gallery</span>
	</div>
	<div class="container-fluid">
		<div class="galley clearfix">
			<div class="row">
				<div class="col-md-9 col-md-offset-2">
					<div class="section-title">
						<h2>Foto gallery</h2>
					</div>
					<div class="gallery-menu" id="gallery-filter">
						<ul class="gallery-filter">
<?php
$last_group = null;
for( $i = 0; $i < sizeof( $gallery ); $i++ )	{
	if( $last_group != $gallery[$i]->group )	{
		print( "<li> <a href=\"javascript:void(0);\"" . ( $last_group? "": " class=\"active\"" ) . " data-group=\"" . ( $last_group? $gallery[$i]->group: "all" ) . "\"> <svg version=\"1.1\" class=\"ico-square\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 9.2 9.2\" enable-background=\"new 0 0 9.2 9.2\" xml:space=\"preserve\"><path fill=\"#FFD03B\" d=\"M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0 l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z\"/> </svg> <span>" . ( $last_group? $gallery[$i]->group: "All" ) . "</span> <svg version=\"1.1\" class=\"ico-square\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" x=\"0px\" y=\"0px\" viewBox=\"0 0 9.2 9.2\" enable-background=\"new 0 0 9.2 9.2\" xml:space=\"preserve\"><path fill=\"#FFD03B\" d=\"M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4 l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z\"/></svg></a></li>" );
		$last_group = $gallery[$i]->group;
	}
}
?>
						</ul>
					</div>
				</div>
			</div>
			<div class="gallery-content" id="gallery-content">
<?php
for( $i = 0; $i < sizeof( $gallery ); $i++ )	{
	print( "<a href=\"" . $gallery[$i]->image . "\" class=\"gallery-item -width50 -height" . ( ( (int)$gallery[$i]->tall == 1 )? "10": "5" ) . "0\" data-groups='[\"" . $gallery[$i]->group . "\"]' ><div class=\"gallery-overlay\"><div class=\"gallery-overlay-content\"><h3>" . $gallery[$i]->title . "</h3><p>" . $gallery[$i]->subtext . "</p></div></div><div class=\"gallery-img\"><div class=\"img\" style=\"background-image: url(" . $gallery[$i]->image . ");\"></div></div></a>" );
}
?>
			</div>
		</div>
	</div>
</section>
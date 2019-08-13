<?php
if( !defined( "DIVI" ) )	{
	header( "Location: https://divi.coffee/" );
	exit();
}
?>
<div class="collapse navbar-collapse" id="main_navbar">
  <ul class="nav navbar-nav navbar-right">
    <li<?php print( ( $page == "home" )? " class=\"active\"": "" ); ?>>
        <a href="/">
            <svg version="1.1" class="ico-square" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 9.2 9.2" enable-background="new 0 0 9.2 9.2" xml:space="preserve">
            <path fill="#FFD03B" d="M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0
                l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z"/>
            </svg>
            <span>Home</span>
            <svg version="1.1" class="ico-square" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 9.2 9.2" enable-background="new 0 0 9.2 9.2" xml:space="preserve">
            <path fill="#FFD03B" d="M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0
                l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z"/>
            </svg>
        </a>
    </li>
    <li<?php print( ( $page == "fotos" )? " class=\"active\"": "" ); ?>>
        <a href="/?fotos">
            <svg version="1.1" class="ico-square" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 9.2 9.2" enable-background="new 0 0 9.2 9.2" xml:space="preserve">
            <path fill="#FFD03B" d="M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0
                l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z"/>
            </svg>
            <span>Fotos</span>
            <svg version="1.1" class="ico-square" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 9.2 9.2" enable-background="new 0 0 9.2 9.2" xml:space="preserve">
            <path fill="#FFD03B" d="M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0
                l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z"/>
            </svg>
        </a>
    </li>
    <!--<li<?php print( ( $page == "stories" )? " class=\"active\"": "" ); ?>>
        <a href="/?page-testimonials-01.html">
            <svg version="1.1" class="ico-square" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 9.2 9.2" enable-background="new 0 0 9.2 9.2" xml:space="preserve">
            <path fill="#FFD03B" d="M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0
                l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z"/>
            </svg>
            <span>Testimonials</span>
            <svg version="1.1" class="ico-square" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 9.2 9.2" enable-background="new 0 0 9.2 9.2" xml:space="preserve">
            <path fill="#FFD03B" d="M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0
                l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z"/>
            </svg>
        </a>
    </li>-->
    <li<?php print( ( $page == "shop" )? " class=\"active\"": "" ); ?>>
        <a href="/?shop">
            <svg version="1.1" class="ico-square" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 9.2 9.2" enable-background="new 0 0 9.2 9.2" xml:space="preserve">
            <path fill="#FFD03B" d="M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0
                l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z"/>
            </svg>
            <span>Shop</span>
            <svg version="1.1" class="ico-square" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 9.2 9.2" enable-background="new 0 0 9.2 9.2" xml:space="preserve">
            <path fill="#FFD03B" d="M5.8,8.7C5.5,9,5,9.2,4.6,9.2S3.7,9,3.4,8.7L0.5,5.8c-0.7-0.7-0.7-1.7,0-2.4l2.9-2.9c0.7-0.7,1.7-0.7,2.4,0
                l2.9,2.9c0.7,0.7,0.7,1.7,0,2.4L5.8,8.7z"/>
            </svg>
        </a>
    </li>
    <li<?php print( ( $page == "cart" )? " class=\"active\"": "" ); ?>>
        <a href="/?cart">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <span class="cart-products" id="cart_count"<?php print( ( $cart && ( sizeof( $cart ) > 0 ) )? "": " style=\"display: none;\"" ); ?>><?php print( ( $cart && ( sizeof( $cart ) > 0 ) )? sizeof( $cart ): "" ); ?></span>
        </a>
    </li>
  </ul>
</div>
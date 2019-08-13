var numberWithCommas = function ( x )	{
	return x.toString().replace( /\B(?=(\d{3})+(?!\d))/g, "," );
};
var divi = {
	cart: [],
	categories: [],
	reload: false,
	checkout_total: 0,
	paid_refresh: null,
	paid_refresh_delay: 5,
	received: 0,
	add: function( category, product )	{
		var exists = false;
		for( var i =0; ( i < divi.cart.length ) && !exists; i++ )	{
			if( parseInt( divi.cart[i].id ) == parseInt( divi.categories[category].products[product].id ) )	{
				exists = true;
				divi.cart[i].qty++;
			}
		}
		if( !exists )	{
			divi.cart.push( divi.categories[category].products[product] );
		}
		divi.update();
	},
	add_id: function( id )	{
		var found = false;
		for( var i = 0; ( i < divi.categories.length ) && !found; i++ )	{
			for( var n = 0; ( n < divi.categories[i].products.length ) && !found; n++ )	{
				if( parseInt( divi.categories[i].products[n].id ) == parseInt( id ) )	{
					found = true;
					divi.add( i, n );
				}
			}
		}
	},
	remove: function( id )	{
		var cart = [];
		for( var i = 0; i < divi.cart.length; i++ )	{
			if( parseInt( divi.cart[i].id ) != parseInt( id ) )	{
				cart.push( divi.cart[i] );
			}
		}
		divi.cart = cart;
		divi.update();
	},
	update_quantities: function()	{
		for( var i = 0; i < divi.cart.length; i++ )	{
			divi.cart[i].qty = parseInt( $( "#QTY" + i ).val() );
		}
		divi.reload = true;
		divi.update();
	},
	update: function()	{
		window.setTimeout( divi.send_update, 0 );
		if( divi.cart.length > 0 )	{
			$( "#cart_count" ).html( divi.cart.length );
			$( "#cart_count" ).show();
		}	else	{
			$( "#cart_count" ).hide();
		}
	},
	send_update: function()	{
		$.post( "/index.php?update_cart", { cart: JSON.stringify( divi.cart ) }, function( data )	{
				if( data && ( data.length > 0 ) )	{
					data = JSON.parse( data );
					if( data )	{
						divi.cart = data;
						if( divi.cart.length == 0 )	{
							document.location.href = "/?" + Math.random();
							divi.reload = false;
						}
					}
					if( divi.reload )	{
						document.location.href = "/?cart&" + Math.random();
					}
				}
			} );
	},
	copy_pay_to: function() {
		var copyText = document.getElementById("payTo");
		copyText.select();
		document.execCommand( "copy" );
		alert("The address has been copied to your clipboard." );
	},
	shipping_change: function()	{
		var shipping_cost = parseInt( divi.shipping[parseInt( $( "#ship_type" ).val() )] );
		divi.total_to_pay = ( shipping_cost + divi.checkout_total );
		$( "#shipping_cost" ).html( numberWithCommas( shipping_cost ) );
		$( "#send_total" ).html( numberWithCommas( divi.total_to_pay ) );
	},
	get_paid: function()	{
		if( !divi.paid_refresh )	{
			divi.paid_refresh = window.setInterval( divi.get_paid, ( divi.paid_refresh_delay * 1000 ) );
		}
		$.post( "/index.php?get_paid", { cart: JSON.stringify( divi.cart ) }, function( data )	{
				divi.received = parseFloat( data );
				$( "#balance_line" ).show();
				$( "#total_received" ).html( numberWithCommas( divi.received ) );
				$( "#total_balance" ).html( numberWithCommas( divi.total_to_pay - divi.received ) );
				if( divi.total_to_pay <= divi.received )	{
					$( "#send_total_lines" ).hide();
					$( "#confirm_order" ).show();
					$( "#balance_line" ).hide();
				}
			} );
	},
};
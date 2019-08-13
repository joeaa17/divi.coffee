<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once( "../vendor/autoload.php" );
include_once( "divicli.php" );
include_once( "nXchange.php" );
include_once( "encke_file.php" );
define( "DIVI", true );
class CafeWeb	{
	private $DB;
	private $cart_session = "cart";
	
	public $xChange;
	
	public function __construct()	{
		@session_start();
		$this->DB = new mysqli( "localhost", "coffee", "coffee", "coffee" );
		$this->DB->set_charset( "utf8" );
		
		$this->nXchange = new nXchange( false );
	}
	
	public function __destruct()	{
		$this->DB->close();
	}
	
	public function get_cart()	{
		$cart = array();
		if( isset( $_SESSION[$this->cart_session] ) )	{
			$cart = json_decode( $_SESSION[$this->cart_session] );
		}
		return $cart;
	}
	
	public function set_cart( $cart )	{
		$_SESSION[$this->cart_session] = json_encode( $cart );
		return $this->get_cart();
	}
	
	public function get_categories()	{
		$products = array();
		$sql = "SELECT `category_id`, `id`, `name`, `image`, `subtext`, `price`, `weight` FROM `products` ORDER BY `category_id`, `price` DESC, `name`, `subtext`";
		if( $result = $this->DB->query( $sql ) )	{
			while( $row = $result->fetch_object() )	{
				$key = ( "C" . (int)$row->category_id );
				if( !isset( $products[$key] ) )	{
					$products[$key] = array();
				}
				$row->qty = 1;
				$row->priceUSD = ( (int)( $this->nXchange->convert( "crc", "usd", (int)$row->price ) * 100 ) / 100 );
				$row->priceEUR = ( (int)( $this->nXchange->convert( "crc", "euro", (int)$row->price ) * 100 ) / 100 );
				$row->priceGBP = ( (int)( $this->nXchange->convert( "crc", "pound", (int)$row->price ) * 100 ) / 100 );
				$row->priceDIVI = ( (int)( $this->nXchange->convert( "crc", "divi", (int)$row->price ) * 100 ) / 100 );
				$products[$key][] = $row;
			}
			$result->close();
		}
		$list = array();
		$sql = "SELECT `id`, `name`, `image`, `subtext` FROM `categories` ORDER BY `id`";
		if( $result = $this->DB->query( $sql ) )	{
			while( $row = $result->fetch_object() )	{
				$key = ( "C" . (int)$row->id );
				$row->products = ( isset( $products[$key] )? $products[$key]: array() );
				$list[] = $row;
			}
			$result->close();
		}
		return $list;
	}
	
	public function get_product( $id )	{
		$product = null;
		$sql = "SELECT `category_id`, `id`, `name`, `image`, `subtext`, `price`, `weight`, `short_description`, `description`, `dimensions`, `country`, `brand`, `format`, `manufacturer` FROM `products` WHERE ( `id` = " . (int)$id . " )";
		if( $result = $this->DB->query( $sql ) )	{
			if( $row = $result->fetch_object() )	{
				$row->priceUSD = ( (int)( $this->nXchange->convert( "crc", "usd", (int)$row->price ) * 100 ) / 100 );
				$row->priceEUR = ( (int)( $this->nXchange->convert( "crc", "euro", (int)$row->price ) * 100 ) / 100 );
				$row->priceGBP = ( (int)( $this->nXchange->convert( "crc", "pound", (int)$row->price ) * 100 ) / 100 );
				$row->priceDIVI = ( (int)( $this->nXchange->convert( "crc", "divi", (int)$row->price ) * 100 ) / 100 );
				$product = $row;
			}
			$result->close();
		}
		return $product;
	}
	
	public function get_gallery()	{
		$list = array();
		$sql = "SELECT `id`, `group`, `image`, `title`, `subtext`, `tall` FROM `fotos` ORDER BY `order`";
		if( $result = $this->DB->query( $sql ) )	{
			while( $row = $result->fetch_object() )	{
				$list[] = $row;
			}
			$result->close();
		}
		return $list;
	}
	
	public function get_shipping_costs()	{
		$list = array();
		$sql = "SELECT `id`, `name`, `cost` FROM `shipping` ORDER BY `id`";
		if( $result = $this->DB->query( $sql ) )	{
			while( $row = $result->fetch_object() )	{
				$list[] = $row;
			}
			$result->close();
		}
		return $list;
	}
	
	public function get_new_divi_address()	{
		$cli = new DiviCLI();
		return $cli->run( "NewAddy", null, true );
	}
	
	public function get_paid_to_divi_address( $address )	{
		$cli = new DiviCLI();
		return ( (int)$cli->run( "BCBalance", $cli->format_address( $address ) )->balance / 100000000 );
	}
	
	public function add_order( $cart, $ship_type, $ship_name, $ship_email, $ship_address, $payTo )	{
		$shipping_costs = $this->get_shipping_costs();
		$total = 0;
		$cart_sql = array();
		for( $i = 0; $i < sizeof( $cart ); $i++ )	{
			$line = ( (int)$cart[$i]->priceDIVI * (int)$cart[$i]->qty );
			$total += $line;
			$cart_sql[] = "( ORDER_ID, " . (int)$cart[$i]->id . ", " . (int)$cart[$i]->qty . ", " . (int)$cart[$i]->priceDIVI . ", " . (int)$line . " )";
			
		}
		$sql = "INSERT INTO `orders` ( `added`, `ship_type`, `ship_name`, `ship_email`, `address`, `shipping_cost`, `total`, `paid`, `total_paid`, `canceled`, `removed`, `paid_to` ) VALUES ( UTC_TIMESTAMP(), " . (int)$shipping_costs[(int)$ship_type]->id . ", '" . addslashes( $ship_name ) . "', '" . addslashes( $ship_email ) . "', '" . addslashes( $ship_address ) . "', " . (int)$shipping_costs[(int)$ship_type]->cost . ", " . (int)$total . ", UTC_TIMESTAMP(), " . (int)$this->get_paid_to_divi_address( $payTo ) . ", 0, 0, '" . addslashes( $payTo ) . "' )";
		$this->DB->query( $sql );
		$order_id = (int)$this->DB->insert_id;
		$sql = "INSERT INTO `order_items` ( `order_id`, `product_id`, `qty`, `price_ea`, `total` ) VALUES " . str_replace( "ORDER_ID", $order_id, implode( ",", $cart_sql ) );
		$this->DB->query( $sql );
		$cli = new DiviCLI();
		$cli->withdrawl( $total - 1 );
	}
	
	public function send_email()	{
		
		
		$ship_email = "matthew@encke.cr";
		
		
		$mail = new PHPMailer( true );
		try	{
			$mail->setFrom( "sales@divi.coffee", "DIVI.coffee" );
			$mail->addAddress( $ship_email );
			$mail->addReplyTo( "divi.coffee@encke.cr", "DIVI.coffee" );
			$mail->addCC( "divi.coffee@encke.cr" );
			$mail->isHTML( true );
			$mail->Subject = "Your coffee order!";
			$mail->AltBody = "Your order has been processed. We will email you as soon as it ships!";
			$mail->Body = "Your order has been processed. We will email you as soon as it ships!";
			$mail->send();
		} catch ( Exception $e )	{}
	}
};
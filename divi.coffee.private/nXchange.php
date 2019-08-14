<?php
class nXchange	{
	private $data_file = "/divi.coffee/x";
	
	private $rates;
	
	public function __construct( $load )	{
		$data = null;
		if( $load )	{
			$data = ( strtotime( "-6 hour" ) . "," . (float)$this->CRC2USD() . "," . (float)$this->USD2EURFromBCCR() . "," . (float)$this->EUR2GBPexchangeratesapi() . "," . (float)$this->USD2DIVI() );
			@file_put_contents( $this->data_file, $data );
		}	else	{
			$data = @file_get_contents( $this->data_file );
		}
		if( $data && ( strlen( $data ) > 0 ) )	{
			$data = explode( ",", $data );
			if( $data && ( sizeof( $data ) == 5 ) )	{
				$this->rates = new stdClass();
				$this->rates->on = (int)$data[0];
				$this->rates->crc = (float)$data[1];
				$this->rates->eur = (float)$data[2];
				$this->rates->gbp = (float)$data[3];
				$this->rates->divi = (float)$data[4];
			}
		}
	}
	
	public function convert( $from, $to, $amount )	{
		if( ( $from == "crc" ) && ( $to == "usd" ) )	{
			$amount = ( (float)$amount / $this->rates->crc );
		}	else if( ( $from == "crc" ) && ( $to == "euro" ) )	{
			$amount = ( ( (float)$amount / $this->rates->crc ) / $this->rates->eur );
		}	else if( ( $from == "crc" ) && ( $to == "pound" ) )	{
			$amount = ( ( ( (float)$amount / $this->rates->crc ) / $this->rates->eur ) * $this->rates->gbp );
		}	else if( ( $from == "crc" ) && ( $to == "divi" ) )	{
			$amount = (int)( ( (float)$amount / $this->rates->crc ) / $this->rates->divi );
		}
		return $amount;
	}
	
	public function EUR2GBPexchangeratesapi()	{
		$rate = 0;
		$data = @file_get_contents( "https://api.exchangeratesapi.io/latest?symbols=GBP" );
		if( $data )	{
			$data = json_decode( $data );
			if( $data && isset( $data->rates ) && isset( $data->rates->GBP ) )	{
				$rate = (float)$data->rates->GBP;
			}
		}
		return $rate;
	}
	
	public function USD2DIVI()	{
		$rate = 0;
		$data = @file_get_contents( "https://coinmarketcap.com/currencies/divi/" );
		if( $data )	{
			$data = explode( "\"", substr( $data, ( strpos( $data, "\"price\": \"" ) + 10 ) ) );
			if( sizeof( $data ) > 2 )	{
				$data = $data[0];
				if( $data && ( strlen( $data ) > 0 ) )	{
					$rate = (float)str_replace( ",", ".", $data );
				}
			}
		}
		return $rate;
	}
	
	public function USD2EURFromBCCR()	{
		$rate = 0;
		$data = @file_get_contents( "https://gee.bccr.fi.cr/indicadoreseconomicos/Cuadros/frmVerCatCuadro.aspx?CodCuadro=12&Idioma=1&FecInicial=" . date( "Y/m/d", strtotime( "-5 day", strtotime( "-6 hour" ) ) ) . "&FecFinal=" . date( "Y/m/d", strtotime( "-6 hour" ) ) );
		if( $data )	{
			$data = explode( "class=\"celda12\"", $data );
			if( sizeof( $data ) > 2 )	{
				$data = substr( $data[( sizeof( $data ) - 1 )], strpos( $data[( sizeof( $data ) - 1 )], "<P>" ) );
				if( $data && ( strlen( $data ) > 0 ) )	{
					$rate = (float)str_replace( ",", ".", substr( $data, 3, ( strpos( $data, "</P>" ) - 3 ) ) );
				}
			}
		}
		return $rate;
	}
	
	public function CRC2USD()	{
		$rate = 0;
		$buf = @file_get_contents( "http://indicadoreseconomicos.bccr.fi.cr/indicadoreseconomicos/Cuadros/frmVerCatCuadro.aspx?CodCuadro=400&Idioma=1&FecInicial=" . date( "Y/m/d", strtotime( "-5 day", strtotime( "-6 hour" ) ) ) . "&FecFinal=" . date( "Y/m/d", strtotime( "-6 hour" ) ) . "&Filtro=0" );
		if( $buf && ( strlen( $buf ) > 0 ) )	{
			$buf = explode( "<td class=\"celda400\" vAlign=\"center\" align=\"right\" width=\"100\">", $buf );
			if( $buf && ( sizeof( $buf ) > 5 ) )	{
				$Exchange = new stdClass();
				$Exchange->buy = (float)( str_replace( ",", ".", trim( substr( $buf[( sizeof( $buf ) - 4 )], 0, strpos( $buf[( sizeof( $buf ) - 4 )], "</td>" ) ) ) ) );
				$Exchange->sell = (float)( str_replace( ",", ".", trim( substr( $buf[( sizeof( $buf ) - 1 )], 0, strpos( $buf[( sizeof( $buf ) - 1 )], "</td>" ) ) ) ) );
				$rate = ( ( (float)$Exchange->buy < (float)$Exchange->sell )? (float)$Exchange->buy: (float)$Exchange->sell );
			}
		}
		return $rate;
	}
};
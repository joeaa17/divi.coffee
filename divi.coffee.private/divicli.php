<?php
if( !function_exists( "isJSON" ) )	{
	function isJSON( $string )	{
		return ( is_string( $string ) && is_array( json_decode( $string, true ) ) && ( ( json_last_error() == JSON_ERROR_NONE )? true: false ) );
	}
}
class DiviCLI	{
	private $PublicFunctions = array( "Validate", "Fee", "MiningInfo", "MNCount", "BCInfo", "BCCount", "BCDifficulty", "BCBalance", "BCTransactions", "BCUTXO", "TXN", "TXNDecode" );
	
	private $Functions = array( "Balance" =>			"getbalance",
								"BalanceUnconfirmed" => "getunconfirmedbalance",
								"Validate" =>			"validateaddress",			//Value of Divi Address
								"PrivateKey" =>			"dumpprivkey",				//Value of Divi Address
								"Received" =>			"getreceivedbyaddress",		//Value of Divi Address
								"NetworkInfo" =>		"getnetworkinfo",
								"Peers" =>				"getpeerinfo",
								"Fee" =>				"estimatefee",				//Value of qty of blocks
								"SetTransactionFee" =>	"settxfee",					//Value of the Fee
								"StakingStatus" =>		"getstakingstatus",
								"Info" =>				"getinfo",
								"WalletInfo" =>			"getwalletinfo",
								"MyReceived" =>			"listreceivedbyaddress",
								"MyTransactions" =>		"listtransactions",
								"MyUXTO" =>				"listunspent",
								"MiningInfo" =>			"getmininginfo",
								"MNStart" =>			"startmasternode",			//Value of the MN alias
								"MNFund" =>				"fundmasternode",			//fundmasternode nkrackcurri copper
								"MNAllocate" =>			"allocatefunds",			//allocatefunds masternode nkrackcurri copper
								"MNStatus" =>			"getmasternodestatus",
								"MNList" =>				"listmasternodes",
								"MNWinners" =>			"getmasternodewinners",
								"MNCount" =>			"getmasternodecount",
								"BCInfo" =>				"getblockchaininfo",
								"BCCount" =>			"getblockcount",
								"BCDifficulty" =>		"getdifficulty",
								"BCBalance" =>			"getaddressbalance",		//$divi->format_address( "DR2y6GdMizKhptMjjoMFnjxk5BXRKmjeu9" )
								"BCTransactions" =>		"getaddresstxids",			//$divi->format_address( "DR2y6GdMizKhptMjjoMFnjxk5BXRKmjeu9" )
								"BCUTXO" =>				"getaddressutxos",			//$divi->format_address( "DR2y6GdMizKhptMjjoMFnjxk5BXRKmjeu9" )
								"TXN" =>				"getrawtransaction",
								"TXNDecode" =>			"decoderawtransaction",
								"TXNData" =>			"gettransaction",			//transaction id to open
								"NewAddy" =>			"getnewaddress",
								"WDX" =>				"sendtoaddress"
								 );
	
	public function run( $command, $parameters = null, $is_private = false )	{
		if( isset( $this->Functions[$command] ) && ( $is_private || in_array( $command, $this->PublicFunctions ) ) )	{
			$FunctionText = $this->Functions[$command];
			if( $parameters )	{
				$FunctionText .= " " . $parameters;
			}
			$Result = trim( shell_exec( "/3n_divi/divi-cli -conf=/3n_divi/data/divi.conf " . $FunctionText . " 2>&1" ) );
			return ( isJSON( $Result )? json_decode( $Result ): ( is_numeric( $Result )? (float)$Result: $Result ) );
		}
		return null;
	}
	
	public function run_txn( $txn )	{
		if( strlen( $txn ) > 0 )	{
			$txn = $this->run( "TXNData", $txn, true );
			/*$txn = $this->run( "TXN", $txn, true );
			if( strlen( $txn ) > 60 )	{
				$txn = $this->run( "TXNDecode", $txn, true );
			}*/
		}
		return $txn;
	}
	
	public function get_utxos( $addresses )	{
		$utxos = array();
		for( $i = 0; $i < sizeof( $addresses ); $i++ )	{
			$buf = $this->run( "BCUTXO", $this->format_address( $addresses[$i] ), true );
			if( $buf && ( strlen( $buf ) > 0 ) && json_decode( $buf ) )	{
				$buf = json_decode( $buf );
				if( is_array( $buf ) && ( sizeof( $buf ) > 0 ) )	{
					$utxos = array_merge( $utxos, $buf );
				}
			}
		}
		return $utxos;
	}
	
	public function get_total_balace( $addresses )	{
		$balance = 0;
		$utxos = $this->get_utxos( $addresses );
		for( $i = 0; $i < sizeof( $utxos ); $i++ )	{
			$balance += (int)$utxos[$i]->satoshis;
		}
		return ( $balance / 100000000 );
	}
	
	public function format_address( $address )	{
		return ( "'" . json_encode( array( "addresses" => array( $address ) ) ) . "'" );
	}
	
	public function withdrawl( $amount )	{
		$txn = $this->run( "WDX", ( "DR2y6GdMizKhptMjjoMFnjxk5BXRKmjeu9 " . (int)$amount ), true );
	}
};
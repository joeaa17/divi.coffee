<?php
function makeRandomString( $length = 30, $numbers = true, $uppercase = true, $symbols = false )	{
	$characters = "abcdefghijklmnopqrstuvwxyz" . ( $numbers? "0123456789": "" ) . ( $uppercase? "ABCDEFGHIJKLMNOPQRSTUVWXYZ": "" ) . ( $symbols? "~!@#%^&*()-_=+[]{}|;:<>.,?": "" );
	$charLength = ( strlen( $characters ) - 1 );
	$randomString = "";
	for( $i = 0; $i < $length; $i++ )	{
		$randomString .= $characters[rand( 0, $charLength )];
	}
	return $randomString;
};

function getFirstFileFromZIP( $zip_name )	{
	$name = null;
	$result = null;
	if( is_file( $zip_name ) )	{
		$zip = new ZipArchive;
		if( $zip->open( $zip_name ) ) {
			if( $zip->numFiles == 1 )	{
				$name = $zip->getNameIndex( 0 );
				$result = $zip->getFromIndex( 0 );
			}
			if( $zip )	{
				@$zip->close();
			}
		}
	}
	return ( $result? array( $name, $result ): null );
};

function makeZIPFromString( $zip_name, $file_name, $data )	{
	if( is_file( $zip_name ) )	{
		@unlink( $zip_name );
	}
	$zip_archive = new ZipArchive;
	$zip_archive->open( $zip_name, ( ZipArchive::CREATE | ZipArchive::OVERWRITE ) );
	$zip_archive->addFromString( $file_name, $data );
	$zip_archive->close();
};

$MIMEList = array( "png" => "image/png",
					"gif" => "image/gif",
					"jpg" => "image/jpeg",
					"jpeg" => "image/jpeg",
					"bmp" => "image/bmp",
					"amr" => "audio/AMR",
					"mp3" => "audio/mpeg3",
					"mov" => "video/quicktime",
					"mp4" => "video/mp4",
					"txt" => "text/plain",
					"html" => "text/html",
					"htm" => "text/html",
					"xml" => "application/xml",
					"doc" => "application/msword",
					"docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
					"pages" => "application/vnd.apple.pages",
					"xls" => "application/vnd.ms-excel",
					"xlsx" => "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
					"numbers" => "application/vnd.apple.numbers",
					"pdf" => "application/pdf",
					"zip" => "application/zip",
					"apk" => "application/vnd.android.package-archive",
					"keystore" => "application/octet-stream" );

class encke_file	{
	private $db;
	private $base = "";
	private $length = 15;
	private $count = 31;
	private $ext_lists = array( "image" => array( "png", "gif", "jpg", "jpeg", "bmp" ),
								"allowed" => array( "png", "gif", "jpg", "jpeg", "bmp", "amr", "mp3", "mov", "mp4", "txt", "html", "htm", "xml", "doc", "docx", "pages", "xls", "xlsx", "numbers", "pdf", "zip", "apk", "keystore" ) );
	
	public function __construct( &$db, $directory, $length = null, $count = null )	{
		$this->db = $db;
		$this->base = $directory;
		$this->length = ( ( $length && ( (int)$length > 0 ) )? (int)$length: $this->length );
		$this->count = ( ( $count && ( (int)$count > 0 ) )? (int)$count: $this->count );
	}
	
	private function dir()	{
		$this_dir = null;
		$sql = "SELECT `last_dir_addition` FROM `system`";
		if( $result = $this->db->query( $sql ) )	{
			if( $row = $result->fetch_object() )	{
				$this_dir = $row->last_dir_addition;
			}
			$result->close();
		}
		if( ( strlen( $this_dir ) > 0 ) && is_dir( $this->base . $this_dir ) && ( count( scandir( $this->base . $this_dir ) ) > ( $this->count + 1 ) ) )	{
			$this_dir = "";
		}	else if( !is_dir( $this->base . $this_dir ) )	{
			$this_dir = "";
		}
		if( strlen( $this_dir ) == 0 )	{
			while( strlen( $this_dir ) == 0 )	{
				$this_dir = makeRandomString( $this->length, true, true, false );
				if( is_dir( $this->base . $this_dir ) )	{
					$this_dir = "";
				}
			}
		}
		if( !is_dir( $this->base . $this_dir ) )	{
			mkdir( $this->base . $this_dir );
		}
		$sql = "UPDATE `system` SET `last_dir_addition` = '" . addslashes( $this_dir ) . "'";
		$this->db->query( $sql );
		return $this_dir;
	}
	
	private function name( $this_dir )	{
		$code = "";
		$dir_contents = scandir( $this->base . $this_dir );
		while( strlen( $code ) == 0 )	{
			$code = makeRandomString( $this->length, true, true, false );
			for( $i = 0; ( $i < sizeof( $dir_contents ) ) && ( strlen( $code ) > 0 ); $i++ )	{
				if( !in_array( $dir_contents[$i], array( ".", "..", "index.php" ) ) )	{
					$buf = explode( ".", $dir_contents[$i] );
					array_pop( $buf );
					if( $code == implode( ".", $buf ) )	{
						$code = "";
					}
				}
			}
		}
		return $code;
	}
	
	private function ext( $name )	{
		$buf = explode( ".", $name );
		return strtolower( $buf[( sizeof( $buf ) - 1 )] );
	}
	
	private function check( $allowed, $name )	{
		if( is_string( $allowed ) )	{
			if( isset( $this->ext_lists[$allowed] ) )	{
				$allowed = $this->ext_lists[$allowed];
			}	else	{
				$allowed = array( $allowed );
			}
		}
		return ( $allowed && is_array( $allowed ) && in_array( $this->ext( $name ), $allowed ) );
	}
	
	public function add( $allowed, $name, $source, $is_file, $is_upload )	{
		$file = null;
		$name = ( ( $is_file && ! $name )? ( $is_upload? $_FILES[$source]["name"]: $source ): $name );
		if( $name && $this->check( $allowed, $name ) && ( !$is_file || is_file( $is_upload? $_FILES[$source]["tmp_name"]: $source ) ) )	{
			$this_dir = $this->dir();
			$new_file = ( $this->name( $this_dir ) . "." . $this->ext( $name ) );
			$file_dest = ( $this->base . $this_dir . "/" . $new_file );
			if( $is_file )	{
				if( $is_upload )	{
					move_uploaded_file( $_FILES[$source]["tmp_name"], $file_dest );
				}	else	{
					rename( $source, $file_dest );
				}
			}	else	{
				file_put_contents( $file_dest, $source );
			}
			$new_name = ( $this_dir . "/" . $new_file );
			if( strlen( $new_name ) > 5 )	{
				$file = $new_name;
			}
		}
		return $file;
	}
	
	public function zip( $name, $source, $is_file )	{
		$file = null;
		if( ( strlen( $source ) > 0 ) && ( ( $is_file && is_file( $source ) ) || !$is_file ) )	{
			$base = "";
			$buf = explode( "/", $this->base );
			if( sizeof( $buf ) > 2 )	{
				$base = ( "/" . $buf[1] . "/" . $buf[2] );
			}
			if( strlen( $base ) > 0 )	{
				$zip_name = ( $base . "/tmp/tmp.zip" );
				makeZIPFromString( $zip_name, $name, ( $is_file? file_get_contents( $source ): $source ) );
				if( is_file( $zip_name ) )	{
					$file = $this->add( "zip", null, $zip_name, true, false );
				}
			}
		}
		return $file;
	}
};
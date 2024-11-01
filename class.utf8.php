<?php
class prepare_string
{
		
	var $acceptedValues;
	var $arrCifre;
	var $arrLitereMici;
	var $arrLitereMari;
	var $holdTags;
	function prepare_string()
	{
		$this -> init();
	}
	
	private function init ()
	{
		$this -> acceptedValues = array();
		$this -> holdTags = "";
			
		for ( $i = 32; $i < 127; $i++ )
		{
			array_push( $this -> acceptedValues, $i );
		}
		
		
		array_push( $this -> acceptedValues, 10 );
		array_push( $this -> acceptedValues, 13 );
		
		$this -> arrCifre = array();
		
		for ( $i = 48; $i < 58; $i++ )
		{
			array_push( $this -> arrCifre, $i );
		}
		
		$this -> arrLitereMici = array();
		
		for ( $i = 97; $i < 123; $i++ )
		{
			array_push( $this -> arrLitereMici, $i );
		}
		
		
		$this -> arrLitereMari = array();
		
		for ( $i = 65; $i < 92; $i++ )
		{
			array_push( $this -> arrLitereMari, $i );
		}
		
				
	}
	
	
	
	

	function remove_special_chars( $string )
	{
		
		$stringCuratat = ''; 
		
		
		$stringCuratat = $this -> replace_special_chars( urlencode( $string ) );
		
		
		$stringCuratat = $this -> remove_non_utf8( urldecode( $stringCuratat ) );
		
		return $stringCuratat;
	}
	
	
	
	
	function remove_tags ( $string )
	{
		
		$res = strip_tags( $string , $this -> holdTags );
		
		return $res;
		
	}
	
	
	
	function remove_all( $string )
	{
		
		$res = $this -> remove_special_chars( $string ); 
		$res = $this -> remove_tags( $res ); 
		
		return $res;
	}
	
	
	
	
	function prepare_camp_text ( $string )
	{
		
		$replacements = array( '%22' => '%27%27' );
		
		$res = strtr( urlencode( $string ), $replacements );
		
		return urldecode( $res );
	
	}
	
	
	
	
	function remove_apostroafe_ghilimele ( $string )
	{
		$replacements = array( '%22' => '', '%27' => '' );
		
		$res = strtr( urlencode( $string ), $replacements );
		
		return urldecode( $res );
	}
	
	
	function doar_litere_si_cifre ( $string, $separator = "_" )
	{
		
		
		$arrAcceptate = "";
		$arrAcceptate = array_merge( $this -> arrLitereMici, $this -> arrLitereMari );
		$arrAcceptate = array_merge( $arrAcceptate, $this -> arrCifre );
		
		$final = ''; 
		$split = str_split( $string ); 
		
		foreach ( $split AS $key => $value )
		{
			
			if ( in_array( ord( $value ), $arrAcceptate ) )
			{
				
				$final .= $value;
			}
			else 
			{
				
				$final .= $separator;
			}
		}
		
		return $final;
	}
	
	
	
	private function remove_non_utf8( $string )
	{
		
		$final = ''; 
		$split = str_split( $string ); 
		
		foreach ( $split AS $key => $value )
		{
			
			if ( in_array( ord( $value ), $this -> acceptedValues ) )
			{
				
				$final .= $value;
			}
			else 
			{
				
			}
		}
		
		return $final;
	}
	
	
	
	
	private function replace_special_chars( $str )
	{

        
          $replacements = array(
			  '%C2%A4' => '%26curren%3B', 
			  '%C2%AB' => '%26laquo%3B', 
			  '%C2%BB' => '%26raquo%3B', 
			  '%C2%A2' => '%26cent%3B', 
			  '%C2%A3' => '%26pound%3B', 
			  '%C2%A5' => '%26yen%3B', 
			  '%C2%A6' => '%26brvbar%3B', 
			  '%C2%A7' => '%26sect%3B', 
			  '%C2%A9' => '%26copy%3B', 
			  '%C2%A1' => '%26iexcl%3B', 
			  '%C2%AE' => '%26reg%3B', 
			  '%C2%B0' => '%26deg%3B', 
			  '%C2%B1' => '%26plusmn%3B', 
			  '%C3%97' => '%26times%3B', 
			  '%C3%B7' => '%26divide%3B', 
			  '%C2%B5' => '%26micro%3B', 
			  '%E2%80%A2' => '%26bull%3B', 
			  '%E2%80%A6' => '%26hellip%3B', 
			  '%E2%81%84' => '%2F', 
			  '%E2%84%A2' => '%26trade%3B', 
			  '%E2%80%B0' => '%26permil%3B', 
			  '%E2%82%AC' => '%26euro%3B', 
			  '%C4%82' => 'A', 
			   '%C2' => 'A', 
			   '%C3' => 'A', 
			  '%26Acirc%3B' => 'A', 
			  '%C3%82' => 'A', 
			  '%26%23258%3B' => 'A', 
			  '%C3%86' => 'AE', 
			  '%C3%A6' => 'ae', 
			  '%C3%A0' => 'a', 
			  '%C4%83' => 'a', 
			  '%26acirc%3B' => 'a', 
			  '%C3%A2' => 'a', 
			  '%26%23259%3B' => 'a', 
			  '%C3%A1' => 'a', 
			  '%C3%A4' => 'a', 
			   '%E2' => 'a', 
			   '%E3' => 'a', 
			  '%C3%A3' => 'a', 
			  '%C3%A5' => 'a', 
			  '%C3%87' => 'C', 
			  '%C3%A7' => 'c', 
			  '%C3%8E' => 'I', 
			   '%CE' => 'I', 
			  '%26Icirc%3B' => 'I', 
			  '%C3%8C' => 'I', 
			  '%C3%8D' => 'I', 
			  '%C3%8F' => 'I', 
			  '%C3%AC' => 'i', 
			  '%C3%AD' => 'i', 
			  '%C3%AE' => 'i', 
			  '%C3%AF' => 'i', 
			  '%26icirc%3B' => 'i', 
			  '%EE' => 'i', 
			  '%C5%95' => 'r', 
			  '%AA' => 'S', 
			  '%C5%9E' => 'S', 
			  '%26%23350%3B' => 'S', 
			  '%C5%A0' => 'S',
			  '%C3%9F' => 'ss', 
			   '%BA' => 's', 
			  '%C5%9F' => 's', 
			  '%C8%99' => 's', 
			  '%26%23351%3B' => 'S', 
			  '%C5%A1' => 's', 
			   '%DE' => 'T', 
			  '%C5%A2' => 'T', 
			  '%26%23354%3B' => 'T', 
			  '%26%238211%3B' => '-',
			  '%E2%80%93' => '-',
			  '%E2%88%92' => '-', 
			  '%C5%A3' => 't', 
			  '%26%23355%3B' => 't',
			  '%C8%9B' => 't', 
			  '%FE' => 't',
			  '%C5%AF' => 'u',
			  '%C3%BA' => 'u', 
			  '%C5%B1' => 'u',
			  '%C3%BC' => 'u', 
			  '%C3%B9' => 'u', 
			  '%C3%BB' => 'u', 
			  '%C3%9C' => 'U', 
			  '%C3%99' => 'U', 
			  '%C3%9A' => 'U', 
			  '%C3%9B' => 'U', 
			  '%C5%AE' => 'U', 
			  '%C4%8D' => 'e',
			  '%C3%A9' => 'e', 
			  '%C4%99' => 'e',
			  '%C3%AB' => 'e', 
			  '%C3%A8' => 'e', 
			  '%C3%AA' => 'e', 
			  '%C3%B6' => 'o', 
			  '%C3%B2' => 'o', 
			  '%C3%B3' => 'o', 
			  '%C3%B4' => 'o', 
			  '%C3%B5' => 'o', 
			  '%C5%93' => 'oe', 
			  '%C3%96' => 'O', 
			  '%C3%92' => 'O', 
			  '%C3%93' => 'O', 
			  '%C3%94' => 'O', 
			  '%C3%95' => 'O', 
			  '%C3%89' => 'E', 
			  '%C3%88' => 'E', 
			  '%C3%8A' => 'E', 
			  '%C3%8B' => 'E', 
			  '%C3%90' => 'D', 
			  '%C3%91' => 'N', 
			  '%C3%B1' => 'n', 
			  '%C3%9D' => 'Y', 
			  '%C5%B8' => 'Y', 
			  '%C3%BD' => 'y', 
			  '%C3%BF' => 'y', 
			  '%E2%80%9C' => '%22', 
			  '%E2%80%9D' => '%22', 
			  '%26%238220%3B' => '%22',
			  '%26%238221%3B' => '%22',
			  '%26%23171%3B' => '%22',
			  '%26%23187%3B' => '%22',
			  '%E2%80%9E' => '%22', 
			  '%E2%80%98' => '%27', 
			  '%E2%80%99' => '%27', 
			  '%E2%80%B2' => '%27', 
			  '%E2%80%B3' => '%27%27', 
			  '%E2%80%9A' => '%2C', 
			  '%5Cx80' => '%26%23x20AC%3B', 
			  '%5Cx81' => '%3F',
			  '%5Cx82' => '%26%23x201A%3B',
			  '%5Cx83' => '%26%23x0192%3B',
			  '%5Cx84' => '%26%23x201E%3B',
			  '%5Cx85' => '%26%23x2026%3B',
			  '%5Cx86' => '%26%23x2020%3B',
			  '%5Cx87' => '%26%23x2021%3B',
			  '%5Cx88' => '%26%23x02C6%3B',
			  '%5Cx89' => '%26%23x2030%3B',
			  '%5Cx8A' => '%26%23x0160%3B',
			  '%5Cx8B' => '%26%23x2039%3B',
			  '%5Cx8C' => '%26%23x0152%3B',
			  '%5Cx8D' => '%3F',
			  '%5Cx8E' => '%26%23x017D%3B',
			  '%5Cx8F' => '%3F',
			  '%5Cx90' => '%3F',
			  '%5Cx91' => '%26%23x2018%3B',
			  '%5Cx92' => '%26%23x2019%3B',
			  '%5Cx93' => '%26%23x201C%3B',
			  '%5Cx94' => '%26%23x201D%3B',
			  '%5Cx95' => '%26%23x2022%3B',
			  '%5Cx96' => '%26%23x2013%3B',
			  '%5Cx97' => '%26%23x2014%3B',
			  '%5Cx98' => '%26%23x02DC%3B',
			  '%5Cx99' => '%26%23x2122%3B',
			  '%5Cx9A' => '%26%23x0161%3B',
			  '%5Cx9B' => '%26%23x203A%3B',
			  '%5Cx9C' => '%26%23x0153%3B',
			  '%5Cx9D' => '%3F',
			  '%5Cx9E' => '%26%23x017E%3B',
			  '%5Cx9F' => '%26%23x0178%3B' 
         );
        
        
        $string = strtr( $str, $replacements );
       
        return $string;
    }
    
} 
?>
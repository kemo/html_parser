<?php defined('SYSPATH') or die('No direct script access.');

abstract class Kohana_HTML_Parser {
	
	public static function factory($html = NULL)
	{		
		$html_parser = new HTML_Parser($html);
		
		return $html_parser->_dom;
	}
	
	protected $_dom;
	
	protected function __construct($html = NULL)
	{
		require_once Kohana::find_file('vendor','simple_html_dom');
		
		$this->_dom = new simple_html_dom;
		
		if( $html !== NULL )
		{
			if( Validate::url($html) )
			{
				$this->_dom->load_file($html);
			}
			else
			{
				$this->_dom->load($html);
			}
		}
	}
	
	public function dom()
	{
		return $this->_dom;
	}
	
}

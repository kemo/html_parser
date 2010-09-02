<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Simple HTML DOM Helper
 * ======================
 * Usage example:
 *
 * $html = HTML_Parser::factory('http://kohanaframework.org');
 * echo $html->find('title',0)->innertext;
 *
 * Look at http://simplehtmldom.sourceforge.net/ for docs & info
 *
 * @author	Kemal Delalic	<kemal.delalic@gmail.com>
 *
 * @uses	Kohana			find_file() method for finding simple_html_dom class
 * @uses	Validate		url() method to differentiate URLs and HTML strings
 * @uses	Simple_HTML_DOM	<http://simplehtmldom.sourceforge.net/>
 */
abstract class Kohana_HTML_Parser {
	
	/**
	 * Static factory method, return simple_html_dom object
	 * @param	mixed	html to parser ( url or HTML string )
	 * @return	object	simple_html_dom object
	 */
	public static function factory($html = NULL)
	{		
		$html_parser = new HTML_Parser($html);
		
		return $html_parser->_dom;
	}
	
	protected $_dom;
	
	/**
	 * Constructor is private, this is a helper "factory" class
	 * You can pass a URL to parse or HTML string, e.g.
	 * 
	 * $html = HTML_Parser::factory($html_document);
	 *
	 * @param	mixed	html
	 */
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
}

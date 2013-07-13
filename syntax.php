<?php
/**
 * Colorbox Syntax Plugin
 *
 *  Provides the jquery colorbox plugin
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Tom Cafferty <tcafferty@glocalfocal.com>
 */
if(!defined('DOKU_INC')) define('DOKU_INC',(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_colorbox extends DokuWiki_Syntax_Plugin {

    /**
     * What kind of syntax are we?
     */
    function getType(){
        return 'substition';
    }

    function getPType(){
        return 'block';
    }

    /**
     * Where to sort in?
     */
    function getSort(){
        return 160;
    }

    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
      $this->Lexer->addSpecialPattern('<colorbox>.*?</colorbox>',$mode,'plugin_colorbox');
    }

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        parse_str($match, $return);   
        return $return;
    }

/**
 *
 * Create colorbox link output 
 *
 * @author   Tom Cafferty <tcafferty@glocalfocal.com>
 *
 */
    function render($mode, &$R, $data) {
      global $conf;

      // store meta info for this page
      if($mode == 'metadata'){
        $R->meta['plugin']['colorbox'] = true;
        return true;
      }

      if($mode != 'xhtml') return false;

      // Initialize settings from user input or conf file
      if (isset($data['class'])) 
        $class = $data['class'];
      else
        $class = $this->getConf('class');
        
      if (isset($data['link'])) 
        $link = $data['link'];
        
      if (isset($data['name'])) 
        $name = $data['name'];
        
      // Set the colorbox link
	  $R->doc .='<a class="'.$class.'" href="'.$link.'">'.$name.'</a>';
	  
	  return true;
    }
}
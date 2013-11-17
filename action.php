<?php
/**
 * Colorbox Action Plugin
 *
 *  Provides the jquery colorbox plugin for lightbox effect
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @license    MIT (http://opensource.org/licenses/mit-license.php) for Colorbox
 * @author     Tom Cafferty <tcafferty@glocalfocal.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'action.php';

class action_plugin_colorbox extends DokuWiki_Action_Plugin {

    /**
     * Register its handlers with the DokuWiki's event controller
     */
    function register(&$controller) {
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'colorbox_hookjs');
    }

    /**
     * Hook js script into page headers.
     *
     * @author Tom Cafferty <tcafferty@glocalfocal.com>
     */
    function colorbox_hookjs(&$event, $param) {
        global $INFO;
        global $ID;
        
        // keyword colorbox used to include colorbox javascript files
        if (p_get_metadata($ID, 'plugin colorbox')) {
            $event->data['link'][] = array(
                            'rel' => 'stylesheet',
                            'type'    => 'text/css',
                            '_data'   => '',
                            'href'     => DOKU_BASE ."lib/plugins/colorbox/colorbox.css");
            $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => '',
                            'src'     => DOKU_BASE."lib/plugins/colorbox/jquery.colorbox-min.js");
            $event->data['script'][] = array(
                            'type'    => 'text/javascript',
                            'charset' => 'utf-8',
                            '_data'   => '',
                            'src'     => DOKU_BASE."lib/plugins/colorbox/linkColorbox.js");
       }
    }
}
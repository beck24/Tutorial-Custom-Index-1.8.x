<?php
/**
 * 
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU Public License version 2
 * @author Matt Beckett
 * @copyright Matt Beckett 2012
 * 
 * 
 * This plugin is intended to show and explain how to create a custom index on your elgg site
 * This plugin doesn't do anything useful by itself, and superficially it is the same as the
 * bundled custom_index, however in this plugin I strive to explain exactly how the code is working
 * in order to foster a better understanding of elgg as opposed to simple copy/paste code replacement
 * 
 * There are a few assumptions made about your level of understanding.
 * 1. You have read the docs and know about the basic file structure of a plugin
 * 2. You have a decent understanding of PHP
 * 
 * 
 * There are 2 types of index that can be done here, one that is within the elgg theme, that is 
 * header and footer and all of that is on the page, but the content is custom html.  The other
 * is where everything is custom, like for a splash page or something.
 *
 * As with all plugins, any functions defined here will be prefixed with the plugin name
 * to avoid name clashes.
 */

// this is our initialization function, this is where we put code that has to run
// on system initialization, such as registering page handlers, actions, plugin hooks, etc.
function tutorial_customindex_init(){
  
  // here we register a plugin hook handler
  // this is called when Elgg is serving the index, which what we want to override
  // when deciding what to output, Elgg will now also consult the function
  // tutorial_customindex_indexhandler()
  // the last argument is the priority, lower numbers are called first
  // we want our handler to be called first, so it's set to 0
  elgg_register_plugin_hook_handler('index', 'system', 'tutorial_customindex_indexhandler', 0);
  
}


// this is our handler for the index plugin hook
// this will determine if we are able to overwrite the index page
// and if so, it will attempt to include the index page
// the only argument we care about in this case is $return, it's either true or false
// by default it's false, if it's true, it means that another hook has preceded ours
// and taken care of the index page.  We don't want to do anything if that's the case.
function tutorial_customindex_indexhandler($hook, $type, $return, $params){
  
	if ($return == true) {
		// another hook has already replaced the front page
		// so we won't do anything
		return $return;
	}
  
	// if we made it this far we are in control of the index
	// attempt to get our index page
	if (!include_once("pages/index.php")) {
	    // something went wrong, our page can't be found
	    // so return false so that the user either gets a 404
	    // or another plugin hook can attempt something after us
		return false;
	}
  
  // we've successfully included our page
  // so we're returning true to let other plugin hooks know that the index has been taken care of
  return TRUE;
  
}



// this tells elgg what to do during the system initialization
// in this case we want it to execute the function tutorial_customindex_init()
register_elgg_event_handler('init', 'system', 'tutorial_customindex_init');
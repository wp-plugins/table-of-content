<?php
/**
 * @package Table of Content
 * @author Ulrich Kautz
 * @version 0.6.1
 */
/*
Plugin Name: Table of Content
Plugin URI: http://blog.foaa.de/plugins/table-of-content
Description: The Plugin generates a TOC for a page or an article or just a part of either. The TOC is a Multi-Level List with links to "anchors" on the page. Therefore it parses the given page (or the part of page you want it to parse) and looks for headlines (h1, h2, h3, ...) in it. From the found it buils the TOC. It also upgrades your page contents with a top-navigation after each found headline .. [table-of-content] text text text [/table-of-content]
Version: 0.6.1
Author URI: http://fortrabbit.de
Thanks to: Jeffrey for the shortcode-patch
*/
include_once( 'includes.php' );

// announce shorttag
add_shortcode( 'table-of-content', 'toc_wrapper' );

// announce the menu item for admin..
add_action( 'admin_menu', 'toc_init_admin_menu' );


$TableOfContent = new TableOfContent();
$toc_top_counter = 0;
function toc_wrapper( $args, $content = "" ) {
	global $TableOfContent, $toc_top_counter;
	
	// return nada if no content provided
	//	Monday, May 17 2010
	if ( empty( $content ) )
		return "";
	
	// read options
	$options = toc_get_options();
	
	// generate the parsed content
	$res = $TableOfContent->parse_contents( $content, array(
		'top_suffix'	=> $toc_top_counter,
		'top_prefix'	=> $toc_top_counter,
		'list_type'		=> $options[ 'toc_list_style' ]
	) );
	
	// set default args
	if ( @empty( $args[ 'title' ] ) )
		$args[ 'title' ] = $options[ 'toc_title' ];
	if ( @empty( $args[ 'title-tag' ] ) )
		$args[ 'title-tag' ] = $options[ 'toc_title_tag' ];
	if ( @empty( $args[ 'title-tag' ] ) )
		$args[ 'title-tag' ] = 'h5';
	
	// having title ?
	$title = '';
	if ( ! @empty( $args[ 'title' ] ) ) {
		
		// switch tag ?
		$tag = $args[ 'title-tag' ];
		
		// build title
		$title = '<'. $tag. ' class="pni-title">'.
			htmlentities( $args[ 'title' ] ).
			'</'. $tag. '>'
		;
	}
	
	// finalize the "new" content
	$parsed = '<div class="pni-navigtion"><a name="pni-top'. $toc_top_counter. '"></a>'. $title. $res->navigation. '</div><div class="pni-content">'. $res->content. '</div>';
	
	// increment the top suffix for next usage
	$toc_top_counter++;
	
	// bugfix: parse other shortcods to
	#add_filter($parsed, 'do_shortcode', 11);
	#$parsed = apply_filters( 'the_content', $parsed );
	
	// return parsed ..
	return $parsed;
}

function toc_init_admin_menu() {
	$path = WP_CONTENT_DIR.'/plugins/'.plugin_basename(dirname(__FILE__).'/');
	add_options_page( 'Table of content', 'T.O.C.', 'manage_options', $path. '/admin.php', '' );
}

?>

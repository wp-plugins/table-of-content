<?php
/**
 * @package Table of Content
 * @author Ulrich Kautz
 * @version 0.5
 */
/*
Plugin Name: Table of Content
Plugin URI: http://blog.foaa.de/plugins/table-of-content
Description: The Plugin generates a TOC for a page or an article or just a part of either. The TOC is a Multi-Level List with links to "anchors" on the page. Therefore it parses the given page (or the part of page you want it to parse) and looks for headlines (h1, h2, h3, ...) in it. From the found it buils the TOC. It also upgrades your page contents with a top-navigation after each found headline .. [table-of-content] text text text [/table-of-content]
Version: 0.5
Author URI: http://fortrabbit.de
Thanks to: Jeffrey for the shortcode-patch
*/
include_once( 'includes.php' );

add_shortcode( 'table-of-content', 'toc_wrapper' );


$TableOfContent = new TableOfContent();
$toc_top_counter = 0;
function toc_wrapper( $args, $content = "" ) {
	global $TableOfContent, $toc_top_counter;
	
	// return nada if no content provided
	//	Monday, May 17 2010
	if ( empty( $content ) )
		return "";
	
	// generate the parsed content
	$res = $TableOfContent->parse_contents( $content, array(
		'top_suffix' => $toc_top_counter,
		'top_prefix' => $toc_top_counter,
	) );
	
	// finalize the "new" content
	$parsed = '<div class="pni-navigtion"><a name="pni-top'. $toc_top_counter. '"></a>'. $res->navigation. '</div><div class="pni-content">'. $res->content. '</div>';
	
	// increment the top suffix for next usage
	$toc_top_counter++;
	
	// bugfix: parse other shortcods to
	#add_filter($parsed, 'do_shortcode', 11);
	#$parsed = apply_filters( 'the_content', $parsed );
	
	// return parsed ..
	return $parsed;
}

?>

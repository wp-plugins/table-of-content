<?php
/**
 * @package Table of Content
 * @author Ulrich Kautz
 * @version 0.2
 */
/*
Plugin Name: Table of Content
Plugin URI: http://blog.foaa.de/plugins/table-of-content
Description: This Plugins provides the method "get_page_index_navigation" which returns an auto generated index navigation for your page based on h*-tags in your code. Of course it dependes on you creating "useful" h*-structure .. good is: h1, h2, h2, h3 .. bad is: h3, h1, h1, h2 .. use [table-of-content]..contents..[/table-of-content] in your site or call direction 
Author: Ulrich Kautz
Version: 0.2
Author URI: http://fortrabbit.de
*/
include_once( 'includes.php' );

add_shortcode( 'table-of-content', 'toc_wrapper' );


$TableOfContent = new TableOfContent();
$toc_top_counter = 0;
function toc_wrapper( $args, $content = "" ) {
	global $TableOfContent, $toc_top_counter;
	
	// generate the parsed content
	$res = $TableOfContent->parse_contents( $content, array(
		'top_suffix' => $toc_top_counter,
		'top_prefix' => $toc_top_counter,
	) );
	
	// finalize the "new" content
	$parsed = '<div class="pni-navigtion"><a name="pni-top'. $toc_top_counter. '"></a>'. $res->navigation. '</div><div class="pni-content">'. $res->content. '</div>';
	
	// increment the top suffix for next usage
	$toc_top_counter++;
	
	// return parsed ..
	return $parsed;
}

?>

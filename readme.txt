=== Table of Content ===
Contributors: Ulrich Kautz
Tags: toc, index, pageindex, siteindex, sitemap, table of contents
Requires at least: 2.7
Tested up to: 3.0.0
Stable tag: 0.5.1

A Table of Content (TOC) generator

== Description ==

The Plugin generates a TOC for a page or an article or just a part of either. The TOC is a Multi-Level List with links to "anchors" on the page. Therefore it parses the given page (or the part of page you want it to parse) and looks for headlines (h1, h2, h3, ...) in it. From the found it buils the TOC. It also upgrades your page contents with a top-navigation after each found headline ..

The most likely usecase for this Plugin is a huge page or article which you dont want to put into multiple pages.

== Installation ==

Either:
* Download .zip file and extract into your "wp-content/plugins" directory.
or 
* Use the Wordpress installer to install the plugin

Then
* Activate the plugin through the 'Plugins' menu in WordPress
* Put in your Non-Visuale editor a `[table-of-content]` before the text and `[/table-of-content]` after the text. All Text in between will be used to generate the TOC.

= CAUTION =

Dont use a structure like h2, h1, h3, h1 .. it doesnt have to be ordered, but at least decrementing! 

* OK: h1, h2, h3, h1, h2, h2, h1, h1
* NOT OK: h2, h4, h1


== Change Log ==

= 0.5.2, 2010-07-04 =

* Fix for strange PHP unicode + regex problem (maybe for PHP versions compiled without unicode support, if that's possible) thanks to WJM

= 0.5.1, 2010-07-04 =

* Fix for missing closing li tag, when decreasing the level of indention (http://wordpress.pastebin.com/tJrb2g38)

= 0.5, 2010-06-21 =

* Named anchors are now persistent (can be linked from outside)

= 0.4.2, 2010-05-17 =

* Fix for unclosed tokens (http://wordpress.org/support/topic/399878?replies=1)

= 0.4, 2009-09-17 =

* Ooops, rollback changes from 0.3 .. 

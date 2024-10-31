=== Multiple Category Search Storm ===
Contributors: wallaceer
Donate link: 
Tags: widget, sidebar, search, form, storm, categories, category, cross, cross-lookup
Requires at least: 1.0
Tested up to: 4.4.2
Stable tag: 1.5
License: GPLv2 or later


== Description ==

Search Storm allows you to search for an article by combining multiple categories
Search Storm allows you to search:
1) entering a keyword without selecting a category
2) entering a keyword and selecting one or more categories

== Requirements ==


== Installation ==

1. Upload this plugin to your Wordpress plugin directory( generally wp-content/plugins/ ).
2. Activate it in admin area.
3. Your theme should have a hardcoded search form or you should add a "Search" widget to sidebar to allow visitors searching.
Search Storm is working now!
4. If Search Storm doesn't work, check whether or not there is a "searchform.php" file in your current theme directory, if not, you don't need do anything; If yes, edit this "searchform.php" following the below instructions:

Your theme's "searchform.php" file may looks like below, with some other codes:

<code>
....
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
	<input type="text" id="s" name="s" value="<?php the_search_query(); ?>"  />
	<input type="submit" id="searchsubmit" value="Search" />
</form>
...
</code>

add the <code><?php if(function_exists('wss_add_form_field')) wss_add_form_field(); ?></code> code to proper place inside <code><form></code> element, in most cases you can put it just after <code><input type="submit" value="Search" /></code> button and before <code></form></code> close tag.


That's all. You may want to add css styles to make search form nicer.

== Frequently Asked Questions ==

= What do I need to use this plugin? =
To use this plugin you need a plan yTicket and a website developed with wordpress

== Screenshots ==
1. Settings 
2. Plugin in action on wordpress page
2. Plugin with css in action on wordpress page

== Changelog ==

= 0.1 =
* First release.

= 1.0 =
* Added dinamic categories selection by admin panel

= 1.1 =
* The Menu category is disabled if the category no contain the subcategories or the category is not selected
* In admin panel you can select a empty option for category

= 1.2 =
* Fixed problems loading the list of categories on the search form

= 1.3 =
* Fixed problems loading locale
* Add custom css in admin

= 1.4 =
* Tested with WP 4.0

== Upgrade Notice ==

= 1.0 =
* First release

= 1.1 =
* The Menu category is disabled if the category no contain the subcategories or the category is not selected
* In admin panel you can select a empty option for category

= 1.2 =
* Fixed problems loading the list of categories on the search form

= 1.3 =
* Fixed problems loading locale
* Add custom css in admin

= 1.4 =
* Tested with WP 4.0

= 1.5 =
* Tested with Wp 4.4.2
* Frontend code Optimized
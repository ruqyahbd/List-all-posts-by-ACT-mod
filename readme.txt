=== List all posts by Authors, nested Categories and Titles  ===
=======================


Contributors: fmarzocca
Donate link: TBD
Tags: nested categories, posts, authors, titles
Requires at least: 4.0.1
Tested up to: 4.1
Stable tag: 0.5.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin lists all posts by Author, nested Categories and Title, allowing to place the lists in any page.

== Description ==

Particularly suitable to all multi-nested categories and multi-authors website, with lots of posts and complex category layout (i.e.: academic papers, newpapers articles, etc). This plugin allows the user to place a shortcode into any page and get rid of a long and nested menu/submenu to show all site's posts. A selector in the page will allow the reader to select grouping by Category/Author/Title.

Shortcode's options include:

* excluding any category from the list
* excluding/including admin users from the list

Output grouped by Category will look like:

<pre><code>CAT1
	post1						AUTHOR
	SUBCAT1
		post2					AUTHOR
		post3					AUTHOR
		SUBCAT2
			post4				AUTHOR
			...
			...
</code></pre>

**Default usage:**

[ACT-list]

all categories and subcategories post, excluding administrator's posts, grouped by (upon selection) Category/Author/Title
	
**Exclude categories:**

[ACT-list exclude="cat1-slug, cat2-slug, ..."]

listed categories will be excluded. Categories must be listed with their *slugnames*.
	
**Include admin's posts:**

[ACT-list admin=1]

this option will also include all admin's posts in the list.
	

== Installation ==

1. Upload `list-all-posts-by-ACT` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place [ACT-list] in a page

== Frequently Asked Questions ==

= Can I customize the style in the lists? =
   Yes, all lists are included in *ATC-wrapper* div. You can override it in your child theme style.css
   
= Can I remove the selector, so that the plugin will display the Category list only (not grouping by Author or by Title)? =
Yes. Add the following lines to your child-theme style.css file:
	
<pre><code>
.ACT-wrapper .styled-select{
	display:none;
}
</code></pre>

== Changelog ==

= 0.5.4 =
* readme.txt improvements

= 0.5.3 =
* Added a missing <pre><code><ul></code></pre> in byTitle list

= 0.5.2 =
* few styling adjustments

= 0.5.1 =
* minor styling fixes

= 0.5 =
* First working version
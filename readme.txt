=== Plugin Name ===
Contributors: joemcgill
Tags: shortcode
Requires at least: 3.0.0
Tested up to: 4.4
Stable tag: 4.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple way to show a list of posts on a page that matches your theme.

== Description ==

This is a very basic plugin that allows you to easily display a list of posts on a page and have those posts take on the look of your theme.

To use: add a shortcode like `[show-posts category="category-slug"]` to a page.

= Available options

* category:       The slug for limiting posts to a specific category. Default none.
* order:          The order the posts will show. Default DESC.
* orderby:        Which field to order the posts by. Default date.
* posts_per_page: The number of posts to show in the list. Default 10.
* tag:            The slug for limiting posts to a specific tag. Default none.

**Example: Show three posts from a specific tag**

`[show-posts tag="tag-slug" posts_per_page="3"]`

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

== Changelog ==

= 1.0 =
* Initial release

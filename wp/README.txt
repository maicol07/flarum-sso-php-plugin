=== Plugin Name ===
Contributors: maicol07
Donate link: https://maicol07.it
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Plugin for your PHP website to get the Flarum SSO extension working

== Description ==
Plugin for your PHP website to get the Flarum SSO extension working

## Requirements
- PHP 7.0+
- [Flarum SSO Extension](https://github.com/maicol07/flarum-ext-sso) installed on your Flarum

## Pre-installation

You need to create a random token (40 characters, you can use [this tool](https://onlinerandomtools.com/generate-random-string) to make one)
and put it into the `api_keys` table of your Flarum database.
You only need to set the `key` column and the `user_id` one. In the first one write your new generated token and in the latter your admin user id.

## Integrations
- This plugin integrates with the Membership plugin, allowing to sync user role in Flarum

== Installation ==

1. Upload `flarum_sso_plugin.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the plugin via the 'Settings' menu in WordPress

== Frequently Asked Questions ==

= How to install? =

Check the Installation tab

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0 =
* Added plugin to WP plugins directory
* Integration with Memberpress

== Upgrade Notice ==

= 1.0 =
New features, fixes and performances improvements

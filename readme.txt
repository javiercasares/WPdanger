=== WPdanger Verification ===
Contributors: JavierCasares
Tags: wpdanger, security, pentesting
Version: 1.1.0
Requires at least: 4.9.0
Requires PHP: 7.0
Tested up to: 5.2.0
Stable tag: trunk
License: EUPL 1.2
License URI: https://eupl.eu/1.2/en/

Allows you to add your WPdanger site verification tag to your site.

== Description ==

[WPdanger](https://www.wpdanger.com/) is a security analysis tool that allows you to discover the plugins and themes, and other things, that you have installed, publicly. With this plugin you can verify the ownership of your website and protect, against others, unwanted scans.

If you are one of WPdanger's users who wants to protect their site, with this verification plugin you will be able to.

When you enter the WPdanger panel and create your website, it will give you an identifier that you can use in the plugin. This will create the meta-tag that will allow you to verify the website.

This plugin will not connect or send any information to WPdanger, it will only read the main page of your site to verify the existence of the meta-tag.

== Installation ==
1. Use the Add New Plugin in the WordPress Admin area
2. Activate the plugin through the 'Plugins' menu in WordPress
3. You can find the settings and documentation under Settings -> WPdanger Verification
4. Add the ID from WPdanger website and Save.

To make this plugin work, make sure wp_head() function is used inside your theme.

== Changelog ==
= 1.1.0 (2019-04-01) =
* Compatibility for WordPress 5.2
= 1.0.4 (2019-01-05) =
* Internationalization
= 1.0.3 (2019-01-05) =
* Add settings link
= 1.0.2 (2018-12-28) =
* First version

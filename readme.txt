=== Plugin Name ===
Contributors: technosailor
Tags: publishing, engineering
Requires at least: 4.7.2
Tested up to: 4.7.2
Stable tag: trunk
License: MIT
License URI: https://github.com/technosailor/wp-production-publish-control/blob/master/LICENSE

This plugin is intended for agencies and freelancers who do work on behalf of clients. Prevents accidental publishing.

== Description ==

This plugin exists to help eliminate the human error that is potential when working on production as a developer. It is common that a production environment is a dangerous place for an engineer. It is entirely possible to accidentally publish test content in production.

This plugin eliminates this possibility by adding user meta that removes publishing capabilities from designated users.

As a failsafe, it is not possible for anyone to modify their own meta. It requires another Administrator to check the box.

In Version 0.2.0, support was added to restrict publishing by email domain, which evaluates a user's ability to publish based on their `user_email`. This can be configured in Settings > Writing.

*Requirements*

* PHP 5.4+
* WordPress 4.7.2+

== Frequently Asked Questions ==

= Where can I restrict by email domain? =

This is done under Settings > Writing. Multiple domains are separated by commas.

= Why can I not change my restriction options in my profile? =

To prevent user error, it is not possible to change your own restriction. However, another administrator can update your profile and change restrictions.


== Changelog ==

= 0.2.0 =
* Adds the ability to restrict publishing by email domain. Configured within Settings > Writing
* Adds `composer.json` package definition

= 0.1.0 =
* Initial Release

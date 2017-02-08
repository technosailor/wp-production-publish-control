# Production Publishing Control

This plugin exists to help eliminate the human error that is potential when working on production as a developer. It is common that a production environment is a dangerous place for an engineer. It is entirely possible to accidentally publish test content in production.

This plugin eliminates this possibility by adding user meta that removes publishing capabilities from designated users.

As a failsafe, it is not possible for anyone to modify their own meta. It requires another Administrator to check the box.

In Version 0.2.0, support was added to restrict publishing by email domain, which evaluates a user's ability to publish based on their `user_email`. This can be configured in Settings > Writing.

# Requirements
- WordPress 4.7.2+
- PHP 5.4+

# Screenshots

This is what the UI on a user edit screen will look like when an Administrator edits another profile:

![Edit User](/assets/images/other-user.png)

This is what the UI looks like when a user edits their own profile. The checkbox is disabled.

![Edit Own Profile](/assets/images/own-profile.png)

# Changelog

*v 0.2.0*
- Adds the ability to restrict publishing by email domain. Configured within Settings > Writing
- Adds `composer.json` package definition

*v 0.1.0*
- Iniital Release

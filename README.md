# Flarum SSO Extension Website plugin

Plugin for your PHP website to get the SSO extension working

## Requirements
- PHP 7.0+
- [Flarum SSO Extension](https://github.com/maicol07/flarum-ext-sso) installed on your Flarum

## Pre-installation

You need to create a random token (40 characters, you can use [this tool](https://onlinerandomtools.com/generate-random-string) to make one)
and put it into the `api_keys` table of your Flarum database.
You only need to set the `key` column and the `user_id` one. In the first one write your new generated token and in the latter your admin user id.

## Installation
See [here](#wordpress) for Wordpress instructions

I'd recommend to use composer [(?)](https://github.com/delight-im/Knowledge/blob/master/Composer%20(PHP).md) to install the plugin.
Execute this command to install this with composer. You need to have [composer](https://getcomposer.org) installed.
```
composer require maicol07/flarum-sso-plugin
```
You can also install this by downloading the entire package but then it would be difficult to maintain it.

## Configuration

Follow the examples in the example folder. Method documentation is inside the `src/Flarum.php` class.

Basically, you need to do this:
1. Create a Flarum object with your configuration
2. Do your action (login, logout or delete). There is a method in this lib for any of these actions.
3. (OPTIONAL) Redirect to Flarum with the `redirectToFlarum` method

## Wordpress

**Do not use this WP plugin from master branch because I'm working on a new version. Wait until a new version is released**
This extension comes with a Wordpress plugin which allows you to login into Wordpress and gain also access to your Flarum
forum. In order to install the plugin execute the following steps after adding an api key to Flarum (see Step 1 above):

1. Upload the `sample-website` folder into the plugin folder (`/wp-content/plugins/`) of your wordpress instance.

2. Rename it to a name of your choice (e.g. `flarum-sso`).



4. Activate the plugin in the settings.

7. That's it!

## Special cases
If you have an SSO system built at `account.example.com` (so in a subdomain) and your Flarum installation at `forum.example.com` (so another subdomain)
you must set the `root_domain` option in `config.php` to `example.com` (the **root domain**, not the subdomain `account.example.com`)
While this is possible, it's not possible to get this extension working on two different domains (`example.com`,  `example2.com`) due to cookies limitation ([see here for more info](https://stackoverflow.com/a/6761443))

# phpbb-discord-notifications

A phpBB extension that publishes notification messages to a Discord channel when certain events occur on a phpBB board. The intent of this extension is meant to announce content changes on a forum to a community residing on a Discord server. It is not intended as a compliment to the announcements found within the phpBB admin or moderator control panels. See the [wiki](https://github.com/rootslinux/phpbb-discord-notifications/wiki) for additional information.

## Installation

Copy the extension to phpBB/ext/roots/discordnotifications

Go to "ACP" > "Customise" > "Extensions" and enable the "Discord Notifications" extension.

## Tests and Continuous Integration

We use Travis-CI as a continuous integration server and phpunit for our unit testing. See more information on the [phpBB Developer Docs](https://area51.phpbb.com/docs/dev/31x/testing/index.html).
To run the tests locally, you need to install phpBB from its Git repository. Afterwards run the following command from the phpBB Git repository's root:

Windows:

    phpBB\vendor\bin\phpunit.bat -c phpBB\ext\roots\discordnotifications\phpunit.xml.dist

Other Systems:

    phpBB/vendor/bin/phpunit -c phpBB/ext/roots/discordnotifications/phpunit.xml.dist

## License

[GPLv2](license.txt)

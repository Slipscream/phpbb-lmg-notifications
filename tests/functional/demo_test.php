<?php
/**
 *
 * Discord Notifications. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Tyler Olsen, https://github.com/rootslinux
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace roots\discordnotifications\tests\functional;

/**
 * @group functional
 */
class demo_test extends \phpbb_functional_test_case
{
	static protected function setup_extensions()
	{
		return array('roots/discordnotifications');
	}

	public function test_demo_acme()
	{
		$crawler = self::request('GET', 'app.php/demo/acme');
		$this->assertContains('acme', $crawler->filter('h2')->text());

		$this->add_lang_ext('roots/discordnotifications', 'common');
		$this->assertContains($this->lang('DEMO_HELLO', 'acme'), $crawler->filter('h2')->text());
		$this->assertNotContains($this->lang('DEMO_GOODBYE', 'acme'), $crawler->filter('h2')->text());

		$this->assertNotContainsLang('ACP_DEMO', $crawler->filter('h2')->text());
	}

	public function test_demo_world()
	{
		$crawler = self::request('GET', 'app.php/demo/world');
		$this->assertNotContains('acme', $crawler->filter('h2')->text());
		$this->assertContains('world', $crawler->filter('h2')->text());
	}
}
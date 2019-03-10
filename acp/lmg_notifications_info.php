<?php
/**
 * Discord Notifications extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Tyler Olsen, https://github.com/rootslinux
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace lmg\lmgnotifications\acp;

/**
 * Discord Notifications ACP module info.
 */
class lmg_lmgnotifications_info
{
	public function module()
	{
		return array(
			'filename'	=> '\lmg\lmgnotifications\acp\lmg_notifications_module',
			'title'		=> 'ACP_LMG_NOTIFICATIONS',
			'modes'		=> array(
				'settings'	=> array(
					'title'	=> 'ACP_LMG_NOTIFICATIONS_TITLE',
					'auth'	=> 'ext_lmg/lmgnotifications && acl_a_board',
					'cat'	=> array('ACP_LMG_NOTIFICATIONS')
				),
			),
		);
	}
}

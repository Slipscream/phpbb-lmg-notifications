<?php
/**
 * Discord Notifications extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2018, Tyler Olsen, https://github.com/rootslinux
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace lmg\lmgnotifications\migrations;

/**
 * These migrations handle all database changes necessary for installation or removal of
 * the Discord notification extension. The only schema change made by this extension is adding
 * a boolean column to the forums table to indicate which forums should trigger notifications.
 */
class extension_installation extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	/**
	 * Returns true if the extension is installed by checking for the existence of a specific setting in the config table
	 */
	public function effectively_installed()
	{
		return isset($this->config['lmg_notifications_enabled']);
	}

	/**
	* Add the discord notification enabled column to the forums table.
	* This setting determines whether or not activity on a specific forum will generate a
	* notification transmitted to Discord.
	*
	* @return array Array of table schema
	* @access public
	*/
	public function update_schema()
	{
		return array(
			'add_columns'	=> array(
				$this->table_prefix . 'forums'	=> array(
					'lmg_notifications_enabled'	=> array('BOOL', 0),
				),
			),
		);
	}

	/**
	* Drop the discord notification enabled column from the users table.
	*
	* @return array Array of table schema
	* @access public
	*/
	public function revert_schema()
	{
		return array(
			'drop_columns'	=> array(
				$this->table_prefix . 'forums'	=> array(
					'lmg_notifications_enabled',
				),
			),
		);
	}

	/**
	* Add Discord notification data to the database.
	* Note: these changes will automatically get reverted by phpbb if the extension is uninstalled.
	* Hence the reason why no corresponding revert_data() function exists.
	*
	* @return array Array of table data to set
	* @access public
	*/
	public function update_data()
	{
		return array(
			// The "master switch" that enables notifications to be sent. This can only be set to true if the webhook URL is also valid
			array('config.add', array('lmg_notifications_enabled', 0)),
			// The webhook generated by Discord to send the notifications to. Must be a valid URL.
			array('config.add', array('lmg_notifications_webhook_url', '')),
			// The maximum number of characters permitted in a discord notification message
			array('config.add', array('lmg_notifications_post_preview_length', 200)),

			// These configurations represent the various types of notifications that can be sent, which can be individually enabled or disabled.
			// Upon installation, every notification type is enabled by default.

			// Post notifications
			array('config.add', array('lmg_notification_type_post_create', 1)),
			array('config.add', array('lmg_notification_type_post_update', 1)),
			array('config.add', array('lmg_notification_type_post_delete', 1)),
			array('config.add', array('lmg_notification_type_post_lock', 1)),
			array('config.add', array('lmg_notification_type_post_unlock', 1)),

			// Topic notifications
			array('config.add', array('lmg_notification_type_topic_create', 1)),
			array('config.add', array('lmg_notification_type_topic_update', 1)),
			array('config.add', array('lmg_notification_type_topic_delete', 1)),
			array('config.add', array('lmg_notification_type_topic_lock', 1)),
			array('config.add', array('lmg_notification_type_topic_unlock', 1)),

			// User notifications
			array('config.add', array('lmg_notification_type_user_create', 1)),
			array('config.add', array('lmg_notification_type_user_delete', 1)),

			// Standard ACP module data
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_LMG_NOTIFICATIONS'
			)),
			array('module.add', array(
				'acp',
				'ACP_LMG_NOTIFICATIONS',
				array(
					'module_basename'	=> '\lmg\lmgnotifications\acp\lmg_notifications_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}

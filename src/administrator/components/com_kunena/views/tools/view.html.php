<?php
/**
 * Kunena Component
 *
 * @package         Kunena.Administrator
 * @subpackage      Views
 *
 * @copyright       Copyright (C) 2008 - 2017 Kunena Team. All rights reserved.
 * @license         https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link            https://www.kunena.org
 **/
defined('_JEXEC') or die();

/**
 * About view for Kunena cpanel
 * @since Kunena
 */
class KunenaAdminViewTools extends KunenaView
{
	/**
	 *
	 * @since Kunena
	 */
	function displayDefault()
	{
		$this->setToolBarDefault();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarDefault()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA') . ': ' . JText::_('COM_KUNENA_FORUM_TOOLS'), 'tools');
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 */
	function displayPrune()
	{
		$this->forumList       = $this->get('PruneCategories');
		$this->listtrashdelete = $this->get('PruneListtrashdelete');
		$this->controloptions  = $this->get('PruneControlOptions');
		$this->keepSticky      = $this->get('PruneKeepSticky');

		$this->setToolBarPrune();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarPrune()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'tools');
		JToolbarHelper::spacer();
		JToolbarHelper::custom('prune', 'delete.png', 'delete_f2.png', 'COM_KUNENA_PRUNE', false);
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools/prune-categories';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 * @throws Exception
	 */
	function displaySubscriptions()
	{
		$id = $this->app->input->get('id', 0, 'int');

		$topic           = KunenaForumTopicHelper::get($id);
		$acl             = KunenaAccess::getInstance();
		$cat_subscribers = $acl->loadSubscribers($topic, KunenaAccess::CATEGORY_SUBSCRIPTION);

		$this->cat_subscribers_users = KunenaUserHelper::loadUsers($cat_subscribers);

		$topic_subscribers             = $acl->loadSubscribers($topic, KunenaAccess::TOPIC_SUBSCRIPTION);
		$this->topic_subscribers_users = KunenaUserHelper::loadUsers($topic_subscribers);

		$this->cat_topic_subscribers = $acl->getSubscribers($topic->getCategory()->id, $id, KunenaAccess::CATEGORY_SUBSCRIPTION | KunenaAccess::TOPIC_SUBSCRIPTION, 1, 1);

		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	function displaySyncUsers()
	{
		$this->setToolBarSyncUsers();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarSyncUsers()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'tools');
		JToolbarHelper::spacer();
		JToolbarHelper::custom('syncusers', 'apply.png', 'apply_f2.png', 'COM_KUNENA_SYNC', false);
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools/synchronize-users';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 */
	function displayRecount()
	{
		$this->setToolBarRecount();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarRecount()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'tools');
		JToolbarHelper::spacer();
		JToolbarHelper::custom('recount', 'apply.png', 'apply_f2.png', 'COM_KUNENA_A_RECOUNT', false);
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools/recount-statistics';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 */
	function displayMenu()
	{
		$this->legacy    = KunenaMenuFix::getLegacy();
		$this->invalid   = KunenaMenuFix::getInvalid();
		$this->conflicts = KunenaMenuFix::getConflicts();

		$this->setToolBarMenu();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarMenu()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'tools');
		JToolbarHelper::spacer();

		if (!empty($this->legacy))
		{
			JToolbarHelper::custom('fixlegacy', 'edit.png', 'edit_f2.png', 'COM_KUNENA_A_MENU_TOOLBAR_FIXLEGACY', false);
		}

		JToolbarHelper::custom('trashmenu', 'apply.png', 'apply_f2.png', 'COM_KUNENA_A_TRASH_MENU', false);
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools/menu-manager';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 */
	function displayPurgeReStatements()
	{
		$this->setToolBarPurgeReStatements();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarPurgeReStatements()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'tools');
		JToolbarHelper::spacer();
		JToolbarHelper::trash('purgerestatements', 'COM_KUNENA_A_PURGE_RE_MENU_VALIDATE', false);
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools/purge-re-prefixes';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 */
	function displayCleanupIP()
	{
		$this->setToolCleanupIP();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolCleanupIP()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'tools');
		JToolbarHelper::spacer();
		JToolbarHelper::custom('cleanupip', 'apply.png', 'apply_f2.png', 'COM_KUNENA_TOOLS_LABEL_CLEANUP_IP', false);
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools/remove-stored-ip-addresses';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 */
	function displayDiagnostics()
	{
		$this->setToolBarDiagnostics();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarDiagnostics()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'tools');
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools/diagnostics';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 */
	function displayUninstall()
	{
		$this->setToolBarUninstall();

		$login              = KunenaLogin::getInstance();
		$this->isTFAEnabled = $login->isTFAEnabled();

		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarUninstall()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'tools');
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/manual/backend/tools/uninstall-kunena';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}

	/**
	 *
	 * @since Kunena
	 */
	function displayReport()
	{
		$this->systemreport           = $this->get('SystemReport');
		$this->systemreport_anonymous = $this->get('SystemReportAnonymous');
		$this->setToolBarReport();
		$this->display();
	}

	/**
	 *
	 * @since Kunena
	 */
	protected function setToolBarReport()
	{
		JToolbarHelper::title(JText::_('COM_KUNENA'), 'help');
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
		JToolbarHelper::spacer();
		$help_url = 'https://docs.kunena.org/en/faq/configuration-report';
		JToolbarHelper::help('COM_KUNENA', false, $help_url);
	}
}

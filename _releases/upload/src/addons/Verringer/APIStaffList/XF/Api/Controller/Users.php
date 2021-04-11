<?php

namespace Verringer\APIStaffList\XF\Api\Controller;

use XF\Mvc\Entity\Entity;

class Users extends XFCP_Users
{

	public function actionGetStaff()
	{

		/** @var \XF\Finder\User $finder */
		$finder = $this->finder('XF:User');

		$user = $finder->with('api')
						->where('is_staff','=', 1)
						->fetch();

		$users = array();

		foreach($user as $user) {
			$users [] = $user;
		}

		// no user found - fail now
		if (!$user)
		{
			throw $this->exception(
				$this->notFound(\XF::phrase('requested_page_not_found'))
			);
		}

		$result = $users;

		return $this->apiResult($result);
	}
}

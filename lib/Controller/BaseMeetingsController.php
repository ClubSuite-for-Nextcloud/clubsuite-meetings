<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\IRequest;
use OCP\IUserSession;
use OCP\IGroupManager;

class BaseMeetingsController extends Controller {
    protected IUserSession $userSession;
    protected IGroupManager $groupManager;

    public function __construct(
        $appName,
        IRequest $request,
        IUserSession $userSession,
        IGroupManager $groupManager
    ) {
        parent::__construct($appName, $request);
        $this->userSession = $userSession;
        $this->groupManager = $groupManager;
    }

    protected function isAdminOrBoard(): bool {
        $user = $this->userSession->getUser();
        if (!$user) {
            return false;
        }
        if ($this->groupManager->isAdmin($user->getUID())) {
            return true;
        }
        $boardGroup = $this->groupManager->get('Vorstand');
        if ($boardGroup && $boardGroup->inGroup($user)) {
            return true;
        }
        return false;
    }

    protected function checkPermissions(): void {
        if (!$this->isAdminOrBoard()) {
            throw new \Exception('Access denied');
        }
    }
}

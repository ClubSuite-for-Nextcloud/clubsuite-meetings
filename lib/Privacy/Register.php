<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Privacy;

use OCP\User\Gui\UserAccountManager;

class Register {
    public function userExport(string $userId): array {
        return [];
    }

    public function userDeleted(string $userId): void {
        // No user data stored in meetings yet
    }
}

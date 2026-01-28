<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\AppInfo;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCA\ClubSuiteMeetings\Privacy\Register;

class Application extends App implements IBootstrap {
    public const APP_ID = 'clubsuite-meetings';

    public function __construct(array $urlParams = []) {
        parent::__construct(self::APP_ID, $urlParams);
    }

    public function register(IRegistrationContext $context): void {
        // Register Privacy callbacks?
        // Usually done via listener or direct call in older NC versions. 
        // For NC25+, typically via listener or IBootstrap.
    }

    public function boot(IBootContext $context): void {
        $context->injectFn(function(\OCP\IContainer $c) {
            if (\interface_exists('\OCP\Privacy\IManager')) {
                $c->get(\OCP\Privacy\IManager::class)->registerProvider(Register::class);
            }
        });
    }
}

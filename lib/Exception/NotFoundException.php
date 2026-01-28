<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Exception;

use Exception;

class NotFoundException extends Exception {
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        if (empty($message)) {
            $message = 'Entity not found';
        }
        parent::__construct($message, $code, $previous);
    }
}

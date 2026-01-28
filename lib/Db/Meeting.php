<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Db;

use OCP\AppFramework\Db\Entity;

class Meeting extends Entity {
    protected $date;
    protected $title;
    protected $type;
    protected $createdAt;
    protected $updatedAt;

    public function __construct() {
        $this->addType('date', 'string');
        $this->addType('title', 'string');
        $this->addType('type', 'string');
        $this->addType('createdAt', 'integer');
        $this->addType('updatedAt', 'integer');
    }
}

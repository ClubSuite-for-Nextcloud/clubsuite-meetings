<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Db;

use OCP\AppFramework\Db\Entity;

class AgendaItem extends Entity {
    protected $meetingId;
    protected $title;
    protected $decision;
    protected $createdAt;
    protected $updatedAt;

    public function __construct() {
        $this->addType('meetingId', 'integer');
        $this->addType('title', 'string');
        $this->addType('decision', 'string');
        $this->addType('createdAt', 'integer');
        $this->addType('updatedAt', 'integer');
    }
}

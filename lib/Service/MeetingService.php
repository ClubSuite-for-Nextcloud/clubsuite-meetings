<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Service;

use OCA\ClubSuiteMeetings\Db\Meeting;
use OCA\ClubSuiteMeetings\Db\MeetingMapper;
use OCA\ClubSuiteMeetings\Exception\NotFoundException;

class MeetingService {
    private MeetingMapper $mapper;

    public function __construct(MeetingMapper $mapper) {
        $this->mapper = $mapper;
    }

    public function findAll(): array {
        return $this->mapper->findAll();
    }

    public function find(int $id): Meeting {
        return $this->mapper->find($id);
    }

    public function create(string $title, string $date, string $type): Meeting {
        $meeting = new Meeting();
        $meeting->setTitle($title);
        $meeting->setDate($date);
        $meeting->setType($type);
        $meeting->setCreatedAt(time());
        $meeting->setUpdatedAt(time());
        return $this->mapper->insert($meeting);
    }

    public function update(int $id, string $title, string $date, string $type): Meeting {
        $meeting = $this->mapper->find($id);
        $meeting->setTitle($title);
        $meeting->setDate($date);
        $meeting->setType($type);
        $meeting->setUpdatedAt(time());
        return $this->mapper->update($meeting);
    }

    public function delete(int $id): void {
        $meeting = $this->mapper->find($id);
        $this->mapper->delete($meeting);
    }
}

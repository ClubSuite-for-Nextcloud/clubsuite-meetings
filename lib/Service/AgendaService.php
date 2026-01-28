<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Service;

use OCA\ClubSuiteMeetings\Db\AgendaItem;
use OCA\ClubSuiteMeetings\Db\AgendaItemMapper;

class AgendaService {
    private AgendaItemMapper $mapper;

    public function __construct(AgendaItemMapper $mapper) {
        $this->mapper = $mapper;
    }

    public function findByMeeting(int $meetingId): array {
        return $this->mapper->findByMeeting($meetingId);
    }

    public function create(int $meetingId, string $title, string $decision): AgendaItem {
        $item = new AgendaItem();
        $item->setMeetingId($meetingId);
        $item->setTitle($title);
        $item->setDecision($decision);
        $item->setCreatedAt(time());
        $item->setUpdatedAt(time());
        return $this->mapper->insert($item);
    }

    public function update(int $id, string $title, string $decision): AgendaItem {
        $item = $this->mapper->find($id);
        $item->setTitle($title);
        $item->setDecision($decision);
        $item->setUpdatedAt(time());
        return $this->mapper->update($item);
    }

    public function delete(int $id): void {
        $item = $this->mapper->find($id);
        $this->mapper->delete($item);
    }
}

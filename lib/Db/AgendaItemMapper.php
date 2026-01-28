<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Db;

use OCP\AppFramework\Db\QBMapper;
use OCP\DB\IDBConnection;

class AgendaItemMapper extends QBMapper {
    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'clubsuite_agenda_items', AgendaItem::class);
    }

    public function findByMeeting(int $meetingId): array {
        $qb = $this->db->getQueryBuilder();
        $qb->select('*')
           ->from('clubsuite_agenda_items')
           ->where($qb->expr()->eq('meeting_id', $qb->createNamedParameter($meetingId)))
           ->orderBy('id', 'ASC');
        return $this->findEntities($qb);
    }
}

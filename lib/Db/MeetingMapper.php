<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Db;

use OCP\AppFramework\Db\QBMapper;
use OCP\DB\IDBConnection;

class MeetingMapper extends QBMapper {
    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'clubsuite_meetings', Meeting::class);
    }

    public function findAll(): array {
        $qb = $this->db->getQueryBuilder();
        $qb->select('*')
           ->from('clubsuite_meetings')
           ->orderBy('date', 'DESC');
        return $this->findEntities($qb);
    }
}

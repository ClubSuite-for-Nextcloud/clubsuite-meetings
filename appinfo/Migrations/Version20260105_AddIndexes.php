<?php
namespace OCA\ClubSuiteMeetings\Migrations;

use OCP\Migration\IChange;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;

class Version20260105_AddIndexes implements IChange {
    public function changeSchema(ISchemaWrapper $schema, IOutput $output) {
        $table = $schema->getTable('sitzungen_meeting');
        if ($table !== null) {
            if (!$table->hasIndex('idx_sitzungen_meeting_date')) {
                $table->addIndex(['date'], 'idx_sitzungen_meeting_date');
            }
            if (!$table->hasIndex('idx_sitzungen_meeting_created_by')) {
                $table->addIndex(['created_by'], 'idx_sitzungen_meeting_created_by');
            }
        }

        $d = $schema->getTable('sitzungen_decision');
        if ($d !== null && !$d->hasIndex('idx_sitzungen_decision_meeting')) {
            $d->addIndex(['meeting_id'], 'idx_sitzungen_decision_meeting');
        }
    }

    public function postSchemaChange(ISchemaWrapper $schema, IOutput $output) { }
}

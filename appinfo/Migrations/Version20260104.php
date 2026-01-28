<?php
namespace OCA\ClubSuiteMeetings\Migrations;

use Doctrine\DBAL\Schema\Schema;
use OCP\Migration\IChange;

class Version20260104 implements IChange {
    public function changeSchema(Schema $schema): void {
        // meetings table
        if (!$schema->hasTable('sitzungen_meeting')) {
            $table = $schema->createTable('sitzungen_meeting');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('title', 'string', ['length' => 255]);
            $table->addColumn('date', 'datetime');
            $table->addColumn('created_by', 'string', ['length' => 64]);
            $table->addColumn('created_at', 'datetime', ['notnull' => false]);
            $table->setPrimaryKey(['id']);
        }

        // agenda table
        if (!$schema->hasTable('sitzungen_agenda')) {
            $table = $schema->createTable('sitzungen_agenda');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('meeting_id', 'integer');
            $table->addColumn('title', 'string', ['length' => 255]);
            $table->addColumn('description', 'text', ['notnull' => false]);
            $table->addColumn('position', 'integer', ['notnull' => false]);
            $table->setPrimaryKey(['id']);
        }

        // decisions table
        if (!$schema->hasTable('sitzungen_decision')) {
            $table = $schema->createTable('sitzungen_decision');
            $table->addColumn('id', 'integer', ['autoincrement' => true]);
            $table->addColumn('agenda_id', 'integer');
            $table->addColumn('text', 'text');
            $table->addColumn('result', 'string', ['length' => 64, 'notnull' => false]);
            $table->addColumn('created_at', 'datetime', ['notnull' => false]);
            $table->setPrimaryKey(['id']);
        }
    }

    public function getComment(): string {
        return 'Create sitzungen tables';
    }
}

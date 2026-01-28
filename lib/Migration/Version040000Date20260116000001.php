<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Migration;

use Closure;
use OCP\DB\ISchemaWrapper;
use OCP\Migration\IOutput;
use OCP\Migration\SimpleMigrationStep;

class Version040000Date20260116000001 extends SimpleMigrationStep {

    public function changeSchema(IOutput $output, Closure $schemaClosure, array $options): ?ISchemaWrapper {
        /** @var ISchemaWrapper $schema */
        $schema = $schemaClosure();

        if (!$schema->hasTable('clubsuite_meetings')) {
            $table = $schema->createTable('clubsuite_meetings');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
            ]);
            $table->addColumn('date', 'date', [
                'notnull' => true,
            ]);
            $table->addColumn('title', 'string', [
                'notnull' => true,
                'length' => 255,
            ]);
            $table->addColumn('type', 'string', [
                'notnull' => true,
                'length' => 64,
                'default' => 'general' 
            ]);
            $table->addColumn('created_at', 'integer', [
                'notnull' => true,
                'default' => 0,
            ]);
            $table->addColumn('updated_at', 'integer', [
                'notnull' => true,
                'default' => 0,
            ]);
            $table->setPrimaryKey(['id']);
            $table->addIndex(['date'], 'idx_comm_date');
        }

        if (!$schema->hasTable('clubsuite_agenda_items')) {
            $table = $schema->createTable('clubsuite_agenda_items');
            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'notnull' => true,
            ]);
            $table->addColumn('meeting_id', 'integer', [
                'notnull' => true,
            ]);
            $table->addColumn('title', 'string', [
                'notnull' => true,
                'length' => 255,
            ]);
            $table->addColumn('decision', 'text', [
                'notnull' => false,
                'default' => '',
            ]);
            $table->addColumn('created_at', 'integer', [
                'notnull' => true,
                'default' => 0,
            ]);
            $table->addColumn('updated_at', 'integer', [
                'notnull' => true,
                'default' => 0,
            ]);
            $table->setPrimaryKey(['id']);
            $table->addIndex(['meeting_id'], 'idx_comm_meet_id');
        }

        return $schema;
    }
}

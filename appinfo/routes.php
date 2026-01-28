<?php

declare(strict_types=1);

return [
    'routes' => [
        // Page view
        ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],

        // Meetings API
        ['name' => 'meeting_api#index', 'url' => '/meetings', 'verb' => 'GET'],
        ['name' => 'meeting_api#show', 'url' => '/meetings/{id}', 'verb' => 'GET'],
        ['name' => 'meeting_api#create', 'url' => '/meetings', 'verb' => 'POST'],
        ['name' => 'meeting_api#update', 'url' => '/meetings/{id}', 'verb' => 'PUT'],
        ['name' => 'meeting_api#destroy', 'url' => '/meetings/{id}', 'verb' => 'DELETE'],

        // Agenda API
        ['name' => 'agenda_api#index', 'url' => '/meetings/{meetingId}/agenda', 'verb' => 'GET'],
        ['name' => 'agenda_api#create', 'url' => '/meetings/{meetingId}/agenda', 'verb' => 'POST'],
        ['name' => 'agenda_api#update', 'url' => '/agenda/{id}', 'verb' => 'PUT'],
        ['name' => 'agenda_api#destroy', 'url' => '/agenda/{id}', 'verb' => 'DELETE'],
    ]
];

<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Controller;

use OCA\ClubSuiteMeetings\Service\AgendaService;
use OCP\AppFramework\Http\DataResponse;
use OCP\IRequest;
use OCP\IUserSession;
use OCP\IGroupManager;

class AgendaApiController extends BaseMeetingsController {
    private AgendaService $service;

    public function __construct(
        IRequest $request,
        IUserSession $userSession,
        IGroupManager $groupManager,
        AgendaService $service
    ) {
        parent::__construct('clubsuite-meetings', $request, $userSession, $groupManager);
        $this->service = $service;
    }

    /**
     * @NoAdminRequired
     */
    public function index(int $meetingId): DataResponse {
        return new DataResponse($this->service->findByMeeting($meetingId));
    }

    /**
     * @NoAdminRequired
     */
    public function create(int $meetingId, string $title, string $decision = ''): DataResponse {
        $this->checkPermissions();
        return new DataResponse($this->service->create($meetingId, $title, $decision));
    }

    /**
     * @NoAdminRequired
     */
    public function update(int $id, string $title, string $decision): DataResponse {
        $this->checkPermissions();
        return new DataResponse($this->service->update($id, $title, $decision));
    }

    /**
     * @NoAdminRequired
     */
    public function destroy(int $id): DataResponse {
        $this->checkPermissions();
        $this->service->delete($id);
        return new DataResponse([]);
    }
}

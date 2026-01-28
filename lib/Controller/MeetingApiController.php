<?php

declare(strict_types=1);

namespace OCA\ClubSuiteMeetings\Controller;

use OCA\ClubSuiteMeetings\Service\MeetingService;
use OCP\AppFramework\Http\DataResponse;
use OCP\IRequest;
use OCP\IUserSession;
use OCP\IGroupManager;

class MeetingApiController extends BaseMeetingsController {
    private MeetingService $service;

    public function __construct(
        IRequest $request,
        IUserSession $userSession,
        IGroupManager $groupManager,
        MeetingService $service
    ) {
        parent::__construct('clubsuite-meetings', $request, $userSession, $groupManager);
        $this->service = $service;
    }

    /**
     * @NoAdminRequired
     */
    public function index(): DataResponse {
        return new DataResponse($this->service->findAll());
    }

    /**
     * @NoAdminRequired
     */
    public function show(int $id): DataResponse {
        return new DataResponse($this->service->find($id));
    }

    /**
     * @NoAdminRequired
     */
    public function create(string $title, string $date, string $type): DataResponse {
        $this->checkPermissions();
        return new DataResponse($this->service->create($title, $date, $type));
    }

    /**
     * @NoAdminRequired
     */
    public function update(int $id, string $title, string $date, string $type): DataResponse {
        $this->checkPermissions();
        return new DataResponse($this->service->update($id, $title, $date, $type));
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

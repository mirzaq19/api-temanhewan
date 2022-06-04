<?php

namespace App\Temanhewan\Core\Application\Service\DeleteGroomingService;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingServiceId;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class DeleteGroomingServiceService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingServiceRepository $groomingServiceRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(DeleteGroomingServiceRequest $request): void
    {
        $groomingServiceId = new GroomingServiceId($request->getId());
        $groomingService = $this->groomingServiceRepository->ById($groomingServiceId);

        if (!$groomingService)
            throw new TemanhewanException('Grooming service not found', 1078);

        $groomingId = new UserId(auth()->user()->getAuthIdentifier());
        $grooming = $this->userRepository->ById($groomingId);

        if ($groomingService->getGroomingId()->id() != $grooming->getId()->id())
            throw new TemanhewanException('You are not allowed to delete this grooming service', 1079);

        $this->groomingServiceRepository->delete($groomingService);
    }
}

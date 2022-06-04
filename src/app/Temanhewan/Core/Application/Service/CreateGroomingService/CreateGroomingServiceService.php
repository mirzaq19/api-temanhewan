<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingService;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class CreateGroomingServiceService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingServiceRepository $groomingServiceRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(CreateGroomingServiceRequest $request): CreateGroomingServiceResponse
    {
        $groomingId = new UserId(auth()->user()->getAuthIdentifier());
        $grooming = $this->userRepository->byId($groomingId);

        if($grooming->getRole()->getValue() != Role::GROOMING)
            throw new TemanhewanException("You are not a grooming", 1073);

        $groomingService = $grooming->addGroomingService(
            $request->getName(),
            $request->getDescription(),
            $request->getPrice(),
            $groomingId
        );

        $this->groomingServiceRepository->save($groomingService);

        $newGroomingService = $this->groomingServiceRepository->byId($groomingService->getId());

        return new CreateGroomingServiceResponse($newGroomingService);
    }
}

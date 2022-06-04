<?php

namespace App\Temanhewan\Core\Application\Service\UpdateGroomingService;

use App\Temanhewan\Core\Application\Service\CreateGroomingService\CreateGroomingServiceResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingServiceId;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class UpdateGroomingServiceService
{
    public function __construct(
        private UserRepository $userRepository,
        private GroomingServiceRepository $groomingServiceRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(UpdateGroomingServiceRequest $request): CreateGroomingServiceResponse
    {
        $groomingServiceId = new GroomingServiceId($request->getId());
        $groomingService = $this->groomingServiceRepository->ById($groomingServiceId);

        if(!$groomingService)
            throw new TemanhewanException("Grooming service not found",1075);

        $groomingId = new UserId(auth()->user()->getAuthIdentifier());
        $grooming = $this->userRepository->ById($groomingId);

        if($grooming->getRole()->getValue() != Role::GROOMING)
            throw new TemanhewanException("You are not a grooming",1076);

        if($grooming->getId()->id() != $groomingService->getGroomingId()->id())
            throw new TemanhewanException("You are not allowed to update this grooming service",1077);

        $this->groomingServiceRepository->update($groomingService);

        $updatedGroomingService = $this->groomingServiceRepository->ById($groomingServiceId);

        return new CreateGroomingServiceResponse($updatedGroomingService);
    }
}

<?php

namespace App\Temanhewan\Core\Application\Service\GetGroomingService;

use App\Temanhewan\Core\Application\Service\CreateGroomingService\CreateGroomingServiceResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingServiceId;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;

class GetGroomingServiceService
{
    public function __construct(
        private GroomingServiceRepository $groomingServiceRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetGroomingServiceRequest $request): CreateGroomingServiceResponse
    {
        $groomingServiceId = new GroomingServiceId($request->getId());
        $groomingService = $this->groomingServiceRepository->ById($groomingServiceId);

        if(!$groomingService)
            throw new TemanhewanException('Grooming service not found',1080);

        return new CreateGroomingServiceResponse($groomingService);
    }
}

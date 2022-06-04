<?php

namespace App\Temanhewan\Core\Application\Service\GetGroomingServiceList;

use App\Temanhewan\Core\Application\Service\CreateGroomingService\CreateGroomingServiceResponse;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;

class GetGroomingServiceListService
{
    public function __construct(
        private GroomingServiceRepository $groomingServiceRepository
    ){}

    public function execute(GetGroomingServiceListRequest $request): array
    {
        $groomingId = new UserId($request->getGroomingId());
        $groomingServices = $this->groomingServiceRepository->list($groomingId, $request->getOffset(), $request->getLimit());

        $response = [];
        foreach ($groomingServices as $groomingService) {
            $response[] = new CreateGroomingServiceResponse($groomingService);
        }

        return $response;
    }
}

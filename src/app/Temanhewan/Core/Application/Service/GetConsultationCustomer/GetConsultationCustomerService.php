<?php

namespace App\Temanhewan\Core\Application\Service\GetConsultationCustomer;

use App\Temanhewan\Core\Application\Service\GetConsultation\GetConsultationResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetConsultationCustomerService
{
    public function __construct(
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetConsultationCustomerRequest $request): array
    {
        $customerId = new UserId($request->getCustomerId());
        $customer = $this->userRepository->ById($customerId);

        if(!$customer)
            throw new TemanhewanException("Customer not found",1070);

        $consultations = $this->consultationRepository->ByCustomerId($customerId, $request->getOffset(), $request->getLimit());

        $response = [];

        foreach($consultations as $consultation) {
            $response[] = new GetConsultationResponse($consultation);
        }

        return $response;
    }
}

<?php

namespace App\Temanhewan\Core\Application\Service\PaidConsultation;

use App\Temanhewan\Core\Application\Service\CreateConsultation\CreateConsultationResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Model\ConsultationStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class PaidConsultationService
{
    public function __construct(
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(PaidConsultationRequest $request): CreateConsultationResponse
    {
        $consultationId = new ConsultationId($request->getId());
        $consultation = $this->consultationRepository->ById($consultationId);
        if(!$consultation)
            throw new TemanhewanException('Consultation not found',1044);

        if($consultation->getStatus()->getValue() != ConsultationStatus::ACCEPTED)
            throw new TemanhewanException('Only accepted consultation can be paid',1045);

        $customerId = new userId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->ById($customerId);
        if($customer->getRole()->getValue() != Role::CUSTOMER)
            throw new TemanhewanException('You are not a customer',1046);

        if($customer->getId()->id() != $consultation->getCustomerId()->id())
            throw new TemanhewanException('You are not the customer of this consultation',1047);

        $this->consultationRepository->paid($consultation);

        $updatedConsultation = $this->consultationRepository->ById($consultationId);
        return new CreateConsultationResponse($updatedConsultation);
    }
}

<?php

namespace App\Temanhewan\Core\Application\Service\CompleteConsultation;

use App\Temanhewan\Core\Application\Service\CreateConsultation\CreateConsultationResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Model\ConsultationStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class CompleteConsultationService
{
    public function __construct(
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(CompleteConsultationRequest $request): CreateConsultationResponse
    {
        $consultationId = new ConsultationId($request->getId());
        $consultation = $this->consultationRepository->ById($consultationId);
        if(!$consultation)
            throw new TemanhewanException('Consultation not found',1048);

        if($consultation->getStatus()->getValue() != ConsultationStatus::PAID)
            throw new TemanhewanException('Only paid consultation can be completed',1049);

        $customerId = new userId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->ById($customerId);
        if($customer->getRole()->getValue() != Role::CUSTOMER)
            throw new TemanhewanException('You are not a customer',1050);

        if($customer->getId()->id() != $consultation->getCustomerId()->id())
            throw new TemanhewanException('You are not the customer of this consultation',10451);

        $this->consultationRepository->complete($consultation);

        $updatedConsultation = $this->consultationRepository->ById($consultationId);
        return new CreateConsultationResponse($updatedConsultation);
    }
}

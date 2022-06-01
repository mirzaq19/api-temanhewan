<?php

namespace App\Temanhewan\Core\Application\Service\CancelConsultation;

use App\Temanhewan\Core\Application\Service\CreateConsultation\CreateConsultationResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Model\ConsultationStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class CancelConsultationService
{
    public function __construct(
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(CancelConsultationRequest $request): CreateConsultationResponse
    {
        $consultationId = new ConsultationId($request->getId());
        $consultation = $this->consultationRepository->ById($consultationId);
        if(!$consultation)
            throw new TemanhewanException('Consultation not found',1056);

        if($consultation->getStatus()->getValue() != ConsultationStatus::PENDING)
            throw new TemanhewanException('Only pending consultation can be canceled',1057);

        $customerId = new userId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->ById($customerId);
        if($customer->getRole()->getValue() != Role::CUSTOMER)
            throw new TemanhewanException('You are not a customer',1058);

        if($customer->getId()->id() != $consultation->getCustomerId()->id())
            throw new TemanhewanException('You are not the customer of this consultation',1059);

        $this->consultationRepository->cancel($consultation);

        $updatedConsultation = $this->consultationRepository->ById($consultationId);
        return new CreateConsultationResponse($updatedConsultation);
    }
}

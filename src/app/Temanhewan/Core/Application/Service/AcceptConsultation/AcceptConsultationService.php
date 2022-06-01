<?php

namespace App\Temanhewan\Core\Application\Service\AcceptConsultation;

use App\Temanhewan\Core\Application\Service\CreateConsultation\CreateConsultationResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Model\ConsultationStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class AcceptConsultationService
{
    public function __construct(
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(AcceptConsultationRequest $request): CreateConsultationResponse
    {
        $consultationId = new ConsultationId($request->getId());
        $consultation = $this->consultationRepository->ById($consultationId);
        if(!$consultation)
            throw new TemanhewanException('Consultation not found',1039);

        if($consultation->getStatus()->getValue() != ConsultationStatus::PENDING)
            throw new TemanhewanException('Only pending consultation can be accepted',1041);

        $doctorId = new userId(auth()->user()->getAuthIdentifier());
        $doctor = $this->userRepository->ById($doctorId);
        if($doctor->getRole()->getValue() != Role::DOCTOR)
            throw new TemanhewanException('You are not a doctor',1042);

        if($doctor->getId()->id() != $consultation->getDoctorId()->id())
            throw new TemanhewanException('You are not the doctor of this consultation',1043);

        $consultation->setFee($request->getFee());

        $this->consultationRepository->accept($consultation);

        $updatedConsultation = $this->consultationRepository->ById($consultationId);
        return new CreateConsultationResponse($updatedConsultation);
    }
}

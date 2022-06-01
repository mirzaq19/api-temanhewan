<?php

namespace App\Temanhewan\Core\Application\Service\CreateConsultation;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use DateTime;
use Exception;

class CreateConsultationService
{
    public function __construct(
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws TemanhewanException
     * @throws Exception
     */
    public function execute(CreateConsultationRequest $request): CreateConsultationResponse
    {
        $doctorId = new UserId($request->getDoctorId());
        $doctor = $this->userRepository->ById($doctorId);

        if(!$doctor)
            throw new TemanhewanException("Doctor not found",1036);

        if($doctor->getRole()->getValue() != Role::DOCTOR)
            throw new TemanhewanException("This user not a doctor",1037);

        $customerId = new UserId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->ById($customerId);

        $consultation = $customer->addConsultation(
            $request->getComplaint(),
            $request->getAddress(),
            new DateTime($request->getDate()),
            null,
            $doctor->getId()
        );
        $this->consultationRepository->save($consultation);

        $newConsultation = $this->consultationRepository->ById($consultation->getId());

        return new CreateConsultationResponse($newConsultation);
    }
}

<?php

namespace App\Temanhewan\Core\Application\Service\GetConsultationDoctor;

use App\Temanhewan\Core\Application\Service\GetConsultation\GetConsultationResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetConsultationDoctorService
{
    public function __construct(
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetConsultationDoctorRequest $request): array
    {
        $doctorId = new UserId($request->getDoctorId());
        $doctor = $this->userRepository->ById($doctorId);

        if(!$doctor || $doctor->getRole()->getValue() != Role::DOCTOR) {
            throw new TemanhewanException("Doctor not found", 1071);
        }

        $consultations = $this->consultationRepository->ByDoctorId($doctorId, $request->getOffset(), $request->getLimit());

        $response = [];
        foreach($consultations as $consultation){
            $response[] = new GetConsultationResponse($consultation);
        }

        return $response;
    }
}

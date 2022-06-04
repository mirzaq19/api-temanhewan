<?php

namespace App\Temanhewan\Core\Application\Service\GetConsultation;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class GetConsultationService
{
    public function __construct(
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(GetConsultationRequest $request): GetConsultationResponse
    {
        $consultationId = new ConsultationId($request->getId());
        $consultation = $this->consultationRepository->ById($consultationId);

        if(!$consultation)
            throw new TemanhewanException("Consultation not found",1069);

        return new GetConsultationResponse($consultation);
    }
}

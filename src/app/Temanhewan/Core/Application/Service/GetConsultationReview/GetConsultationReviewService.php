<?php

namespace App\Temanhewan\Core\Application\Service\GetConsultationReview;

use App\Temanhewan\Core\Application\Service\CreateConsultationReview\CreateConsultationReviewResponse;
use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use Exception;

class GetConsultationReviewService
{
    public function __construct(
        private ConsultationRepository $consultationRepository
    ){}

    /**
     * @throws Exception
     */
    public function execute(GetConsultationReviewRequest $request): CreateConsultationReviewResponse
    {
        $consultationId = new ConsultationId($request->getId());
        $consultation = $this->consultationRepository->byId($consultationId);

        if(!$consultation)
            throw new TemanhewanException("Consultation not found",1123);

        if(!$consultation->isReviewed())
            throw new TemanhewanException("Consultation not reviewed",1124);

        $consultationReview = $this->consultationRepository->getReview($consultationId);

        return new CreateConsultationReviewResponse($consultationReview);
    }
}

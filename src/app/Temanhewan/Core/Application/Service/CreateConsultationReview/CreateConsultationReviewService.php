<?php

namespace App\Temanhewan\Core\Application\Service\CreateConsultationReview;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\ConsultationId;
use App\Temanhewan\Core\Domain\Model\ConsultationReview;
use App\Temanhewan\Core\Domain\Model\ConsultationStatus;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\ConsultationRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;
use Exception;

class CreateConsultationReviewService
{
    public function __construct(
        private UserRepository $userRepository,
        private ConsultationRepository $consultationRepository,
    ){ }

    /**
     * @throws Exception
     */
    public function execute(CreateConsultationReviewRequest $request): CreateConsultationReviewResponse
    {
        $consultationId = new ConsultationId($request->getId());
        $consultation = $this->consultationRepository->ById($consultationId);

        if(!$consultation)
            throw new TemanhewanException("Consultation not found",1062);

        if($consultation->getStatus()->getValue() != ConsultationStatus::COMPLETED)
            throw new TemanhewanException("Consultation not completed",1063);

        $customerId = new UserId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->ById($customerId);

        if($customer->getRole()->getValue() != Role::CUSTOMER)
            throw new TemanhewanException("You are not the customer",1064);

        if($customer->getId()->id() != $consultation->getCustomerId()->id())
            throw new TemanhewanException("You are not the customer of this consultation",1065);

        $review = new ConsultationReview(
            $request->getRating(),
            $request->getReview(),
            $request->isPublic(),
            $customer->getId(),
            $consultation->getDoctorId(),
            $consultation->getId()
        );

        $this->consultationRepository->saveReview($review);

        $newReview = $this->consultationRepository->getReview($consultationId);

        return new CreateConsultationReviewResponse($newReview);
    }
}

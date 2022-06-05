<?php

namespace App\Temanhewan\Core\Application\Service\CreateGroomingOrder;

use App\Temanhewan\Core\Domain\Exception\TemanhewanException;
use App\Temanhewan\Core\Domain\Model\GroomingServiceId;
use App\Temanhewan\Core\Domain\Model\PetId;
use App\Temanhewan\Core\Domain\Model\Role;
use App\Temanhewan\Core\Domain\Model\UserId;
use App\Temanhewan\Core\Domain\Repository\GroomingOrderRepository;
use App\Temanhewan\Core\Domain\Repository\GroomingServiceRepository;
use App\Temanhewan\Core\Domain\Repository\PetRepository;
use App\Temanhewan\Core\Domain\Repository\UserRepository;

class CreateGroomingOrderService
{
    public function __construct(
        private UserRepository $userRepository,
        private PetRepository $petRepository,
        private GroomingServiceRepository $groomingServiceRepository,
        private GroomingOrderRepository $groomingOrderRepository
    ){}

    /**
     * @throws TemanhewanException
     */
    public function execute(CreateGroomingOrderRequest $request): CreateGroomingOrderResponse
    {
        $groomingServiceId = new GroomingServiceId($request->getGroomingServiceId());
        $groomingService = $this->groomingServiceRepository->byId($groomingServiceId);

        if(!$groomingService)
            throw new TemanhewanException("Grooming service not found.", 1084);

        $customerId = new UserId(auth()->user()->getAuthIdentifier());
        $customer = $this->userRepository->byId($customerId);

        if($customer->getRole()->getValue() != Role::CUSTOMER)
            throw new TemanhewanException("Only customer can order grooming service", 1085);

        $groomingId = new UserId($groomingService->getGroomingId()->id());
        $grooming = $this->userRepository->byId($groomingId);

        if(!$grooming)
            throw new TemanhewanException("Grooming not found.", 1086);

        $petId = new PetId($request->getPetId());
        $pet = $this->petRepository->byId($petId);

        if(!$pet)
            throw new TemanhewanException("Pet not found.", 1087);

        if($pet->getUserId()->id() != $customerId->id())
            throw new TemanhewanException("Pet not belong to customer.", 1088);

        $groomingOrder = $customer->addGroomingOrder(
            $request->getAddress(),
            $groomingServiceId,
            $petId,
            $groomingId
        );

        $this->groomingOrderRepository->save($groomingOrder);

        $newGroomingOrder = $this->groomingOrderRepository->byId($groomingOrder->getId());

        return new CreateGroomingOrderResponse($newGroomingOrder);
    }
}

<?php

declare(strict_types=1);

namespace ApiInmuebles\Api\Ports\Rest\Commercial\Tour;


use ApiInmuebles\Api\Ports\Rest\ApiController;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Services\ListAllToursByProperty;
use ApiInmuebles\Backoffice\Commercial\Tour\Domain\ToursByPropertyResponse;
use ApiInmuebles\Shared\Domain\Messenger\QueryBusInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class ListToursByPropertyGetController
{
    private ApiController $apiController;
    private QueryBusInterface $queryBus;
    private ListAllToursByProperty $useCase;

    public function __construct(
        ApiController $apiController,
        QueryBusInterface $queryBus,
        ListAllToursByProperty $useCase)
    {
        $this->apiController = $apiController;
        $this->queryBus = $queryBus;
        $this->useCase = $useCase;
    }
    /**
     * Update a Property
     *
     * @Route("/tour/list/{propertyId}", methods={"GET"}, name="api_tour_list_by_property")
     * @OA\Tag(
     *     name="Tour",
     *     description="Operations about Tour"
     * ),
     * @OA\Response(
     *        response="200",
     *        description="Success: Tours listed",
     *     )
     **/
    public function __invoke(string $propertyId): Response
    {
        $listToursByProperty =  $this->useCase->__invoke($propertyId);

        return $this->apiController->makeResponse($listToursByProperty->_toArray());
    }
}
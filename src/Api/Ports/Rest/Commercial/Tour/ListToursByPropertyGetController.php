<?php

declare(strict_types=1);

namespace ApiInmuebles\Api\Ports\Rest\Commercial\Tour;


use ApiInmuebles\Api\Ports\Rest\ApiController;
use ApiInmuebles\Api\Ports\Rest\Commercial\Tour\Request\ListToursByPropertyRequest;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Query\ListToursByPropertyQuery;
use ApiInmuebles\Shared\Domain\Messenger\QueryBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class ListToursByPropertyGetController
{
    private ApiController $apiController;
    private QueryBusInterface $queryBus;

    public function __construct(ApiController $apiController, QueryBusInterface $queryBus)
    {
        $this->apiController = $apiController;
        $this->queryBus = $queryBus;
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

       $listToursByProperty = $this->queryBus->dispatch(new ListToursByPropertyQuery($propertyId));

        return $this->apiController->makeResponse([]);

    }
}
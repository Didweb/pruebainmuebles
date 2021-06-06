<?php

declare(strict_types=1);

namespace ApiInmuebles\Api\Ports\Rest\Commercial\Tour;


use ApiInmuebles\Api\Ports\Rest\ApiController;
use ApiInmuebles\Api\Ports\Rest\Commercial\Tour\Request\CreateTourRequest;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Command\CreateTourCommand;
use ApiInmuebles\Shared\Domain\Messenger\CommandBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class CreateTourPostController
{
    private ApiController $apiController;
    private CommandBusInterface $commandBus;

    public function __construct(ApiController $apiController, CommandBusInterface $commandBus)
    {
        $this->apiController = $apiController;
        $this->commandBus = $commandBus;
    }

    /**
     * Create a Property
     *
     * @Route("/tour/add", methods={"POST"}, name="api_tour_add")
     * @OA\Tag(
     *     name="Tour",
     *     description="Operations about Tour"
     * ),
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for add Tour",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="tour",
     *                type="array",
     *                example={{
     *                  "id": "0b9d1336-c60a-11eb-8529-0242ac130003",
     *                  "property": "b026b3f4-be48-11eb-8529-0242ac130011",
     *                  "active": "1"
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="property",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="active",
     *                         type="bool",
     *                         example=""
     *                      ),
     *                ),
     *             ),
     *        ),
     * ),
     * @OA\Response(
     *        response="201",
     *        description="Success: Tour created",
     *     )
     **/
    public function __invoke(Request $request): Response
    {
        $request = CreateTourRequest::fromContent($this->apiController->getContent($request));

        $createPropertyCommand = new CreateTourCommand (
            $request->id(),
            $request->property(),
            $request->active()
        );


        $this->commandBus->dispatch($createPropertyCommand);

        return $this->apiController->makeResponse($createPropertyCommand->_toArray(), Response::HTTP_CREATED);
    }
}
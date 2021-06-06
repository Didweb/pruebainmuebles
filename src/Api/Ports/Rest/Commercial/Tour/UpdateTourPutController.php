<?php

declare(strict_types=1);

namespace ApiInmuebles\Api\Ports\Rest\Commercial\Tour;


use ApiInmuebles\Api\Ports\Rest\ApiController;
use ApiInmuebles\Api\Ports\Rest\Commercial\Tour\Request\UpdateTourRequest;
use ApiInmuebles\Backoffice\Commercial\Tour\Application\Command\UpdateTourCommand;
use ApiInmuebles\Shared\Domain\Messenger\CommandBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class UpdateTourPutController
{
    private ApiController $apiController;
    private CommandBusInterface $commandBus;

    public function __construct(ApiController $apiController, CommandBusInterface $commandBus)
    {
        $this->apiController = $apiController;
        $this->commandBus = $commandBus;
    }

    /**
     * Update a Property
     *
     * @Route("/tour/update", methods={"PUT"}, name="api_tour_update")
     * @OA\Tag(
     *     name="Tour",
     *     description="Operations about Tour"
     * ),
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for update Tour",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="tour",
     *                type="array",
     *                example={{
     *                  "id": "4e8c5baa-f0a4-49dc-b07d-9aa49fbb1662",
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
     *                         type="string",
     *                         example=""
     *                      )
     *                ),
     *             ),
     *        ),
     * ),
     * @OA\Response(
     *        response="201",
     *        description="Success: Tour update",
     *     )
     **/
    public function __invoke(Request $request): Response
    {
        $request = UpdateTourRequest::fromContent($this->apiController->getContent($request));

        $updateTourCommand = new UpdateTourCommand(
            $request->id(),
            $request->property(),
            $request->active(),
        );

        $this->commandBus->dispatch($updateTourCommand);

        return $this->apiController->makeResponse($updateTourCommand->_toArray(),Response::HTTP_CREATED);

    }
}
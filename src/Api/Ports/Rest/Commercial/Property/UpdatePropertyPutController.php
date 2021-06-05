<?php

declare(strict_types=1);

namespace ApiInmuebles\Api\Ports\Rest\Commercial\Property;


use ApiInmuebles\Api\Ports\Rest\ApiController;
use ApiInmuebles\Api\Ports\Rest\Commercial\Property\Request\UpdatePropertyRequest;
use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\UpdatePropertyCommand;
use ApiInmuebles\Shared\Domain\Messenger\CommandBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class UpdatePropertyPutController
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
     * @Route("/property/update", methods={"PUT"}, name="api_property_update")
     * @OA\Tag(
     *     name="Property",
     *     description="Operations about Property"
     * ),
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for update Property",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="property",
     *                type="array",
     *                example={{
     *                  "id": "b026b3f4-be48-11eb-8529-0242ac130011",
     *                  "title": "Title Property",
     *                  "description": "Description Property"
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="title",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="description",
     *                         type="string",
     *                         example=""
     *                      )
     *                ),
     *             ),
     *        ),
     * ),
     * @OA\Response(
     *        response="201",
     *        description="Success: Property update",
     *     )
     **/
    public function __invoke(Request $request): Response
    {
        $request = UpdatePropertyRequest::fromContent($this->apiController->getContent($request));

        $updatePropertyCommand = new UpdatePropertyCommand (
            $request->id(),
            $request->title(),
            $request->description()
        );

        $this->commandBus->dispatch($updatePropertyCommand);

        return $this->apiController->makeResponse($updatePropertyCommand->_toArray(), Response::HTTP_CREATED);

    }

}
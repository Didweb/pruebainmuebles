<?php

declare(strict_types=1);

namespace ApiInmuebles\Api\Ports\Rest\Commercial\Property;

use ApiInmuebles\Api\Ports\Rest\ApiController;
use ApiInmuebles\Api\Ports\Rest\Commercial\Property\Request\CreatedPropertyRequest;
use ApiInmuebles\Backoffice\Commercial\Property\Application\Command\CreatePropertyCommand;
use ApiInmuebles\Shared\Domain\Messenger\CommandBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class CreatePropertyPostController
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
     * @Route("/create/property", methods={"POST"}, name="api_property_create")
     **/
    public function __invoke(Request $request): Response
    {
        $request = CreatedPropertyRequest::fromContent($this->apiController->getContent($request));

        $createPropertyCommand = new CreatePropertyCommand (
            $request->id(),
            $request->title(),
            $request->description()
        );

        $this->commandBus->dispatch($createPropertyCommand);

        return $this->apiController->makeResponse($createPropertyCommand->_toArray(), Response::HTTP_CREATED);
    }
}
<?php

declare(strict_types=1);

namespace ApiInmuebles\Backoffice\Commercial\Tour\Domain;


use ApiInmuebles\Shared\Domain\Messenger\Query\Response;

final class ToursByPropertyResponse extends Response
{
    private string $propertyId;
    private array $tours;

    public function __construct(string $propertyId, ?array $tours = [])
    {
        $this->propertyId = $propertyId;
        $this->tours = ($tours === null) ? [] : $tours;
    }

    public function propertyId(): string
    {
        return $this->propertyId;
    }

    public function tours(): array
    {
        return $this->tours;
    }

    public function updateTours(?array $tours): void
    {
        $tours = ($tours === null) ? [] : $tours;
        $result = [];
        foreach ($tours as $tour) {
            $result[] = [
                'id' => (string)$tour->id(),
                'active' => ($tour->active() =='1'),
            ];
        }
        $this->tours = $result;
    }

    public function _toArray(): array
    {
        return [
            'propertyId' => $this->propertyId(),
            'tours' => $this->tours(),
        ];
    }
}
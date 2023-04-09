<?php

declare(strict_types=1);

namespace Jgrc\Shop\Infrastructure\Symfony\Http;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonApiResponseBuilder
{
    /** @var mixed[] */
    private array $data;
    /** @var mixed[] */
    private array $dataItems;
    /** @var mixed[] */
    private array $errors;
    private int $httpStatus;

    private function __construct()
    {
        $this->data = [];
        $this->dataItems = [];
        $this->errors = [];
        $this->httpStatus = JsonResponse::HTTP_OK;
    }

    /** @param mixed[] $attributes */
    public function data(string $type, string $id, array $attributes = []): self
    {
        $this->data = $this->createData($type, $id, $attributes);
        $this->dataItems = [];
        return $this;
    }

    /** @param mixed[] $attributes */
    public function dataItem(string $type, string $id, array $attributes = []): self
    {
        $this->data = [];
        $this->dataItems[] = $this->createData($type, $id, $attributes);
        return $this;
    }

    public function error(
        string $title,
        string $code,
        ?string $detail = null,
        ?string $sourceParameter = null
    ): self {
        $error = [
            'title' => $title,
            'code' => $code
        ];
        if ($detail) {
            $error['detail'] = $detail;
        }
        if ($sourceParameter) {
            $error['source']['parameter'] = $sourceParameter;
        }
        $this->errors[] = $error;
        return $this;
    }

    public function httpStatus(int $httpStatus): self
    {
        $this->httpStatus = $httpStatus;
        return $this;
    }

    /**
     * @param mixed[] $attributes
     * @return mixed[]
     */
    private function createData(string $type, string $id, array $attributes = []): array
    {
        $data = [
            'type' => $type,
            'id' => $id,
        ];
        if ($attributes) {
            $data['attributes'] = $attributes;
        }

        return $data;
    }

    public function build(): JsonResponse
    {
        $response = [];
        if ($this->data) {
            $response['data'] = $this->data;
        }
        if ($this->dataItems) {
            $response['data'] = $this->dataItems;
        }
        if ($this->errors) {
            $response['errors'] = $this->errors;
        }

        return new JsonResponse($response, $this->httpStatus);
    }

    public static function create(): self
    {
        return new self();
    }
}

<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Response;

use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\Controller\JsonResponse;

class JsonResponseFactory
{
    const STATUS_NOT_FOUND = 404;
    const STATUS_SUCCESS = 200;


    public static function create(array $data, int $status = self::STATUS_SUCCESS): ResponseInterface
    {
        $response = new JsonResponse();

        $response->getBody()->write(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        return $response
            ->withHeader('Content-Type', 'application/json; charset=utf-8')
            ->withStatus($status);
    }
}
<?php

declare (strict_types=1);
namespace Symplify\PackageBuilder\Http;

use _PhpScoperf4d251e01a80\GuzzleHttp\ClientInterface;
use _PhpScoperf4d251e01a80\GuzzleHttp\Exception\BadResponseException;
use _PhpScoperf4d251e01a80\GuzzleHttp\Psr7\Request;
use _PhpScoperf4d251e01a80\Nette\Utils\Json;
use _PhpScoperf4d251e01a80\Nette\Utils\JsonException;
use _PhpScoperf4d251e01a80\Psr\Http\Message\ResponseInterface;
final class BetterGuzzleClient
{
    /**
     * @var ClientInterface
     */
    private $client;
    public function __construct(\_PhpScoperf4d251e01a80\GuzzleHttp\ClientInterface $client)
    {
        $this->client = $client;
    }
    /**
     * @api
     * @return mixed[]|mixed|void
     */
    public function requestToJson(string $url) : array
    {
        $request = new \_PhpScoperf4d251e01a80\GuzzleHttp\Psr7\Request('GET', $url);
        $response = $this->client->send($request);
        if (!$this->isSuccessCode($response)) {
            throw \_PhpScoperf4d251e01a80\GuzzleHttp\Exception\BadResponseException::create($request, $response);
        }
        $content = (string) $response->getBody();
        if ($content === '') {
            return [];
        }
        try {
            return \_PhpScoperf4d251e01a80\Nette\Utils\Json::decode($content, \_PhpScoperf4d251e01a80\Nette\Utils\Json::FORCE_ARRAY);
        } catch (\_PhpScoperf4d251e01a80\Nette\Utils\JsonException $jsonException) {
            throw new \_PhpScoperf4d251e01a80\Nette\Utils\JsonException('Syntax error while decoding:' . $content, $jsonException->getLine(), $jsonException);
        }
    }
    private function isSuccessCode(\_PhpScoperf4d251e01a80\Psr\Http\Message\ResponseInterface $response) : bool
    {
        return $response->getStatusCode() >= 200 && $response->getStatusCode() < 300;
    }
}

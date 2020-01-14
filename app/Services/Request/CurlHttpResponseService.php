<?php


namespace App\Services\Request;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class CurlHttpResponseService
{
    public $headers = [];
    public $statusCode;
    public $text = '';

    public function __construct($statusCode, $headers, $text)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->text = $text;
    }

    /**
     * Transforms response to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

    /**
     * Gets text as json
     *
     * @return JsonResponse
     */
    public function asJson(): JsonResponse
    {
        return Response::json($this->asArray());
    }

    /**
     * Gets text as object
     *
     * @return mixed
     */
    public function asObject()
    {
        return json_decode($this->text, false);
    }

    /**
     * Gets text as array
     *
     * @return array
     */
    public function asArray(): array
    {
        return json_decode($this->text, true);
    }
}


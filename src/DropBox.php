<?php

namespace Jeylabs\DropBox;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

/**
 * Class DropBox
 * @package Jeylabs\DropBox
 */
class DropBox
{
    /**
     * @var
     */
    private $accessToken;
    /**
     * @var Client
     */
    private $client;

    /**
     * DropBox constructor.
     * @param $accessToken
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
        $this->client = new Client();
    }

    /**
     * @param $filePath
     * @param $fileName
     * @param string $path
     * @return mixed
     */
    public function uploadFile($filePath, $fileName, $path = "/")
    {
        return $this->client->post('https://content.dropboxapi.com/2/files/upload', [
            'headers' => [
                'Authorization' => "Bearer $this->accessToken",
                'Content-Type' => "application/octet-stream",
                'DropBox-API-Arg' => json_encode(['path' => $path . "" . $fileName, "mode" => "add", "autorename" => true, "mute" => false, "strict_conflict" => false])
            ],
            'body' => fopen($filePath, "r")
        ])->json();
    }


    /**
     * @param $path
     * @return string
     */
    public function getFileContent($path)
    {
        $rep = $this->client->post('https://content.dropboxapi.com/2/files/get_preview', [
            'headers' => [
                'Authorization' => "Bearer $this->accessToken",
                'Content-Type' => "text/plain",
                'DropBox-API-Arg' => json_encode(['path' => $path]),
            ]
        ]);
        return (string)$rep->getBody();
    }

    /**
     * @param $path
     * @return mixed
     */
    public function deleteFile($path)
    {
        return $this->client->post('https://api.dropboxapi.com/2/files/delete_v2', [
            'headers' => [
                'Authorization' => "Bearer $this->accessToken",
                'Content-Type' => "application/json",
            ],
            'body' => json_encode(['path' => $path]),
        ])->json();
    }
}
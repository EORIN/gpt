<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GptApiController extends AbstractController
{
    private const CHAT_GPT_BASE_URL = 'https://api.openai.com/v1/';

    /**
     * @Route("/gpt/api", name="app_gpt_api")
     */
    public function index(Request $request): JsonResponse
    {
        $httpClient = HttpClient::create(['base_uri' => self::CHAT_GPT_BASE_URL]);

        //Set up request headers
        $headers = [
            //TODO get token from env file
            'Authorization' => 'Bearer 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',
            'Content-type' => 'application/json',
        ];

        //Set up request body
        $query = [
//            TODO remove all hardcode
            'model' => 'gpt-3.5-turbo',
            "messages" => [
                [
                    "role" => "user",
                    "content" => $request->request->all()['data'],
                ],
            ]
        ];

        //Get response
        try {
            $response = $httpClient->request('POST', 'chat/completions', [
                'headers' => $headers,
                'json' => $query,
            ]);

            $decodedJson = json_decode($response->getContent(), true);
            $result = $decodedJson['choices'][0]['message']['content'];
        } catch (Exception $e) {
            $result = $e->getMessage();
        }

        return $this->json(['result' => $result]);
    }
}

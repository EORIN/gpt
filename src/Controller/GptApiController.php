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
    private const CHAT_GPT_BASE_URL = 'https://api.openai.com/v1/chat/completions';

    /**
     * @Route("/gpt/api", name="app_gpt_api")
     */
    public function index(Request $request): JsonResponse
    {
        $httpClient = HttpClient::create(['base_uri' => self::CHAT_GPT_BASE_URL]);
        $authKey = $this->getParameter('app.gpt_key');

        //Set up request headers
        $headers = [
            'Authorization' => sprintf('Bearer %s', $authKey),
            'Content-type' => 'application/json',
        ];

        $params = $request->request->all();

        //Set up request body
        $query = [
//            TODO remove all hardcode
            'model' => 'gpt-3.5-turbo',
            "messages" => [
                [
                    "role" => "user",
                    "content" => $params['data'],
                ],
            ]
        ];

        //Get response
        try {
            $response = $httpClient->request('POST', self::CHAT_GPT_BASE_URL, [
                'headers' => $headers,
                'json' => $query,
            ]);

            $decodedJson = json_decode($response->getContent(), true);
            $result = $decodedJson['choices'][0]['message']['content'];
        } catch (Exception $e) {
            //TODO generate NEW APIKEY ON 401 error
            $result = $e->getMessage();
        }

        return $this->json(['result' => $result]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PlaceholderController extends AbstractController
{
    private const BASE_URL = 'https://jsonplaceholder.typicode.com/';

    public function __construct(
        private HttpClientInterface $client,
    ) {}

    #[Route('/api/placeholder/posts', methods: ['GET'])]
    public function getPosts(): JsonResponse
    {
        $response = $this->client->request('GET', self::BASE_URL . 'posts');
        $posts = $response->toArray();

        return new JsonResponse($posts);
    }

    #[Route('/api/placeholder/posts/{id}', methods: ['GET'])]
    public function getPost(int $id): JsonResponse
    {
        $response = $this->client->request(
            'GET',
            self::BASE_URL . 'posts/' . $id
        );

        $post = $response->toArray();

        return new JsonResponse($post);
    }
}
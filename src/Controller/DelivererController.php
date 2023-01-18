<?php

namespace App\Controller;

use App\Service\CommunicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DelivererController extends AbstractController
{
    private CommunicationService $communicationService;
    private HttpClientInterface $httpClient;

    public function __construct(CommunicationService $communicationService, HttpClientInterface $httpClient) {
        $this->communicationService = $communicationService;
        $this->httpClient = $httpClient;
    }

    /**
     * @Route("/deliverer/{city}", name="orders_by_city", methods={"GET"})
     * @param string $id
     * @return JsonResponse
     */
    public function getOrdersByUserAndCity(string $city) {
        $response = new JsonResponse();
        $ordersArray = [];

        $orders = $this->communicationService->getOrdersByCity($this->httpClient, $city);
        foreach ($orders as $order) {
            $orderArray = $order;
            $ordersArray[] = $orderArray;
        }

        $response->setData($ordersArray);
        return $response;
    }
}
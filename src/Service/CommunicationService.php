<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CommunicationService
{
    private string $urlRestaurant;
    private string $urlUser;

    public function __construct(string $urlRestaurant, string $urlUser) {
        $this->urlRestaurant = $urlRestaurant;
        $this->urlUser = $urlUser;
    }

    public function getRestaurantById(HttpClientInterface $httpClient, string $idRestaurant)
    {
        $response = $httpClient->request(
            'GET',
            $this->urlRestaurant . 'restaurants/' .$idRestaurant
        );


        return json_decode($response->getContent(), true);
    }

    public function getRestaurantByUserId(HttpClientInterface $httpClient, string $idUser)
    {
        $response = $httpClient->request(
            'GET',
            $this->urlRestaurant . 'users/' .$idUser . '/restaurants'
        );
        if ($response->getContent()) {
            return json_decode($response->getContent(), true);
        } else {
            return null;
        }
    }

    public function getItemById(HttpClientInterface $httpClient, string $idItem)
    {
        $response = $httpClient->request(
            'GET',
            $this->urlRestaurant . 'items/' . $idItem
        );


        return json_decode($response->getContent(), true);
    }

    public function getMenuById(HttpClientInterface $httpClient, string $idMenu)
    {
        $response = $httpClient->request(
            'GET',
            $this->urlRestaurant . 'menus/' . $idMenu
        );


        return json_decode($response->getContent(), true);
    }

    public function getOrdersByCity(HttpClientInterface $httpClient, string $city)
    {
        $response = $httpClient->request(
            'GET',
            $this->urlUser . 'city/' . $city . '/orders'
        );


        return json_decode($response->getContent(), true);
    }
}
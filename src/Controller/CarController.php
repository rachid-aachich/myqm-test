<?php
// src/Controller/CarController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CarController extends AbstractController
{
    private $client;
    private $api = 'https://api-sandbox.fintecture.com';
    private $providersEndpoint = '/res/v1/providers/';
    private $redirectUrl = 'https://62ecaf1d.ngrok.io/access';
    private $appId = '1683e2e3-dad4-4027-969e-3948457423b8';
    private $appSecret = '5e82adf3-02af-47e2-b4cd-aa542b43f2cd';
    private $basicToken;

    public function home()
    {
        return $this->render('base.html.twig', ['cars' => null]);
    }

    public function edit(Request $request)
    {
        $provider = $request->request->get('car');
        //
    }

    public function delete(Request $request)
    {
        $customerId = $request->query->get('customer_id');
        
        return $this->render('details.html.twig', ['balance' => $balance, 'currency' => $currency]);
    }

    public function show($accessToken, $customerId)
    {
        return json_decode($response->getContent())->data;
    }
}
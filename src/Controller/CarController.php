<?php
// src/Controller/CarController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Cars;
use App\Repository\CarsRepository;

class CarController extends AbstractController
{
    private $entityManager;
    private $api = 'https://api-sandbox.fintecture.com';
    private $providersEndpoint = '/res/v1/providers/';
    private $redirectUrl = 'https://62ecaf1d.ngrok.io/access';
    private $appId = '1683e2e3-dad4-4027-969e-3948457423b8';
    private $appSecret = '5e82adf3-02af-47e2-b4cd-aa542b43f2cd';
    private $basicToken;

    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;// $this->getDoctrine()->getManager();
       // $this->entityManager->getFilters()->enable('soft-deleteable');

    }

    public function home()
    {
        $cars = $this->entityManager->getRepository(Cars::class)->findBy(['isDeleted' => false]);
        return $this->render('base.html.twig', ['cars' => $cars]);
    }

    public function add(Request $request)
    {
        $brand = $request->request->get('brand');
        $model = $request->request->get('model');
        $color = $request->request->get('color');
        $price = $request->request->get('price');

        $car = new Cars();
        $car->setBrand($brand);
        $car->setModel($model);
        $car->setColor($color);
        $car->setPrice($price);

        $this->entityManager->persist($car);

        $this->entityManager->flush();
        return $this->json(['message' => 'Car added with ID: ' . $car->getId()]);
    }

    public function edit(Request $request)
    {
        $carId = $request->query->get('car');
        $brand = $request->request->get('brand');
        $model = $request->request->get('model');
        $color = $request->request->get('color');
        $price = $request->request->get('price');

        $car = $this->entityManager->getRepository(Cars::class)->find($carId);
        $car->setBrand($brand);
        $car->setModel($model);
        $car->setColor($color);
        $car->setPrice($price);

        $this->entityManager->merge($car);
        $this->entityManager->flush();

        return $this->json(['message' => 'Car ' .  $car->getId() . ' updated']);
    }

    public function delete(Request $request)
    {
        $carId = $request->query->get('car');
        $car = $this->entityManager->getRepository(Cars::class)->findOneBy(['id' => $carId]);

        $car->setIsDeleted(1);

        $this->entityManager->merge($car);
        $this->entityManager->flush();
        
        return $this->json(['message' => 'Car ' .  $car->getId() . ' deleted']);
    }

    public function show(Request $request)
    {
        $carId = $request->query->get('car');

        $car = $this->entityManager->getRepository(Cars::class)->findOneBy(['id' => $carId]);
        return new Response($car->getJsonObject());
    }
}
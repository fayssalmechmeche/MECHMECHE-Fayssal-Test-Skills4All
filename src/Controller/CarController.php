<?php

namespace App\Controller;

use App\Entity\Car;
use App\Class\Search;
use App\Form\CarType;
use App\Form\SearchType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager,)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'app_car')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {;


        //$car = $this->entityManager->getRepository(Car::class)->findAll();
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form = $form->handleRequest($request);
        $cars = $paginator->paginate(
            $this->entityManager->getRepository(Car::class)->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        if ($form->isSubmitted() && $form->isValid()) {
            //$cars = $this->entityManager->getRepository(Car::class)->findWithSearch($search);
            $cars = $paginator->paginate(
                $this->entityManager->getRepository(Car::class)->findWithSearch($search), /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                5 /*limit per page*/
            );
        }





        return $this->renderForm('car/index.html.twig', [
            'cars' => $cars,
            'form' => $form
        ]);
    }

    #[Route('/admin', name: 'app_car_admin')]
    public function admin(Request $request, PaginatorInterface $paginator): Response
    {

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form = $form->handleRequest($request);
        $cars = $paginator->paginate(
            $this->entityManager->getRepository(Car::class)->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
        if ($form->isSubmitted() && $form->isValid()) {
            //$cars = $this->entityManager->getRepository(Car::class)->findWithSearch($search);
            $cars = $paginator->paginate(
                $this->entityManager->getRepository(Car::class)->findWithSearch($search), /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                5 /*limit per page*/
            );
        }
        return $this->renderForm('car/crud.html.twig', [
            'cars' => $cars,
            'form' => $form,
        ]);
    }

    #[Route('/admin/create', name: 'app_car_create')]
    public function create(Request $request): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_car_admin');
        }
        return $this->renderForm('car/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/admin/delete/{id}', name: 'app_car_remove')]
    public function delete(Car $car): Response
    {
        $this->entityManager->remove($car);
        $this->entityManager->flush();
        return $this->redirectToRoute('app_car_admin');
    }

    #[Route('/admin/update/{id}', name: 'app_car_update')]
    public function update(Request $request, CarRepository $repository, $id): Response
    {
        $car = $repository->findOneBy(["id" => $id]);
        $form = $this->createForm(CarType::class, $car);
        $form = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $this->entityManager->persist($data);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_car_admin');
        }

        return $this->renderForm('car/create.html.twig', [
            'form' => $form,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Person;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/person')]
class PersonController extends AbstractController
{
    #[Route('/', name: 'new_person', methods: ['POST'])]
    public function new(EntityManagerInterface $em, Request $request): JsonResponse
    {
        $parameters = json_decode($request->getContent(), true);
        $person = new Person();
        $person->setName($parameters['name']);
        $person->setBio($parameters['bio']);

        $em->persist($person);
        $em->flush();
        return $this->json(["Person saved successfully"]);
    }

    #[Route('/', name: 'Person_get_all')]
    public function index(PersonRepository $personRepository): JsonResponse
    {
        $people = $personRepository->findAll();
        return $this->json($people);
    }

    #[Route('/{id}', name: 'delete_person', methods:["DELETE"])]
    public function delete(EntityManagerInterface $em, int $id): JsonResponse
    {
        $personRepository = $em->getRepository(Person::class);
        $person = $personRepository->find($id);
        if(is_null($person)) 
        {
            return $this->json("This person is already deleted");
        }
        $em->remove($person);
        $em->flush();
        return $this->json(["Congratulations! Person deleted successfully"]);
    }


    #[Route('/{id}', name: 'edit_person', methods:["PUT"])]
    public function edit(EntityManagerInterface $em, int $id, Request $request): JsonResponse
    {
        $personRepository = $em->getRepository(Person::class);
        $person = $personRepository->find($id);
        $parameters = json_decode($request->getContent(), true);
        $person->setName($parameters['name']);
        $person->setBio($parameters['bio']);
        $em->persist($person);
        $em->flush();
        return $this->json(["Congratulations! Person edited successfully"]);
    }
}







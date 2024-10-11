<?php

namespace App\Controller;

use App\Entity\Kakebo;
use App\Repository\KakeboRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoryController extends AbstractController
{
    #[Route('/historique', name: 'app_history')]
    public function index(KakeboRepository $kakebos): Response
    {
        $kakeboList = $kakebos->findBy(['user' => $this->getUser()], ['year_month_date' => 'DESC']);

        if (empty($kakeboList)) {
            return $this->redirectToRoute('app_history_add');
        }

        return $this->render('home/history.html.twig', [
            'kakebos' => $kakeboList,
        ]);
    }

    #[Route('/historique/ajouter', name: 'app_history_add')]
    public function add(EntityManagerInterface $entitiyManager): Response
    {
        $dateToCreate = (new \DateTimeImmutable())->setDate((int)date('Y'), (int)date('m'), 1);

        $kakeboAtDate = $entitiyManager->getRepository(Kakebo::class)->findOneBy(['user' => $this->getUser(), 'year_month_date' => $dateToCreate]);

        if (null !== $kakeboAtDate) {
            return $this->redirectToRoute('app_history');
        }

        $kakebo = (new Kakebo())
            ->setUser($this->getUser())
            ->setYearMonthDate($dateToCreate)
            ->setSaveMoney(0.0);

        $entitiyManager->persist($kakebo);
        $entitiyManager->flush();

        //TODO : Rediriger vers l'ajout de nouvelles recettes et dépenses
        return $this->render('home/app_history.html.twig');
    }
}

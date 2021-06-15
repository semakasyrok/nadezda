<?php

namespace App\Controller;

use App\Entity\Feedback;
use App\Entity\Order;
use App\Form\FeedbackFormType;
use App\Form\OrderFormType;
use App\Repository\FeedbackRepository;
use App\Repository\ServicesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    #[Route('/', name: 'site')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/souvenirs', name: 'souvenirs')]
    public function souvenirs(): Response
    {
        return $this->render('site/souvenirs.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/services', name: 'services')]
    public function services(
        ServicesRepository $servicesRepository,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {
        $order = new Order();
        $orderForm = $this->createForm(OrderFormType::class, $order);
        $orderForm->handleRequest($request);

        if ($orderForm->isSubmitted() && $orderForm->isValid()) {
            $entityManager->persist($order);
            $entityManager->flush();

            $this->addFlash('success_submit', true);
        }

        return $this->render('site/services.html.twig', [
            'services' => $servicesRepository->findAll(),
            'form' => $orderForm->createView(),
        ]);
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('site/about.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    #[Route('/feedback', name: 'feedback')]
    public function feedback(
        Request $request,
        EntityManagerInterface $entityManager,
        FeedbackRepository $feedbackRepository
    ): Response {
        $feedback = new Feedback();
        $feedbackForm = $this->createForm(FeedbackFormType::class, $feedback);
        $feedbackForm->handleRequest($request);

        if ($feedbackForm->isSubmitted() && $feedbackForm->isValid()) {
            $entityManager->persist($feedback);
            $entityManager->flush();

            $this->addFlash('success_submit', true);
        }

        return $this->render('site/feedback.html.twig', [
            'form' => $feedbackForm->createView(),
            'feedbacks' => $feedbackRepository->getLastFeedbacks()
        ]);
    }
}

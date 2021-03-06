<?php

namespace App\Controller\Admin;

use App\Entity\Feedback;
use App\Entity\Order;
use App\Entity\Services;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Админка');
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Отзывы', 'fas fa-list', Feedback::class);
        yield MenuItem::linkToCrud('Услуги', 'fas fa-file', Services::class);
        yield MenuItem::linkToCrud('Заказы', 'fas fa-tags', Order::class);
    }
}

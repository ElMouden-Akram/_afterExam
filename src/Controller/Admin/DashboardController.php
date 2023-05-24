<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Formation;
use App\Entity\OffreStage;
use App\Entity\OffreEmploi;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {


        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Aidus - Administration');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        if(!$user instanceof User){
            throw new \Exception("wrong user");
        }

        return parent::configureUserMenu($user)
            ->setAvatarUrl($user->getPicture())/*'pictures/profileUsers/akram.jpg'*/
            ->setName($user->getFirstName()." ".$user->getLastName());

    }

    

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToDashboard('Statistique', 'fas fa-chart-pie');
        yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Offre stage', 'fas fa-list', OffreEmploi::class);
        yield MenuItem::linkToCrud('Offre emploi', 'fas fa-list', OffreStage::class);
        yield MenuItem::linkToCrud('Formation', 'fas fa-list', Formation::class);
        yield MenuItem::linkToUrl('Page d\'accueil ', 'fas fa-home', $this->generateUrl('app_app'));
        // yield MenuItem::linkToCrud('Les utilisateurs', 'fas fa-user', User::class);
    }

    public function configureActions(): Actions
    {
        //👇Pour interdir tout creation d'un ligne dans un tableau depuis l'interface d'administration : 
        return parent::configureActions()->remove(Crud::PAGE_INDEX, Action::NEW);
    }
    
}

<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        /*
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
        */
        $array_roles = ['ROLE_ADMIN','ROLE_ETUDIANT'];
        return [
            ImageField::new('picture')
                ->setBasePath('/')
                ->setUploadDir('public/pictures/profileUsers')//https://symfonycasts.com/screencast/easyadminbundle/upload#play
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            IdField::new('id')
                ->onlyOnIndex(),// or hideOnForm()
            TextField::new('First_Name','Prenom'),
            TextField::new('Last_Name','Nom'),
            // ArrayField::new('Roles'),
                // ->setHelp("choisi un role de cette list : ['ROLE_ADMIN','ROLE_ETUDIANT']")
            ChoiceField::new('roles')
                ->setChoices(array_combine($array_roles,$array_roles))
                ->allowMultipleChoices()
                ->renderExpanded(),
            TextField::new('sexe'),
            TextField::new('CNI'),
            TextField::new('CNE'),
            TelephoneField::new('telephone'),
            // onlyWhenCreating
            // BooleanField::new('value')
            //    ->renderAsSwitch(false),
        ];
    }

}

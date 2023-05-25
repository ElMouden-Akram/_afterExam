<?php

namespace App\Controller\Admin;

use App\Entity\Formation;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FormationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formation::class;
    }

    /*
    */
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            AssociationField::new('cycleEtude',"Titre"),
            AssociationField::new('ajouterPar',"Ecrit par")->autocomplete(),
            BooleanField::new('validate'),
            TextEditorField::new('description'),
        ];
    }
}

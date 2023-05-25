<?php

namespace App\Controller\Admin;

use App\Entity\OffreStage;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OffreStageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OffreStage::class;
    }

    /*
    */
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            // TextField::new('title'),
            AssociationField::new('fkEmploi',"Titre"),
            AssociationField::new('ajouterPar',"Ecrit par")->autocomplete(),
            TextEditorField::new('description'),
        ];
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\OffreEmploi;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OffreEmploiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OffreEmploi::class;
    }

    /*
    */
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            AssociationField::new('fkEmploi',"Titre"),
            AssociationField::new('ajouterPar',"Ecrit par")->autocomplete(),
            BooleanField::new('validate'),
            TextEditorField::new('description'),
        ];
    }
}

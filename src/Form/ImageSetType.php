<?php
namespace App\Form;

use App\Entity\ImageSet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType; // MODIFIER L'IMPORT

class ImageSetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // UTILISER VICHIMAGETYPE
            ->add('imageFile', VichImageType::class, [
                'label' => 'Fichier image',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImageSet::class,
        ]);
    }
}
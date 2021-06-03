<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LinkFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('original_link', null,[
        'required'=> false,
      ])
      ->add('view', null, [
        'mapped' => false,
        'required'=> false
      ])
      ->add('redirect', null, [
        'mapped' => false,
        'required'=> false
      ]);
  }
}
?>

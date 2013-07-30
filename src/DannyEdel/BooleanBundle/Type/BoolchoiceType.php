<?php

namespace DannyEdel\BooleanBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BoolchoiceType extends AbstractType {
	public function setDefaultOptions( OptionsResolverInterface $resolver ) {
		$resolver->setDefaults( array(
			'choices' => array(
				'' => "Bitte wählen",
				'0' => "Nein", /** FIXME Translate this **/
				'1' => "Ja", /** FIXME Translate this **/
			),
			'expanded' => false, /* false: select field | true: radios */
		));
	}

	public function getParent() {
		return 'choice';
	}

	public function getName() {
		return 'boolchoice';
	}
}


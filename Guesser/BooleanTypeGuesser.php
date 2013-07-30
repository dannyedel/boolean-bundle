<?php

namespace DannyEdel\BooleanBundle\Guesser;

#use Symfony\Component\Form\FormTypeGuesserInterface;
#use Symfony\Component\Form\TypeGuess;

use Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\Guess\TypeGuess;
use Symfony\Component\Form\Guess\Guess;

/** This is based on Symfony's Doctrine-Bridge
	DoctrineOrmTypeGuesser
 */
class BooleanTypeGuesser extends DoctrineOrmTypeGuesser {

	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry);
	}

	public function guessType($class,$property) {
		$ret = $this->getMetadata($class);

		if ( !$ret ) {
			/* We didnt get any metadata.
				Fallback to what the original Doctrine type guesser does.
			 */
			return parent::guessType($class, $property);
		}

		list($metadata, $name) = $ret;
		$fieldType = $metadata->getTypeOfField($property);
		if ( $fieldType != 'boolean' ) {
			/* Since we only handle booleans,
				do whatever the original Doctrine type guesser does.
			 */
			return parent::guessType($class, $property);
		}
		return new TypeGuess('boolchoice', array(), Guess::VERY_HIGH_CONFIDENCE);
	}
}

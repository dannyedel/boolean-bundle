<?php

namespace DannyEdel\BooleanBundle\Guesser;

#use Symfony\Component\Form\FormTypeGuesserInterface;
#use Symfony\Component\Form\TypeGuess;

use Symfony\Bridge\Doctrine\Form\DoctrineOrmTypeGuesser;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Form\Guess\Guess;
use Symfony\Component\Form\Guess\ValueGuess;

/** This is based on Symfony's Doctrine-Bridge
	DoctrineOrmTypeGuesser
 */
class RequiredTypeGuesser extends DoctrineOrmTypeGuesser {

	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry);
	}

	public function guessRequired($class, $property) {
		$ret = $this->getMetadata($class);
		if ( !$ret )
			return null;

		list( $metadata, $name ) = $ret;

		if ( $metadata->hasField($property) ) {
			if ( $metadata->isNullable($property) ) {
				/* Nullable fields are optional. */
				return new ValueGuess(false, Guess::VERY_HIGH_CONFIDENCE);
			} else {
				/* Not-Nullable fields are required. */
				return new ValueGuess(true, Guess::VERY_HIGH_CONFIDENCE);
			}
		}
		return null;
	}
}

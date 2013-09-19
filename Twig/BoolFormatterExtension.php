<?php

namespace DannyEdel\BooleanBundle\Twig;

class BoolFormatterExtension extends \Twig_Extension{

	public function getFilters() {
		return [
			new \Twig_SimpleFilter(
				'bool',
				[ $this, 'boolFilter' ]
			)
		];
	}

	public function boolFilter($value) {
		/** FIXME Translate this **/
		if ( $value === null ) {
			return _("Nicht definiert");
		}
		if ( $value === true ) {
			return _("Ja");
		}
		elseif ( $value === false ) {
			return _("Nein");
		}

		/// FIXME: Value seems strange, throw exception?
		return var_export($value, true);
	}

	public function getName() {
		return 'bool_formatter';
	}
}

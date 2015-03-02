<?php
/**
 * Created by PhpStorm.
 * User: janis_gruzis
 * Date: 3/2/15
 * Time: 1:15 AM
 */

namespace Solitaire\Pile;


class SpecialSixteensTableauPile extends SixteensTableauPile
{
	const ALLOW_EMPTY = true;

	/**
	 * Get pile name.
	 * @return string
	 */
	public function getName()
	{
		return 'Sp. Tableau';
	}
} 
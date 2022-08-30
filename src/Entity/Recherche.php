<?php


namespace App\Entity;


class Recherche
{

	private $recherche;

	/**
	 * @return mixed
	 */
	public function getRecherche ()
	{
		return $this->recherche;
	}

	/**
	 * @param mixed $recherche
	 * @return Recherche
	 */
	public function setRecherche ($recherche): Recherche
    {
		$this->recherche = $recherche;
		return $this;
	}



}
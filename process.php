<?php

	class Process {
		private $maPropriete = 'this is a proprity';

		public function __construct(){
			echo '<p>this is my first object : the Constructor</p>' ;
		}

		public function nvllMethode(){
			#echo '<p>this is a methodes in addition : a Methode </p>';
			echo $this->maPropriete;
		}

		public function getMaPropriete(){
			return $this ->maPropriete;
		}

		public function setMaPropriete($nvllVal){
			$this->maPropriete = $nvllVal;
		}

	}
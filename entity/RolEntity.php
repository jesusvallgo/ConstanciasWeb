<?php
	Class RolEntity {
		var $idRol;
		var $rol;

		function setIdRol($idRol){
			$this->idRol = $idRol;
		}

		function getIdRol(){
			return $this->idRol;
		}

		function setRol($rol){
			$this->rol = $rol;
		}

		function getRol(){
			return $this->rol;
		}

		function castObject($data) {
			foreach ($data AS $key => $value){
				if( property_exists($this,$key) ){
					$this->{$key} = $value;
				}
				else{
					throw new BadInputDataException("El atributo $key no corresponde a la clase RolEntity");
				}
			}
		}
	}
?>
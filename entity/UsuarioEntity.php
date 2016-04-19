<?php
	Class UsuarioEntity {
		var $nombres;
		var $apellidoPaterno;
		var $apellidoMaterno;
		var $rol;

		function setNombres($nombres){
			$this->nombres = $nombres;
		}

		function getNombres(){
			return $this->nombres;
		}

		function setApellidoPaterno($apellidoPaterno){
			$this->apellidoPaterno = $apellidoPaterno;
		}

		function getApellidoPaterno(){
			return $this->apellidoPaterno;
		}

		function setApellidoMaterno($apellidoMaterno){
			$this->apellidoMaterno = $apellidoMaterno;
		}

		function getApellidoMaterno(){
			return $this->apellidoMaterno;
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
					throw new BadInputDataException("El atributo $key no corresponde a la clase UsuarioEntity");
				}
			}
		}
	}
?>
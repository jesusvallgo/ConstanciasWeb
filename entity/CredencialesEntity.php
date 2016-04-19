<?php
	Class CredencialesEntity {
		var $username;
		var $password;

		function setUsername($username){
			$this->username = $username;
		}

		function getUsername(){
			return $this->username;
		}

		function setPassword($password){
			$this->password = $password;
		}

		function getPassword(){
			return $this->password;
		}

		function castObject($data) {
			foreach ($data AS $key => $value){
				if( property_exists($this,$key) ){
					$this->{$key} = $value;
				}
				else{
					throw new BadInputDataException("El atributo $key no corresponde a la clase CredencialesEntity");
				}
			}
		}
	}
?>
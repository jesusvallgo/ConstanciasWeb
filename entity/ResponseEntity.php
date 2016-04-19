<?php
	Class ResponseEntity {
		var $message;
		var $usuario;

		function setMessage($message){
			$this->message = $message;
		}

		function getMessage(){
			return $this->message;
		}

		function setUsuario($usuario){
			$this->usuario = $usuario;
		}

		function getUsuario(){
			return $this->usuario;
		}
	}
?>
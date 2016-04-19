<?php
	Class DataBaseConnection{
		function getConnection(){
			try{
				$connection = new mysqli("localhost","CAE","C&er0oX!","avisos_web");
				return $connection;
			}
			catch(Exception $e) {
				throw new DataBaseException("Sin conexion a la base de datos");
			}
		}
	}
?>
<?php
	Class UsuarioDao{
		var $query = "";
		var $resultSet;
		var $numRows = 0;

		# Metodo para consultar el usuario de acuerdo a las credenciales de entrada
		function consultarUsuarioLogin($connection, $credentialsEntity){
			# Query para obtener los datos
			$query = "SELECT
					credenciales.username,
					rol.id_rol,
					rol.rol
				FROM
					credenciales
					INNER JOIN rol ON rol.id_rol = credenciales.id_rol
				WHERE
					credenciales.username = '".$credentialsEntity->getUsername()."'
					AND
					credenciales.password = '".$credentialsEntity->getPassword()."'";
			#echo $query;
			$resultSet=$connection->query($query);

			if( $resultSet ){
				$numRows = $resultSet->num_rows;
				if( $numRows>0 ){
					$usuarioEntity = new UsuarioEntity;
					$registro=$resultSet->fetch_array();

					while($registro){
						$rolEntity = new RolEntity;
						$rolEntity->setIdRol($registro["id_rol"]);
						$rolEntity->setRol($registro["rol"]);

						$usuarioEntity->setNombres($registro["username"]);
						$usuarioEntity->setApellidoPaterno($registro["username"]);
						$usuarioEntity->setApellidoMaterno($registro["username"]);
						$usuarioEntity->setRol($rolEntity);

						$registro=$resultSet->fetch_array();
					}

					return $usuarioEntity;
				}
				else{
					throw new NoUserException("El usuario no esta registrado en el sistema");
				}
			}
			else {
				throw new SQLException("No se pudo ejectutar la SQL");
			}
		}
	}
?>
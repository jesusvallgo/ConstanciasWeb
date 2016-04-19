<?php
	ini_set("display_errors", 1);

	# Excepciones necesarias
	require("../exception/NoInputDataException.php");
	require("../exception/BadInputDataException.php");
	require("../exception/DataBaseException.php");
	require("../exception/SQLException.php");
	require("../exception/NoUserException.php");

	# Entidades necesarias
	require("../entity/ResponseEntity.php");

	require("../entity/CredencialesEntity.php");
	require("../entity/RolEntity.php");
	require("../entity/UsuarioEntity.php");

	# Conexiones necesarias
	require("../connection/DataBaseConnection.php");

	# DAO necesarios
	require("../dao/UsuarioDao.php");

	# Habilita el uso de variables de sesion
	session_start();
	
	# Establece el tipo de respuesta a enviar
	header('content-type: application/json');

	# Permite a MySQLi arrojar excepciones
	mysqli_report(MYSQLI_REPORT_STRICT);

	# Instancia a la entidad "ResponseEntity" que sera devuelta al cliente
	$responseEntity = new ResponseEntity;

	# Instancia a la entidad "CredencialesEntity"
	$credencialesEntity = new CredencialesEntity;

	# Instancia para conectar a la base de datos
	$dataBaseConnection = new DataBaseConnection;
	$connection = null;

	# Instancia al DAO de "UserEntity"
	$usuarioDao = new UsuarioDao;

	# Variables necesarias
	$apiKey = "";
	$userJson = "";

	try{
		$apiKey = trim($_GET["apiKey"]);
		if( $apiKey == "" ){
			throw new NoInputDataException("No se ha definido el apiKey");
		}

		# Recupera el JSON del apiKey
		$userJson = json_decode($apiKey);

		if( json_last_error() != JSON_ERROR_NONE ){
			throw new BadInputDataException("El apiKey no es correcto");
		}

		# Convierte el JSON recibido en una entidad "UsuarioEntity"
		$credencialesEntity->castObject($userJson);

		# Intenta establecer conexion a la Base de Datos
		$connection = $dataBaseConnection->getConnection();

		# Valida las credenciales de usuario
		$usuarioEntity = $usuarioDao->consultarUsuarioLogin($connection,$credencialesEntity);

		# Define las acciones a realizar de acuerdo al metodo de consulta
		switch($_SERVER["REQUEST_METHOD"]){
			case "GET":
				$responseEntity->setUsuario($usuarioEntity);
				break;
			case "PUT":
				break;
			case "DELETE":
				break;
			default:
				$responseEntity->setMessage("No es un método válido");
				break;
		}
	} catch (NoInputDataException $nidEx) {
		$responseEntity->setMessage($nidEx->getMessage());
	} catch (BadInputDataException $bidEx) {
		$responseEntity->setMessage($bidEx->getMessage());
	} catch (DataBaseException $ncEx) {
		$responseEntity->setMessage($ncEx->getMessage());
	} catch (SQLException $sqlEx) {
		$responseEntity->setMessage($sqlEx->getMessage());
	} catch (NoUserException $nuEx) {
		$responseEntity->setMessage($nuEx->getMessage());
	} catch (Exception $ex) {
		$responseEntity->setMessage($ex->getMessage());
	} finally{
		# Genera la respuesta
		echo json_encode($responseEntity);
	}

	# Almacena el objeto en una variable de sesion
	#$_SESSION["response"]=$responseEntity;
?>
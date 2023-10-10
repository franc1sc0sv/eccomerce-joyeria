<?php
include_once("./helpers/includes.php");

header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents('php://input'), true);


    if (isset($data['name']) && isset($data['direction']) && isset($data['card_number']) && isset($data['cv']) && isset($data['date']) && ($data['productos'])) {
        $name = ($data["name"]);
        $direction = ($data["direction"]);
        $cardNumber = ($data["card_number"]);
        $cv = ($data["cv"]);
        $date = ($data["date"]);
        $products = json_encode($data['productos']);

        $productos = json_encode($products);
        $id = $_SESSION['id'];


        if (empty($name) || empty($direction) || empty($cardNumber) || empty($cv) || empty($date)) {
            echo json_encode(array('success' => false, 'message' => 'No se permiten campos vacios.', 'type' => 'error'));
            exit;
        }

        //Validar tarjeta
        if (!preg_match('/^[0-9]{16}$/', $cardNumber)) {
            echo json_encode(array('success' => false, 'message' => 'Tarjeta de credito no valida.', 'type' => 'error'));
            exit;
        }
        //Validar cv
        if (!preg_match('/^[0-9]{3,4}$/', $cv)) {
            echo json_encode(array('success' => false, 'message' => 'El cv debe de tener 3 0 cuatro caracteres', 'type' => 'error'));
            exit;
        }

        //Validar fecha
        $fecha_actual = date('Y-m-d');
        if ($date <= $fecha_actual) {
            echo json_encode(array('success' => false, 'message' => 'Fecha no valida.', 'type' => 'error'));
            exit;
        }


        try {
            $sql = "INSERT INTO pedidos (nombre	, direccion, productos, id_usuario) VALUES ('$name', '$direction', $productos, $id)";
            $conn->ejecutar($sql);


            echo json_encode(array('success' => true, 'message' => 'Datos guardados exitosamente.', 'type' => 'success'));
        } catch (PDOException $e) {
            echo json_encode(array('success' => false, 'message' => 'Se produjo un error: ' . $e->getMessage(), 'type' => 'error'));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Faltan campos obligatorios.', 'type' => 'error'));
    }

}
?>
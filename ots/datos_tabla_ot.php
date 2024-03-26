
<?php
include_once '../conn/connn.php';

//url datos de tabla
$consulta = "SELECT o.id, o.description, o.leader, o.status, o.created_at, o.number, o.cotizacion,
cli.name,
bra.location,
ser.service_name
FROM  ots o
INNER JOIN clients cli ON o.id_client = cli.id
INNER JOIN branches bra ON o.id_branch = bra.id
INNER JOIN services ser ON o.id_service = ser.id ORDER BY o.created_at desc";
$resultado = $con->query($consulta);

if ($resultado->num_rows > 0) {
    $data = $resultado->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([], JSON_UNESCAPED_UNICODE); // Enviar un array vacío si no hay resultados
}


?>

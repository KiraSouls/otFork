<?php
$con = new mysqli("tu_host", "tu_usuario", "tu_contraseña", "tu_base_de_datos");

$start = $_POST['start'];
$length = $_POST['length'];

$sel = $con->query("SELECT o.id, o.description, o.leader, o.status, o.created_at, o.number,
                            cli.name,
                            bra.location,
                            ser.service_name
                      FROM  ots o
                      INNER JOIN clients cli ON o.id_client = cli.id
                      INNER JOIN branches bra ON o.id_branch = bra.id
                      INNER JOIN services ser ON o.id_service = ser.id ORDER BY o.created_at DESC
                      LIMIT $start, $length");

$data = array();

while ($f = $sel->fetch_assoc()) {
    $data[] = $f;
}

$response = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => mysqli_num_rows($sel),
    "recordsFiltered" => mysqli_num_rows($sel),
    "data" => $data,
);

echo json_encode($response);

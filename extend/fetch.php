<?php


if(isset($_POST["view"]))
{
    include '../conn/connn.php';
    $sel2 = $con->query("SELECT * FROM notifications ORDER BY id DESC LIMIT 5");
    $output = '';


    if (mysqli_num_rows($sel2) > 0)
    {
    while ($f = $sel2->fetch_assoc())
    {

        $output .= '
        <li>
            <a>
            <strong>'.$f["notification_name"].'</strong><br />
            <small><em>'.$f["created_at"].'</em></small>
            </a>
        </li>
        ';
    }
    }
    else{
        $output .= '
        <li>
            <a>
            No se han encontrado notificaciones
            </a>
        </li>
        ';
    }
    $sel_unseen = $con->query("SELECT * FROM notifications WHERE status=0");
    $count_unseen = mysqli_num_rows($sel_unseen);
    $data = array(
        'notification' => $output,
        'unseen_notification' => $count_unseen
    );
    echo json_encode($data);

}        
?>

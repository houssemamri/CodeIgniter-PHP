<?php
session_start();

    require 'config.php';

    /*
     *  QUANDO SI SALVA LA SORGENTE ADESSO SI PUO AVERE ACCESSO A TUTTI I PARAMETRI 'data'
     *  DEL DIV CON ID='tosave';
     */
require '../connection.php';

    $config = array();
    if (isset($_POST['data'])) {
        foreach ($_POST['data'] as $param=>$value) {    $config[$param] = $value; }
    }
  

    $html         = ( get_magic_quotes_gpc() ) ? stripslashes($_POST['html']) : $_POST['html'];
    $filename     = dirname(__FILE__).'/tmp/body_'.time().'.html';

    /*
     * IN $config TROVI I VALORI DELLE VARIABILI PER INDICE
     */

    if (  file_put_contents($filename, $html) ) {
         // echo "File ".$filename.' was created';
        $user_id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $html_sql = $conn->real_escape_string($_POST['html']);
        $path_sql = str_replace(dirname(__FILE__), $path, $filename);
        $id = $_POST['id'];
        if($id == '0') {
            $sql = "INSERT INTO templates (user_id, name, html, link,created_at) VALUES ('" . $user_id . "', '" . $name . "', '" . $html_sql . "','" . $path_sql . "', now()); ";
            $insert = mysqli_query($conn,$sql);
            $id = $conn->insert_id;
        }else {
            $sql = "UPDATE templates SET name = '" . $name . "', html= '" . $html_sql . "', link= '" . $path_sql . "',updated_at = now() where id = '" . $id . "'; ";
            $insert = mysqli_query($conn,$sql);

        }

        if($insert) {
            echo $id;

        }else{
            echo '0';
        }
    }


?>

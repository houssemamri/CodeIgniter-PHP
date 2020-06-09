<?php
    require 'config.php';
    require '../connection.php';

    session_start();
    $html         = ( get_magic_quotes_gpc() ) ? stripslashes($_POST['html']) : $_POST['html'];
    //$option       = ( $_POST['option']=='' ) ? $_POST['option'] : 'template';

    /*
     *  QUANDO SI SALVA LA SORGENTE ADESSO SI PUO AVERE ACCESSO A TUTTI I PARAMETRI 'data'
     *  DEL DIV CON ID='tosave';
     */

    $config = array();
    if (isset($_POST['data'])) {
        foreach ($_POST['data'] as $param=>$value) {    $config[$param] = $value; }
    }

    /*
     * IN $config TROVI I VALORI DELLE VARIABILI PER INDICE
     */

    $filename     = dirname(__FILE__).'/tmp/'.time().'.html';
    $templateFile = file_get_contents('template.html');
    // saving the file
    //$templateFile = str_replace('{title}', $title, $templateFile);
    $templateFile = str_replace('{body}', $html, $templateFile);

    if (  file_put_contents($filename, $templateFile) ) {


        $user_id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $html_sql = $conn->real_escape_string($templateFile);
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

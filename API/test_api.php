<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 24/05/2018
 * Time: 09:45
 */

include "api.php";

$api_object = new API();

if($_GET['action'] == 'fetch_all') {

    $data = $api_object->fetch_all();
}

if($_GET['action'] == 'insert') {

    $data = $api_object->insert();

}

if($_GET['action'] == 'fetch_single') {

    $data = $api_object->fetch_single($_GET['id']);

}

if($_GET['action'] == 'update') {

    $data = $api_object->update($_GET['id']);

}

if($_GET["action"] == 'delete')
{
    $data = $api_object->delete($_GET["id"]);
}


echo json_encode($data);

?>
<?php
/**
 * Created by PhpStorm.
 * User: Leonardo
 * Date: 24/05/2018
 * Time: 09:47
 */

$api_url = "http://localhost/ApiRestFilmes/API/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);


$output = '';

if(count($result) > 0) {

    foreach ($result as $row) {

        $output .= '
  <tr>
   <td>'.$row->filme.'</td>
   <td>'.$row->diretor.'</td>
   <td>'.$row->genero.'</td>
   <td>'.$row->avaliacao.'</td>
   <td>'.$row->sinopse.'</td>
   <td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Edit</button></td>
   <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Delete</button></td>
  </tr>
  ';

    }

} else {

    $output .= "<tr><td colspan='4' align='center'>No Data Found</td></tr>";
}


echo $output;




<?PHP
require '../configure.php';
require './handle_map_capture.php';


$requestPayload = file_get_contents('php://input');
$object = json_decode($requestPayload, true);

$skyColor = $object['skyColor'];
$remainedSushi = $object['remainedSushi'];
$obstacles = $object['obstacles'];
$json_map = json_encode($object['json_map']);
$base64_map_capture = $object['base64MapCapture'];
$player_id = $object['playerId'];


$map_capture = handleCapture($base64_map_capture);

$SQL = "INSERT INTO maps (level, skyColor, remainedSushi, obstacles, json_map, map_capture, player_FK) 
            VALUES (NULL, '$skyColor', $remainedSushi, $obstacles,'$json_map', '$map_capture', $player_id)";

mysqli_query($db, $SQL);

$last_id = $db->insert_id;

$response = array();
$response['map_id'] = $last_id;
$response['message'] = 'map for player with id ' . $player_id . ' was successfully added';

echo json_encode($response);

mysqli_close($db);

<?PHP
require '../configure.php';

$requestPayload = file_get_contents('php://input');
$object = json_decode($requestPayload, true);

$name = $object['Name'];
$level = $object['Level'];
$sushi = $object['Sushi'];
$spriteSheet = $object['spriteSheet'];
$width = $object['width'];
$height = $object['height'];

$SQL = "INSERT INTO players (Name, Level, Sushi, spriteSheet, width, height) 
            VALUES ('$name', '$level', '$sushi', '$spriteSheet', '$width', '$height')";

mysqli_query($db, $SQL);

$last_id = $db->insert_id;

$response = array();
$response['player_id'] = $last_id;
$response['message'] = 'player with id ' . $last_id . ' was successfully added';
echo json_encode($response);

mysqli_close($db);

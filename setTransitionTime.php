<?php

$transitionTime = 0;

$baseURL = 'http://192.168.178.84';
$user = 'slRGm2VZ7azcmxkRZPzBGTPuGp7bLT801768pLTr';
$scene_name = $argv[1];
$scene = '';

// Get all Scenes
echo "Alle Szenen abrufen" . PHP_EOL;
$scenes = json_decode(file_get_contents($baseURL . '/api/' . $user . '/scenes'));

foreach ($scenes as $scene_id => $single_scene) {
    if ($single_scene->name == $scene_name) {
        $scene = $scene_id;
        echo "Szenen ID = ". $scene . PHP_EOL;
    }
}


// GET Scene
echo "Szene " . $scene . " abrufen" . PHP_EOL;
$sceneObject = json_decode(file_get_contents($baseURL . '/api/' . $user . '/scenes/' . $scene));

foreach ($sceneObject->lightstates as $lamp => $lightstate) {

    //Check if Transition Time is already set
    if (!isset($lightstate->transitiontime)) {
        echo "Transitiontime für Lampe  " . $lamp . " setzten" . PHP_EOL;
        $lightstate->transitiontime = 0;

        $data_string = json_encode($lightstate);

        // Set Transition Time
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseURL . '/api/' . $user . '/scenes/' . $scene . '/lightstates/' . $lamp);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,  $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ));
        $output = curl_exec($ch);

        curl_close($ch);
    }
}

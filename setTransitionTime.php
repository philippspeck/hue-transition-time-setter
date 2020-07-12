<?php

$transitionTime = 0;

$baseURL = 'http://192.168.xx.xx';
$user = 'YOUR HUE USER ID';
$scene_name = $argv[1];
$scene = '';

// Get all Scenes
echo "Get all scenes" . PHP_EOL;
$scenes = json_decode(file_get_contents($baseURL . '/api/' . $user . '/scenes'));

foreach ($scenes as $scene_id => $single_scene) {
    if ($single_scene->name == $scene_name) {
        $scene = $scene_id;
        echo "Scene ID = " . $scene . PHP_EOL;
    }
}


// GET Scene
echo "Get scene " . $scene . "" . PHP_EOL;
$sceneObject = json_decode(file_get_contents($baseURL . '/api/' . $user . '/scenes/' . $scene));

foreach ($sceneObject->lightstates as $lamp => $lightstate) {

    //Check if Transition Time is already set
    if (!isset($lightstate->transitiontime)) {
        echo "Set transitiontime for bulb  " . $lamp . "" . PHP_EOL;
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

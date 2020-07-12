This is a little helper script to set the transitiontime for Scenes on the Philips Hue Bridge to solve problems with lightbulbs of other vendors than Philips (Problem described here: https://hueblog.de/community/frage/ikea-tradfri-eingestellte-dimmung-wird-bei-szenen-nicht-erkannt/) 

It is a automated variant of the guide provided here: https://hueblog.de/community/frage/ikea-tradfri-eingestellte-dimmung-wird-bei-szenen-nicht-erkannt/ (German)

## What does this do?

The Script searches for the scene with the provided scene name and sets the transitiontime for all bulbs in this scene to 0.

## Usage

1. Set your base URL to variable `$baseURL`. This is the IP of your Hue Bridge

2. Set your Hue user ID to variable `$user`. To get a User ID see Dev Handbook by Philips: https://developers.meethue.com/develop/get-started-2/

3. Start the script with `php setTransitionTime.php "scene name"` (i.e. `php setTransitionTime.php "Reading"`)

## Disclaimer
This is a quick script to automate the process of setting the tranisition time manually. I am aware that this is no clean code and there is no proper Exception Handling.
So using this script is at your own risk.

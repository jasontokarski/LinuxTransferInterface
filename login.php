<?php
require 'inc/openid.php';
$_STEAMAPI = "2352EDA566FA318BA4FF4229F638DFC1";
 
try 
{
    $openid = new LightOpenID('http://yourwebsite.com/landingpage');
    if(!$openid->mode) 
    {
        if(isset($_GET['login'])) 
        {
            $openid->identity = 'http://steamcommunity.com/openid/?l=english';    // This is forcing english because it has a weird habit of selecting a random language otherwise
            header('Location: ' . $openid->authUrl());
			echo $openid->authUrl();
        }
?>

<form action="?login" method="post">
    <input type="image" src="http://cdn.steamcommunity.com/public/images/signinthroughsteam/sits_small.png">
</form>

<?php
    } 
    elseif($openid->mode == 'cancel') 
    {
        echo 'User has canceled authentication!';
    } 
    else 
    {
        if($openid->validate()) 
        {
                $id = $openid->identity;
                // identity is something like: http://steamcommunity.com/openid/id/76561197960435530
                // we only care about the unique account ID at the end of the URL.
                $ptn = "/^https:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                preg_match($ptn, $id, $matches);

                $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$_STEAMAPI&steamids=$matches[1]";
                $_SESSION["$json_object"] = file_get_contents($url);
                $json_decoded = json_decode($_SESSION["$json_object"]);

                foreach ($json_decoded->response->players as $player)
                {
					$_SESSION["steam_id"] = toSteamID($player->steamid);
                    echo 'User is logged in (SteamID: ' . $_SESSION["steam_id"] . ')<br>';
                }
        } 
        else 
        {
                echo "User is not logged in.\n";
        }
    }
} 
catch(ErrorException $e) 
{
    echo $e->getMessage();
}

?>
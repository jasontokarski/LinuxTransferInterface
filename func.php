<?php 

function extensionExists($filename) {
    $file_parts = pathinfo($filename);

    switch($file_parts['extension']){
        case "html":
        return 1;
        break;
        
        case "php":
        return 1;
        break;
        
        case NULL: // Handle no file extension
        return 0;
        break;
        
        default:
        echo "Filename must end in HTML, PHP, or no extension!";
        exit();
    }
    return 0;
}

function transferFile($filename)
{
    $success = 0;
    if (!function_exists("shell_exec")) {
        die("Cannot find shell execution function!");
    }

    $result = shell_exec("sudo -u testuser ls /home/testuser/ | grep " . $filename);

    if($result){
        if(!($return = shell_exec("sudo -u testuser sshpass -f /home/testuser/resources/passwordServer1 scp -r /home/testuser/" . $filename . " root@31.186.251.135:/root 2>&1"))){
            echo "$result transferred to the server1 successfully! <br>";
            $success++;
        } else {
            echo $return . "<br>";
        }
        
        if(!($return = shell_exec("sudo -u testuser sshpass -f /home/testuser/resources/passwordServer2 scp -r /home/testuser/" . $filename . " root@108.61.168.31:/root 2>&1"))){
            echo "$result transferred to the server2 successfully! <br>";
            $success++;
        } else {
            echo $return . "<br>";
        }
    }
    else{
        echo "$filename not found!";
    }

    if($success == 2){
        echo "$result has been transferred to all servers successfully! <br>";
    }
}

function toSteamID($id) {
    if (is_numeric($id) && strlen($id) >= 16) {
        $z = bcdiv(bcsub("$id", '76561197960265728'), '2');
    } 
	elseif (is_numeric($id)) {
        $z = bcdiv($id, '2'); 
    } else {
        return $id;
    }
    $y = bcmod($id, '2');
	return 'STEAM_0:' . $y . ':' . floor($z);
}

function setBlocking(&$streamObj, $serverLocation){
    stream_set_blocking($streamObj, true);
    $stream_out = ssh2_fetch_stream($streamObj, SSH2_STREAM_STDIO);
    $stream_content = stream_get_contents($stream_out);
    if($stream_content){
        echo "Error: " . $stream_content;
        session_destroy();
    } else {
        echo "File transferred to the " . $serverLocation . " server successfully!<br>";
    }
    fclose($streamObj);
}
?>
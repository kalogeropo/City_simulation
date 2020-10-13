<?php 

$command = escapeshellcmd('/opt/lampp/cgi-bin/kmlparser.py');
$output = shell_exec($command);
echo $output;

?>

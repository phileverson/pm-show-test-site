<?php
shell_exec('cd ..');
$tmp = shell_exec('git rev-parse --abbrev-ref HEAD');
$output = htmlentities(trim($tmp));
echo '<p>' . $output . '</p>';
?>
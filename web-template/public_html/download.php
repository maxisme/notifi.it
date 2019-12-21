<?php
$settings = yaml_parse_file("../config.yaml");
header("Location: ".$settings['app']['dmg']);
?>
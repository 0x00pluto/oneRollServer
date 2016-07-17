<?php
require "../include/gateway.php";

$gateway = new gateway ();
$returndata = "f";
if (isset ($_POST ["data"])) {

    $returndata = $gateway->processMessage($_POST ["data"]);
}

echo $returndata;

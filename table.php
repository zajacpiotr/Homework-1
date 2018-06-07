<?php
include_once("Class/Core.php");
include_once("layoutHeader.php");

$core = new Core();
$read = $core->readAll();

echo "<div class='conteinerT'>";
    echo "<h2>Added malfunctions</h2>";
    echo "<table>";
         echo "<tr>";
         echo "<td>ID</td>";
         echo "<td>Device model</td>";
         echo "<td>Malfunction description</td>";
         echo "</tr>";
    foreach ($read as $key => $res) { 
         echo "<tr>";
         echo "<td>".$res['id']."</td>";
         echo "<td>".$res['device']."</td>";
         echo "<td>".$res['description']."</td>"; 
    }
    echo "</table>";
echo "<a href='index.php'>Go back</a>";
echo "</div>";

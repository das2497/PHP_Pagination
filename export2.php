
<?php
//export.php  
$connect = mysqli_connect("localhost", "root", "Dds1234@56A$", "world", "3306");
$output = '';

$query = "SELECT city.ID ,city.CName ,country.Name ,city.District ,city.Population FROM city INNER JOIN country ON city.CountryCode=country.Code ORDER BY  city.ID ASC;";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
     $output .= "id,name,country,district,population \n";

     while ($d = mysqli_fetch_array($result)) {
          $output .= $d["ID"] . "," . $d["CName"] . "," . $d["Name"] . "," . $d["District"] . "," . $d["Population"] . "\n";
     }

     header('Content-Type: application/xls');
     header('Content-Disposition: attachment; filename=download.xls');
     echo $output;
}

?>

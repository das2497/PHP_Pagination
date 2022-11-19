<?php

require 'connection.php';

$query = "SELECT city.ID ,city.CName ,country.Name ,city.District ,city.Population FROM city INNER JOIN country ON city.CountryCode=country.Code";

switch (empty($_POST["sb"])) {
    case 'true':
        switch ($_POST["sc"]) {
            case '0':

                break;

            default:
                $query .= " WHERE country.Code='" . $_POST["sc"] . "'";
                break;
        }

        break;

    default:
        switch (isset($_POST["sc"])) {
            case '0':
                $query .= " WHERE city.ID LIKE '%" . $_POST["sb"] . "%' OR city.CName LIKE '%" . $_POST["sb"] . "%' OR city.District LIKE '%" . $_POST["sb"] . "%' OR city.Population LIKE '%" . $_POST["sb"] . "%'";
                break;



            default:

                $query .= " WHERE (city.ID LIKE '%" . $_POST["sb"] . "%' AND country.Code='" . $_POST["sc"] . "') OR (city.CName LIKE '%" . $_POST["sb"] . "%' AND country.Code='" . $_POST["sc"] . "') OR (city.District LIKE '%" . $_POST["sb"] . "%' AND country.Code='" . $_POST["sc"] . "') OR (city.Population LIKE '%" . $_POST["sb"] . "%' AND country.Code='" . $_POST["sc"] . "')";
                break;
        }
        break;
}

// echo $query . " ORDER BY  city.ID ASC;";

$output = '';

$c2 = Database::search($query . " ORDER BY  city.ID ASC;");
$n2 = $c2->num_rows;

if (mysqli_num_rows($c2) > 0) {
    $output .= "id,name,country,district,population \n";

    while ($d = mysqli_fetch_array($c2)) {
        $output .= $d["ID"] . "," . $d["CName"] . "," . $d["Name"] . "," . $d["District"] . "," . $d["Population"] . "\n";
    }

    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=download.xls');
    echo $output;
}

<?php

require 'connection.php';

// $txt = $_POST["sb"];
// $cntr = $_POST["sc"];

$output = "";

$query = "SELECT city.ID ,city.CName ,country.Name ,city.District ,city.Population FROM city INNER JOIN country ON city.CountryCode=country.Code";

switch ($_POST["sb"]) {
    case !"":
        switch ($_POST["sc"]) {
            case !"":
                $query .= " WHERE city.ID LIKE '%" . $_POST["sb"] . "%' OR city.CName LIKE '%" . $_POST["sb"] . "%' OR city.District LIKE '%" . $_POST["sb"] . "%' OR city.Population LIKE '%" . $_POST["sb"] . "%' OR country.Code='" . $_POST["sc"] . "'";
                break;

            default:
                $query .= " WHERE city.ID LIKE '%" . $_POST["sb"] . "%' OR city.CName LIKE '%" . $_POST["sb"] . "%' OR city.District LIKE '%" . $_POST["sb"] . "%' OR city.Population LIKE '%" . $_POST["sb"] . "%'";
                break;
        }
        break;

    default:
        switch ($_POST["sc"]) {
            case !"":
                $query .= " WHERE country.Code='" . $_POST["sc"] . "'";
                break;

            default:

                break;
        }
        break;
}

//  echo $query;

?>


<table style="width: 50%;">
    <thead>

        <th>id</th>
        <th>name</th>
        <th>country</th>
        <th>district</th>
        <th>population</th>

    </thead>
    <tbody>

        <?php

$c2 = Database::search($query . " ORDER BY  city.ID ASC;");
$n = $c2->num_rows;

        for ($dd = 0; $dd < $n; $dd++) {
            $d = $c2 ->fetch_assoc();

        ?>
            <tr>
                <td style="text-align: center;"><?php echo $d["ID"]; ?></td>
                <td style="text-align: center;"><?php echo $d["CName"]; ?></td>
                <td style="text-align: center;"><?php echo $d["Name"]; ?></td>
                <td style="text-align: center;"><?php echo $d["District"]; ?></td>
                <td style="text-align: center;"><?php echo $d["Population"]; ?></td>
            </tr>
        <?php

        }
        ?>

    </tbody>
</table>

<?php

header('Content-Type: application/xls');
header('Content-Disposition: attachment; filename=download.xlsx');
readfile('download.xlsx');
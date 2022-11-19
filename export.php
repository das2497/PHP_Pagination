<?php

require 'connection.php';

$c = Database::search("SELECT city.ID ,city.CName ,country.Name ,city.District ,city.Population FROM city INNER JOIN country ON city.CountryCode=country.Code ORDER BY  city.ID ASC;");
$n = $c->num_rows;

$output = '';
if (isset($_POST["export"])) {

    if ($n > 0) {



        $output .= '   <table class="table table-bordered">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>country</th>
                    <th>district</th>
                    <th>population</th>
                </tr>';

        while ($d = $c->fetch_assoc()) {
            $output .= '  
                   <tr>
                    <td style="text-align: center;">' . $d["ID"] . '</td>
                    <td style="text-align: center;">' . $d["CName"] . '</td>
                    <td style="text-align: center;">' . $d["Name"] . '</td>
                    <td style="text-align: center;">' . $d["District"] . '</td>
                    <td style="text-align: center;">' . $d["Population"] . '</td>
                </tr>';
        }

        $output .= '</table>';

        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=download.xls');
        echo $output;
    }
}

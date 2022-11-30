<?php

require 'connection.php';

// $txt = $_POST["sb"];
// $cntr = $_POST["sc"];


$page;

if (isset($_GET["x"])) {

    $page = $_GET["x"];

    // echo $_GET["x"];
} else {

    $page = 1;
}

// echo "page " . $page;


$page_results = ($page - 1) * 10;

$query = "SELECT city.ID ,city.CName ,country.Name ,city.District ,city.Population FROM city INNER JOIN country ON city.CountryCode=country.Code";

switch (isset($_POST["sb"])) {
    case 'true':
        switch (isset($_POST["sc"])) {
            case 'true':
                $query .= " WHERE (city.ID LIKE '%" . $_POST["sb"] . "%' AND country.Code='" . $_POST["sc"] . "') OR (city.CName LIKE '%" . $_POST["sb"] . "%' AND country.Code='" . $_POST["sc"] . "') OR (city.District LIKE '%" . $_POST["sb"] . "%' AND country.Code='" . $_POST["sc"] . "') OR (city.Population LIKE '%" . $_POST["sb"] . "%' AND country.Code='" . $_POST["sc"] . "')";
                break;



            default:
                $query .= " WHERE city.ID LIKE '%" . $_POST["sb"] . "%' OR city.CName LIKE '%" . $_POST["sb"] . "%' OR city.District LIKE '%" . $_POST["sb"] . "%' OR city.Population LIKE '%" . $_POST["sb"] . "%'";
                break;
        }
        break;

    default:
        switch (isset($_POST["sc"])) {
            case 'true':
                $query .= " WHERE country.Code='" . $_POST["sc"] . "'";
                break;

            default:

                break;
        }
        break;
}


$c = Database::search($query . " ORDER BY  city.ID ASC  LIMIT 10 OFFSET " . $page_results . ";");
$n = $c->num_rows;

$c2 = Database::search($query . " ORDER BY  city.ID ASC;");
$n2 = $c2->num_rows;

 echo $query. " ORDER BY  city.ID ASC;";

//   LIMIT 10 OFFSET 0

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

        for ($dd = 0; $dd < $n; $dd++) {
            $d = $c->fetch_assoc();

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


<div style="width: 50%; text-align: center; margin-top: 80px;" class="">
    <div class="pagination ">

        <?php

        if ($n2 != 0) {


            // $links = "";

            $page_count = ceil($n2 / 10);

            if ($page >= 1 + 5) {

                //  $links .= "<a href='#'>&laquo;</a>";
        ?>

                <a href='#' onclick="load(<?php echo $page - 1; ?>);">&laquo;</a>


                <a href='#' onclick="load(1);">1 ......</a>

            <?php
            }


            //  else {
            // 
            ?>

            <!-- <a href="#">&laquo;</a> -->

            <?php
            //}


            $i = max(1, $page - 5);





            //=================================================================================================================

            for (; $i < min($page + 5, $page_count); $i++) {


                if ($page == $i) {


            ?>

                    <a href='#' class='active'><?php echo  $i; ?></a>

                <?php
                } else {


                ?>

                    <a href='#' onclick="load(<?php echo $i; ?>);"><?php echo  $i; ?></a>

                <?php
                }

                //==============================================================================================            

                ?>

            <?php

            }

            //==========================================================================================================        

            if ($page_count == $i) {


            ?>

                <a href='#' class='active'><?php echo  $page_count; ?></a>

            <?php
                // 
            } else {



            ?>

                <a href='#' onclick="load(<?php echo $page_count; ?>);">....<?php echo  $page_count; ?></a>

            <?php
            }

            //==========================================================================================================        

            //=========================================================================================================
            if ($page == $i) {

                $i = 1;

            ?>

                <!-- <a href='#' class='active'><?php
                                                // echo  $i;
                                                ?></a> -->
                <!-- <a href="#" class="active">&raquo;</a> -->

            <?php
            } else {


            ?>

                <!-- <a href='<?php // echo "?page=10"
                                ?>'><?php // echo  $i; 
                                ?></a> -->
                <a href="#" onclick="load(<?php echo $page + 1; ?>);">&raquo;</a>

        <?php
            }

            //=======================================================================================================        

        }

        ?>

        <!-- <a href="#">&raquo;</a> -->
    </div>
</div>

<?php

// echo $i;

<?php

require 'connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* ................................................pagination....................................................................... */

        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
            border-radius: 5px;
        }

        /* ...................................................pagination..................................................................... */
    </style>
</head>

<body onload="search();" style="background-color: aqua;">

    <form method="POST" action="exsx.php">

        <input type="text" name="sb" style="width: 800px; margin-top: 50px; margin-bottom: 100px;" onkeyup="search();" id="sbar" placeholder="type the city">

        <select name="sc" id="sc" onclick="search();">
            <option value="0">select country</option>

            <?php
            $c = Database::search("SELECT * FROM country ORDER BY Name ASC;");
            $n = $c->num_rows;

            for ($i = 0; $i < $n; $i++) {
                $d = $c->fetch_assoc();

            ?>
                <option value="<?php echo $d["Code"]; ?>"><?php echo $d["Name"]; ?></option>
            <?php

            }

            ?>
        </select>


        <input type="submit" name="export" class="btn btn-success" value="Export" />
    </form>

    <div id="tb">

    </div>

        <script src="script.js"></script>
</body>

</html>
<?php
$connect = mysqli_connect("localhost", "root", "Dds1234@56A$", "world", "3306");
$sql = "SELECT city.ID ,city.CName ,country.Name ,city.District ,city.Population FROM city INNER JOIN country ON city.CountryCode=country.Code ORDER BY  city.ID ASC;";
$result = mysqli_query($connect, $sql);
?>
<html>

<head>
    <title>Export MySQL data to Excel in PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <br />
        <br />
        <br />
        <div class="table-responsive">
            <h2 align="center">Export MySQL data to Excel in PHP</h2><br />
            <table class="table table-bordered">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>country</th>
                    <th>district</th>
                    <th>population</th>
                </tr>
                <?php
                while ($d = mysqli_fetch_array($result)) {
                    echo '  
       <tr>  
       <td style="text-align: center;">' . $d["ID"] . '</td>
       <td style="text-align: center;">' . $d["CName"] . '</td>
       <td style="text-align: center;">' . $d["Name"] . '</td>
       <td style="text-align: center;">' . $d["District"] . '</td>
       <td style="text-align: center;">' . $d["Population"] . '</td>
       </tr>  
        ';
                }
                ?>
            </table>
            <br />
            <form method="post" action="export.php">
                <input type="submit" name="export" class="btn btn-success" value="Export" />
            </form>
        </div>
    </div>
</body>

</html>
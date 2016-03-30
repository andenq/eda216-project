<?php
    require_once('database.inc.php');
    require_once("mysql_connect_data.inc.php");

    $db = new Database($host, $userName, $password, $database);
    $db->openConnection();
    if (!$db->isConnected()) {
        $con = false;
    } else {
        $con = true;
    }

    if ($con) {
        $list = ["2016-03-30", "2016-03-29", "2016-03-29"];
    }

?>

<html>
    <head>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div style="margin: 10px;">
        <h2>Pallet data</h2>
        <a href="http://localhost/createPallet.php" class="btn btn-default">Create pallet</a>
        <table class="table" style="width: 50%;">
            <thead>
                <tr>
                    <th>Date created</th>
                    <th>Barcode</th>
                    <th>Blocked at</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($con) {
                        foreach ($list as $l) {
                            print "<tr>";
                            print "<td>$l</td>";
                            print "<td>1234567890128</td>";
                            print "<td>2016-03-30</td>";
                            print "</tr>";
                        }
                    } else {
                        print "<tr><td></td></tr>";
                    }
                 ?>
            </tbody>
        </table>
    </div>
    </body>
</html>

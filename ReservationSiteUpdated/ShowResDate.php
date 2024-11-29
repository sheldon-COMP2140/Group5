
<!DOCTYPE html>
<html>
<head>
    <title>Reserved Datetimes</title>
</head>
<body>
    <table>
        <tr>
            <th>ResID</th>
            <th>ResDate</th>
            <th>ResTime</th>
        </tr>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "EAGLE");
            if ($conn-> connect_error) {
                die("Connection failed:". $conn->connect_error);
            }

            $sql = "SELECT ResID, ResDate, ResTime from eaglereservation";
            $result = $conn-> query($sql);

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>".$row["ResID"]."</td><td>". $row["ResDate"] ."</td><td>". $row["ResTime"] ."</td></tr>";
            }
                echo"</table>";
                
            }else{

                echo "0 results";
            }

            $conn->close();
        ?>

    </table>
</body>
</html>
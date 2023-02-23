<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="Style.css">

<head>
    <meta charset="UTF-8">
    <title>Interogarea5.b</title>
</head>
<body>
<div class="interogare">
<h1>Interogarea 5.b.</h1>
<p class="cerinta"><b>Cerinta colocviu partial:</b> Să se găsească numele navelor care au participat la bătăliile la care au
    participat nave din clasa ‘Kongo’.  </p>
<p class="rezolvare"><b>Cod SQL:</b><br>
    SELECT DISTINCT c.nava <br>
    FROM consecinte c <br>
    WHERE EXISTS (SELECT nume <br>
                  FROM nave<br>
                  WHERE nume = c.nava AND clasa = 'Kongo' AND c.batalie IS NOT NULL);</p>
<form action="rezultate5b.php" method=post class="formular">
    <table>
        <tr>
            <?php $connect = mysqli_connect('localhost', 'student', 'student123', 'nave');
            $query = "SELECT clasa FROM clase";
            $result = mysqli_query($connect, $query);
            echo "Clasa: <select name='p_clasa'";
            while($row = mysqli_fetch_array($result)){
                echo "<option value='" .$row[clasa]. "'>" .$row[clasa]. "</option>";
            }
            ?>
            </select>
        </tr>

    </table>
    <br>
    <input type=submit class ="submit-btn" value="Afiseaza">
</form>
<a href="Pagina_principala.html">Inapoi la pagina principala!</a>
</div>
</body>
</html>

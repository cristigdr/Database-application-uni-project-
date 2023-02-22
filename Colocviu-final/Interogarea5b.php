<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Interogarea5.b</title>
</head>
<body>
<h1><u>Interogarea 5.b.</u></h1>
<p><b>Cerinta colocviu partial:</b> Să se găsească numele navelor care au participat la bătăliile la care au
    participat nave din clasa ‘Kongo’.  </p>
<p><b>Cod SQL:</b><br>
    SELECT DISTINCT c.nava <br>
    FROM consecinte c <br>
    WHERE EXISTS (SELECT nume <br>
                  FROM nave<br>
                  WHERE nume = c.nava AND clasa = 'Kongo' AND c.batalie IS NOT NULL);</p>
<form action="rezultate5b.php" method=post>
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
        <tr>
            <td colspan="2" ><input type=submit value="Afiseaza"></td>
        </tr>
    </table>
</form>
<a href="Pagina_principala.html">Inapoi la pagina principala!</a>
</body>
</html>

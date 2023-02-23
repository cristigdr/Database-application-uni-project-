<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="Style.css">
<head>
    <meta charset="UTF-8">
    <title>Interogarea4.a</title>
</head>
<body>
<div class="interogare">
<h1>Interogarea 4.a.</h1>
<p class="cerinta"><b>Cerinta colocviu partial:</b> Să se afișeze numele, deplasamentul și numărul de arme pentru navele
    avariate în bătălia de la Capul Sarici. </p>
<p class="rezolvare"><b>Cod SQL:</b><br>
    SELECT n.nume, c.deplasament, c.nr_arme <br>
    FROM clase c JOIN nave n ON (c.clasa = n.clasa) JOIN consecinte co ON (n.nume = co.nava)<br>
    WHERE co.rezultat = 'avariat' AND batalie = 'Capul Sarici';</p>
<form action="rezultate4a.php" method=post class="formular">
    <table>
        <tr>
            <td>Alegeti rezultatul: <select name = 'p_rezultat'>
                    <option value=" 'nevatamat' ">nevatamat</option>
                    <option value=" 'avariat' ">avariat</option>
                    <option value=" 'scufundat' ">scufundat</option>
                </select></td>
        </tr>
        <tr>
            <?php $connect = mysqli_connect('localhost', 'student', 'student123', 'nave');
            $query = "SELECT nume FROM batalii";
            $result = mysqli_query($connect, $query);
            echo "Batalie <select name='p_nume_batalie'";
            while($row = mysqli_fetch_array($result)){
                echo "<option value='" .$row[nume]. "'>" .$row[nume]. "</option>";
            }
            ?>
            </select>
        </tr>
        <tr>
            <td colspan="2" ><input type=submit class="submit-btn" value="Afiseaza"></td>
        </tr>
    </table>
</form>
<a href="Pagina_principala.html">Inapoi la pagina principala!</a>
</div>
</body>
</html>


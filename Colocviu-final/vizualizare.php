<html lang>
<head>
    <title>Afisare Rezultate</title>
    <style>
        table, th, td
        {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<h1>Afisare Rezultate</h1>

<?php
$p_tabel=$_POST['p_tabel'];
$p_tabel=trim($p_tabel);

$user = 'student';
$pass = 'student123';
$host = 'localhost';
$db_name = 'nave';
$connect = mysqli_connect($host, $user, $pass, $db_name);

// se verifică dacă a funcţionat conectarea
if ($connect->connect_error) {
    die('Eroare la conectare: ' . $connect->connect_error);
}

// se emite interogarea
$query = "CALL `vizualizare`($p_tabel)";
$result = mysqli_query($connect, $query);

// verifică dacă rezultatul este în regulă
if (!$result) {
    die('Interogare gresita: ' . mysqli_error($connect));
}

// se obţine numărul tuplelor returnate
$num_results = mysqli_num_rows($result);

// se afişează fiecare tuplă returnată
if($p_tabel == "'clase'"){
    echo '<table style="width:100%">
        <tr>
            <th>Nr.crt.</th>
	        <th>Clasa</th>
	        <th>Tip</th>
	        <th>Tara</th>
	        <th>Numar Arme</th>
	        <th>Diametru Tun</th>
            <th>Deplasament</th>
        </tr>';
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_assoc($result);
        echo '<tr><td>' . ($i + 1) . '</td>';
        echo '<td>' . $row['clasa'] . '</td>';
        echo '<td>' . $row['tip'] . '</td>';
        echo '<td>' . $row['tara'] . '</td>';
        echo '<td>' . $row['nr_arme'] . '</td>';
        echo '<td>' . $row['diametru_tun'] . '</td>';
        echo '<td>' . $row['deplasament'] . '</td>';
        }
    echo '</table>';
}
elseif ($p_tabel == "'nave'"){
        echo '<table style="width:100%">
        <tr>
            <th>Nr.crt.</th>
	        <th>Nume</th>
	        <th>Clasa</th>
	        <th>Anul Lansarii</th>
        </tr>';
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_assoc($result);
        echo '<tr><td>' . ($i + 1) . '</td>';
        echo '<td>' . $row['nume'] . '</td>';
        echo '<td>' . $row['clasa'] . '</td>';
        echo '<td>' . $row['anul_lansarii'] . '</td>';
        }
    echo '</table>';
}
elseif ($p_tabel == "'batalii'"){
    echo '<table style="width:100%">
        <tr>
            <th>Nr.crt.</th>
	        <th>Nume</th>
	        <th>Data</th>
	        <th>Locatie</th>
        </tr>';
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_assoc($result);
        echo '<tr><td>' . ($i + 1) . '</td>';
        echo '<td>' . $row['nume'] . '</td>';
        echo '<td>' . $row['data'] . '</td>';
        echo '<td>' . $row['locatie'] . '</td>';
    }
    echo '</table>';
}
elseif($p_tabel == "'consecinte'"){
    echo '<table style="width:100%">
        <tr>
            <th>Nr.crt.</th>
	        <th>Nava</th>
	        <th>Batalie</th>
	        <th>Rezultat</th>
        </tr>';
    for ($i = 0; $i < $num_results; $i++) {
        $row = mysqli_fetch_assoc($result);
        echo '<tr><td>' . ($i + 1) . '</td>';
        echo '<td>' . $row['nava'] . '</td>';
        echo '<td>' . $row['batalie'] . '</td>';
        echo '<td>' . $row['rezultat'] . '</td>';
    }
    echo '</table>';
}


// deconectarea de la BD
mysqli_close($connect);
?>

<br>
<form action="cautare.php" method=post>
    <table>
        <tr>
            <td>Alegeti criteriul de cautare:</td>
            <td><?php
            if($p_tabel == "'clase'"){
                echo '<select name = "p_col">
                      <option value = "clasa|clase">Clasa</option>
                      <option value = "tip|clase">Tip</option>
                      <option value = "tara|clase">Tara</option>
                      <option value = "nr_arme|clase">Numar Arme</option>
                      <option value = "diametru_tun|clase">Diametru Tun</option>
                      <option value = "deplasament|clase">Deplasament</option>';
            }
            elseif ($p_tabel == "'nave'"){
                echo '<select name = "p_col">
                      <option value = "nume|nave">Nume</option>
                      <option value = "clasa|nave">Clasa</option>
                      <option value = "anul_lansarii|nave">Anul Lansarii</option>';
            }
            elseif ($p_tabel == "'batalii'"){
                echo '<select name = "p_col">
                      <option value = "nume|batalii">Nume</option>
                      <option value = "data|batalii">Data</option>
                      <option value = "locatie|batalii">Locatie</option>';
            }
                elseif ($p_tabel == "'consecinte'"){
                    echo '<select name = "p_col">
                      <option value = "nava|consecinte">Nava</option>
                      <option value = "batalie|consecinte">Batalie</option>
                      <option value = "rezultat|consecinte">Rezultat</option>';
                }

                ?></td>
        </tr>
        <tr>
            <td><input type = text name = "p_search" placeholder="Tasteaza aici..."></td>
        </tr>
        <tr>
            <td colspan="2" ><input type=submit value="Afiseaza"></td>
        </tr>
    </table>
</form>
<br>
<a href="Pagina_principala.html">Inapoi la pagina principala!</a>
</body>
</html>

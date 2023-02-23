<html lang>
<link rel="stylesheet" href="tabel.css">

<head>
    <title>Afisare Rezultate</title>
</head>
<body>
<h1>Afisare Rezultate</h1>
<?php
$p_compus=$_POST['p_col'];
$p_search=$_POST['p_search'];
$p_search=trim($p_search);

$p_explode = explode('|', $p_compus);
$p_col = trim($p_explode[0]);
$p_tabel = $p_explode[1];

if (!$p_search)
{
    echo 'Nu ati introdus criteriul de cautare. Va rog sa incercati din nou.';
    exit;
}

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
$query = "select * from $p_tabel where $p_col like '%$p_search%'";
$result = mysqli_query($connect, $query);

// verifică dacă rezultatul este în regulă
if (!$result) {
    die('Interogare gresita: ' . mysqli_error($connect));
}

// se obţine numărul tuplelor returnate
$num_results = mysqli_num_rows($result);

// se afişează fiecare tuplă returnată
if($p_tabel == "clase"){
    echo '<table class="tabel">
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
elseif ($p_tabel == "nave"){
    echo '<table class="tabel">
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
elseif ($p_tabel == "batalii"){
    echo '<table class="tabel">
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
elseif($p_tabel == "consecinte"){
    echo '<table class="tabel">
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
<a href="Pagina_principala.html">Inapoi la pagina principala!</a>
</body>
</html>


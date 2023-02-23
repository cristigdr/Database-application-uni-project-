<html lang>
<head>
    <title>Afisare Rezultate</title>
    <style>
        #tabel {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #tabel td, #tabel th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #tabel tr:nth-child(even){background-color: #f2f2f2;}
        #tabel tr:nth-child(odd){background-color: #f3f3f3;}

        #tabel tr:hover {background-color: #ddd;}

        #tabel th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #9ab0c9;
            color: white;
        }
    </style>
</head>
<body>
<div class="rezultate">
<h1>Afisare Rezultate</h1>
<?php
$tip_nava=$_POST['tip_nava'];
$tip_nava=trim($tip_nava);
$limita_inf=$_POST['limita_inf'];
$limita_inf=trim($limita_inf);
$limita_sup =$_POST['limita_sup'];
$limita_sup=trim($limita_sup);


if (!$limita_inf OR !$limita_sup)
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
$query = "CALL `3a`($tip_nava, $limita_inf, $limita_sup)";
$result = mysqli_query($connect, $query);

// verifică dacă rezultatul este în regulă
if (!$result) {
    die('Interogare gresita: ' . mysqli_error($connect));
}

// se obţine numărul tuplelor returnate
$num_results = mysqli_num_rows($result);

// se afişează fiecare tuplă returnată
echo '<table id="tabel">
  <tr>
    <th>Nr.crt.</th>
	<th>Clasa</th>
    <th>Tara</th>
    <th>Deplasament</th>
  </tr>';
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_assoc($result);
    echo '<tr><td>' . ($i + 1) . '</td>';
    echo '<td>' . $row['clasa'] . '</td>';
    echo '<td>' . $row['tara'] . '</td>';
    echo '<td>' . $row['deplasament'] . '</td>';
}
echo '</table>';

// deconectarea de la BD
mysqli_close($connect);
?>
<br>
<a href="Pagina_principala.html">Inapoi la pagina principala!</a>
</div>
</body>
</html>

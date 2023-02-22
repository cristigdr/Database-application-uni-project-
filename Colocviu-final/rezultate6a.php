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
$p_tip=$_POST['p_tip'];
$p_col_comp=$_POST['p_col'];
$p_op=$_POST['p_op'];

$result_explode=explode('|', $p_col_comp);
$p_col = $result_explode[0];
$p_unitate = $result_explode[1];

if (!$p_tip OR !$p_col OR !$p_op)
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
$query = "CALL `6a`($p_tip, $p_col, $p_op, $p_unitate)";
$result = mysqli_query($connect, $query);

// verifică dacă rezultatul este în regulă
if (!$result) {
    die('Interogare gresita: ' . mysqli_error($connect));
}

// se obţine numărul tuplelor returnate
$num_results = mysqli_num_rows($result);

// se afişează fiecare tuplă returnată
echo '<table style="width:100%">
  <tr>
    <th>Nr.crt.</th>
	<th>Tara</th>
	<th>Clasa</th>
	<th>Maxim pe clase</th>

  </tr>';
for ($i = 0; $i < $num_results; $i++) {
    $row = mysqli_fetch_assoc($result);
    echo '<tr><td>' . ($i + 1) . '</td>';
    echo '<td>' . $row['tara'] . '</td>';
    echo '<td>' . $row['clasa'] . '</td>';
    echo '<td>' . $row['max_al_claselor'] . '</td>';
}
echo '</table>';
// deconectarea de la BD
mysqli_close($connect);
?>
<br>
<a href="Pagina_principala.html">Inapoi la pagina principala!</a>
</body>
</html>


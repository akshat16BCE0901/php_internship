<<<<<<< HEAD
<?php 
session_start();
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$my_var = file_get_contents('index.php');
// $dompdf->loadHTML($my_var);
// $dompdf->setPaper('A4','portrait');
// $dompdf->render();
// $dompdf->stream('Akshat',array('Attachment'=>0));

?>

<!doctype html>
<html>
    <head></head>
    <body>
    
        <button onclick='window.print()'>Click </button>
    </body>
=======
<?php 
session_start();
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$my_var = file_get_contents('index.php');
// $dompdf->loadHTML($my_var);
// $dompdf->setPaper('A4','portrait');
// $dompdf->render();
// $dompdf->stream('Akshat',array('Attachment'=>0));

?>

<!doctype html>
<html>
    <head></head>
    <body>
    
        <button onclick='window.print()'>Click </button>
    </body>
>>>>>>> Update 2.0
</html>
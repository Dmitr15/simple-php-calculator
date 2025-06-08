<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

require_once 'src/Calculator.php';
require_once 'vendor/autoload.php';

use App\Calculator;

$calculator = new Calculator();

// Тема
if (isset($_GET['theme'])) {
    $_SESSION['theme'] = $_GET['theme'];
}
$theme = $_SESSION['theme'] ?? 'light';

// Инициализация переменных
$ans = '';
$error = '';
$num1 = $_REQUEST['num1'] ?? null;
$num2 = $_REQUEST['num2'] ?? null;

// Определение операции
$operation = null;
$buttons = ['add', 'sub', 'mul', 'div', 'mod', 'square-root', 'sin', 'cos', 'tan', 'log', 'log10', 'pow'];
foreach ($buttons as $btn) {
    if (isset($_REQUEST[$btn])) {
        $operation = $btn;
        break;
    }
}

// Валидация и вычисление
if ($operation !== null) {
    $error = $calculator->validate($num1, in_array($operation, ['square-root', 'sin', 'cos', 'tan', 'log', 'log10']) ? null : $num2);
    if (!$error) {
        try {
            $ans = $calculator->calculate($operation, $num1, $num2);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Scientific Calculator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="<?= htmlspecialchars($theme) ?>">
    <header class="navbar navbar-default" style="background-color: #337ab7; color: white; padding: 15px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#" style="color:white; font-size: 24px;">🧮 Scientific Calculator</a>
            </div>
            <div class="btn-theme">
                <a href="?theme=light" class="btn btn-default btn-sm">Light</a>
                <a href="?theme=dark" class="btn btn-default btn-sm">Dark</a>
            </div>
        </div>
    </header>

    <div class='container'>
        <div class="col-md-12">
            <div class="row shadow p-3 mb-5 bg-white rounded mydiv">
                <h1 style="color:black;"><b>
                        <center>Simple Scientific Calculator</center>
                    </b></h1>
                <form method="get" action="">
                    <center>
                        <input type="text" class='form-control' name="num1" placeholder="Enter number 1"><br>
                        <input type="text" class='form-control' name="num2" placeholder="Enter number 2"><br>
                        <?php
                        $buttons = ['add', 'sub', 'mul', 'div', 'mod', 'square-root', 'sin', 'cos', 'tan', 'log', 'log10', 'pow'];
                        foreach ($buttons as $btn) {
                            echo "<button class='btn btn-primary' type='submit' name='$btn'>" . ucfirst($btn) . "()</button> ";
                        }
                        ?>
                    </center>
                </form>
                <br>

                <div class='answer'>
                    <center>
                        <?php
                        if ($error) {
                            echo "<b style='color: red;'>Error: " . htmlspecialchars($error) . "</b>";
                        } elseif ($ans !== '') {
                            echo "<b style='color: black;'>Answer is: " . htmlspecialchars($ans) . "</b>";
                        }
                        ?>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Scientific Calculator | Theme: <?= htmlspecialchars($theme) ?></p>
    </footer>
</body>

</html>
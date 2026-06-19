<?php

$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $operation = $_POST["operation"];

    switch ($operation) {

        case "add":
            $result = $num1 + $num2;
            break;

        case "subtract":
            $result = $num1 - $num2;
            break;

        case "multiply":
            $result = $num1 * $num2;
            break;

        case "divide":
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                $result = "Cannot divide by zero!";
            }
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Calculator</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f4f4f4;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .calculator{
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 15px rgba(0,0,0,0.2);
            width:350px;
            text-align:center;
        }

        input, select{
            width:100%;
            padding:10px;
            margin:10px 0;
            font-size:16px;
        }

        button{
            width:100%;
            padding:12px;
            background:#007bff;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        button:hover{
            background:#0056b3;
        }

        .result{
            margin-top:20px;
            font-size:20px;
            font-weight:bold;
        }
    </style>

</head>

<body>

<div class="calculator">

<h2>PHP Calculator</h2>

<form method="post">

<input type="number" name="num1" placeholder="First Number" required>

<select name="operation">
    <option value="add">Addition (+)</option>
    <option value="subtract">Subtraction (-)</option>
    <option value="multiply">Multiplication (*)</option>
    <option value="divide">Division (/)</option>
</select>

<input type="number" name="num2" placeholder="Second Number" required>

<button type="submit">Calculate</button>

</form>

<div class="result">
Result: <?php echo $result; ?>
</div>

</div>

</body>
</html>
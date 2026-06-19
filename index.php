<?php
$result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num1 = $_POST['num1'] ?? "";
    $num2 = $_POST['num2'] ?? "";
    $op   = $_POST['operator'] ?? "";

    if ($num1 === "" || $num2 === "" || $op === "") {
        $result = "Please complete the calculation";
    } else {

        switch ($op) {
            case "+":
                $result = $num1 + $num2;
                break;
            case "-":
                $result = $num1 - $num2;
                break;
            case "*":
                $result = $num1 * $num2;
                break;
            case "/":
                $result = ($num2 == 0) ? "Cannot divide by zero" : $num1 / $num2;
                break;
            default:
                $result = "Invalid operation";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>

    <style>
        body {
            background: #111;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial;
        }

        .calc {
            width: 320px;
            background: #222;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
        }

        .screen {
            width: 100%;
            height: 60px;
            background: #000;
            color: #0f0;
            font-size: 24px;
            text-align: right;
            padding: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            font-size: 18px;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        button {
            padding: 15px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            background: #333;
            color: white;
        }

        button:hover {
            background: #555;
        }

        .equal {
            background: #28a745;
            grid-column: span 4;
        }

        .result {
            margin-top: 10px;
            color: #fff;
            text-align: center;
            font-size: 20px;
        }
    </style>
</head>

<body>

<div class="calc">

    <form method="POST">

        <input type="number" name="num1" placeholder="First number" required>
        <input type="number" name="num2" placeholder="Second number" required>

        <div class="buttons">
            <button type="submit" name="operator" value="+">+</button>
            <button type="submit" name="operator" value="-">-</button>
            <button type="submit" name="operator" value="*">*</button>
            <button type="submit" name="operator" value="/">/</button>

            <button type="submit" class="equal">= Calculate</button>
        </div>

    </form>

    <div class="result">
        <?php echo $result; ?>
    </div>

</div>

</body>
</html>
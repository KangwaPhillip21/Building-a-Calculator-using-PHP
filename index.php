<?php
session_start();

if (!isset($_SESSION['history'])) {
    $_SESSION['history'] = [];
}

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

        // Save to history ONLY if result is valid number
        if (is_numeric($result)) {
            $record = "$num1 $op $num2 = $result";
            array_unshift($_SESSION['history'], $record);
        }
    }
}

// Clear history
if (isset($_POST['clear'])) {
    $_SESSION['history'] = [];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calculator with History</title>

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
            width: 350px;
            background: #222;
            padding: 20px;
            border-radius: 15px;
            color: white;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            font-size: 16px;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        button {
            padding: 12px;
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
            text-align: center;
            font-size: 18px;
            color: #0f0;
        }

        .history {
            margin-top: 15px;
            background: #000;
            padding: 10px;
            border-radius: 10px;
            max-height: 200px;
            overflow-y: auto;
        }

        .history h3 {
            margin: 0 0 10px 0;
        }

        .history p {
            margin: 5px 0;
            font-size: 14px;
        }

        .clear-btn {
            width: 100%;
            margin-top: 10px;
            background: red;
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

    <div class="history">
        <h3>History</h3>

        <?php
        if (empty($_SESSION['history'])) {
            echo "<p>No calculations yet</p>";
        } else {
            foreach ($_SESSION['history'] as $item) {
                echo "<p>$item</p>";
            }
        }
        ?>

        <form method="POST">
            <button type="submit" name="clear" class="clear-btn">Clear History</button>
        </form>
    </div>

</div>

</body>
</html>
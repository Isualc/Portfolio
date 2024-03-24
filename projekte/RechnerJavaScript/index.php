<!DOCTYPE html>
<html>
<head>
    <title>Taschenrechner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="calculator">
        <input type="text" id="result" readonly>
        <button onclick="appendNumber(1)">1</button>
        <button onclick="appendNumber(2)">2</button>
        <button onclick="appendNumber(3)">3</button>
        <button onclick="appendOperator('+')" class="operator">+</button>
        <button onclick="appendNumber(4)">4</button>
        <button onclick="appendNumber(5)">5</button>
        <button onclick="appendNumber(6)">6</button>
        <button onclick="appendOperator('-')" class="operator">-</button>
        <button onclick="appendNumber(7)">7</button>
        <button onclick="appendNumber(8)">8</button>
        <button onclick="appendNumber(9)">9</button>
        <button onclick="appendOperator('*')" class="operator">*</button>
        <div class="clearbutton"><button onclick="clearExpression()">C</button></div>
        <button onclick="appendNumber(0)">0</button>
        <div class="enterbutton"><button onclick="evaluateExpression()">=</button></div>
        <button onclick="appendOperator('/')" class="operator">/</button>
    </div>
    <script src="Rechner.js"></script>
</body>
</html>

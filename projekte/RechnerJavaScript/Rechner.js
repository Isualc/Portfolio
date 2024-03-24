// Initialisierung eines leeren Ausdrucks
let expression = '';

// Funktion zur Berechnung basierend auf dem Operator und zwei Zahlen
function calculate(operator, a, b) {
    switch (operator) {
        case '+': // Additionsfall
            return a + b;
        case '-': // Subtraktionsfall
            return a - b;
        case '*': // Multiplikationsfall
            return a * b;
        case '/': // Divisionsfall
            if (b === 0) { // Überprüfung auf Division durch Null
                throw new Error("Division durch Null ist nicht erlaubt.");
            }
            return a / b;
        default: // Fall für ungültigen Operator
            throw new Error("Ungültiger Operator.");
    }
}

// Funktion zum Anhängen einer Zahl an den Ausdruck
function appendNumber(number) {
    expression += number; // Zahl zum Ausdruck hinzufügen
    document.getElementById('result').value = expression; // Aktualisierung des Anzeigewerts
}

// Funktion zum Anhängen eines Operators an den Ausdruck
function appendOperator(operator) {
    if (expression.length > 0) { // Überprüfung, dass der Ausdruck nicht leer ist
        expression += ' ' + operator + ' '; // Operator zum Ausdruck hinzufügen
        document.getElementById('result').value = expression; // Aktualisierung des Anzeigewerts
    }
}

// Funktion zur Auswertung des Ausdrucks
function evaluateExpression() {
    try {
        // Verwendung eines regulären Ausdrucks zur Trennung von Zahlen und Operatoren
        const parts = expression.split(' ');
        const a = parseFloat(parts[0]); // Umwandlung des ersten Teils in eine Zahl
        const operator = parts[1]; // Extraktion des Operators
        const b = parseFloat(parts[2]); // Umwandlung des zweiten Teils in eine Zahl
        const result = calculate(operator, a, b); // Berechnung des Ergebnisses
        document.getElementById('result').value = result.toString(); // Anzeige des Ergebnisses
        expression = result.toString(); // Aktualisierung des Ausdrucks mit dem Ergebnis
    } catch (error) {
        document.getElementById('result').value = 'Fehler'; // Anzeige eines Fehlers
        expression = ''; // Zurücksetzen des Ausdrucks bei einem Fehler
    }
}

// Funktion zum Löschen des Ausdrucks
function clearExpression() {
    expression = ''; // Zurücksetzen des Ausdrucks
    document.getElementById('result').value = ''; // Leeren des Anzeigewerts
}

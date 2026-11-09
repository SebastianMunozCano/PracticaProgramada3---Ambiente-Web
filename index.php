<?php

$estudiante = array();

function registrarTransaccion(int $id, string $descripcion, int $monto)
{
    global $estudiante;

    array_push($estudiante, array(
        "id" => $id,
        "descripcion" => $descripcion,
        "monto" => $monto
    ));
};

function generarEstadoDeCuenta()
{
    global $estudiante;

    $totalSuma = 0;
    $interes = 2.6;
    $cashback = 0.1;

    echo "<h2>Estado de Cuenta</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Descripción</th><th>Monto</th></tr>";

    foreach ($estudiante as $transaccion) {
        $totalSuma += $transaccion["monto"];

        echo "<tr>";
        echo "<td>" . $transaccion["id"] . "</td>";
        echo "<td>" . $transaccion["descripcion"] . "</td>";
        echo "<td>" . "$" . $transaccion["monto"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    $montoTotalInteres = $totalSuma * $interes / 100;
    $montoTotalCashback = $totalSuma * $cashback / 100;

    echo "<h2>Resumen</h2>";
    echo "<p>Total de transacciones: $" . $totalSuma . "</p>";
    echo "<p>Interés (" . $interes . "%): $" . $montoTotalInteres . "</p>";
    echo "<p>Cashback (" . $cashback . "%): $" . $montoTotalCashback . "</p>";
    echo "<p>Monto final a pagar: $" . ($totalSuma + $montoTotalInteres - $montoTotalCashback) . "</p>";

    $archivo = fopen("estado_cuenta.txt", "w") or die("No se pudo abrir el archivo");
    $txt = "Estado de Cuenta\n";
    $txt .= "ID\tDescripción\tMonto\n";
    foreach ($estudiante as $transaccion) {
        $linea = "ID: " . $transaccion["id"] . " | Descripción: " . $transaccion["descripcion"] . " | Monto: $" . $transaccion["monto"] . "\n";
        fwrite($archivo, $linea);
    }

    fclose($archivo);
}

registrarTransaccion(1, "Compra de libros", 150);
registrarTransaccion(2, "Pago de matrícula", 500);
registrarTransaccion(3, "Compra de materiales", 75);
registrarTransaccion(4, "Pago de transporte", 30);
registrarTransaccion(5, "Compra de alimentos", 45);
registrarTransaccion(6, "Pago de servicios", 100);
registrarTransaccion(7, "Compra de ropa", 200);
registrarTransaccion(8, "Pago de seguro", 80);
registrarTransaccion(9, "Compra de tecnología", 300);
registrarTransaccion(10, "Pago de suscripción", 20);

generarEstadoDeCuenta();





function calcularIVA(monto, tasaIVA) {
  // Verificamos si la tasa de IVA es un porcentaje (por ejemplo, 19 para 19%)
  if (tasaIVA < 0 || tasaIVA > 100) {
    return 0;
  }

  // Calculamos el IVA
  const iva = (monto * tasaIVA) / 100;

  // Devolvemos el resultado
  return iva;
}

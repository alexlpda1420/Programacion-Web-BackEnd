document.addEventListener('DOMContentLoaded', function () {
  fetch('contador_carrito.php', { cache: 'no-store' })
    .then(function (respuesta) {
      return respuesta.json();
    })
    .then(function (datos) {
      var cantidad = Number(datos.cantidad || 0);
      var contadores = document.querySelectorAll('.cart-count-js');

      contadores.forEach(function (contador) {
        if (cantidad > 0) {
          contador.textContent = '(' + cantidad + ')';
          contador.hidden = false;
        } else {
          contador.textContent = '';
          contador.hidden = true;
        }
      });
    })
    .catch(function () {
      var contadores = document.querySelectorAll('.cart-count-js');

      contadores.forEach(function (contador) {
        contador.hidden = true;
      });
    });
});

(function () {
  var whatsappNumero = '5491100000000'; // Reemplazar por el numero real de WhatsApp.
  var whatsappTexto = encodeURIComponent('Hola DeCompritas, necesito ayuda para comprar un producto.');
  var whatsappUrl = 'https://wa.me/' + whatsappNumero + '?text=' + whatsappTexto;

  var preguntas = [
    {
      pregunta: '¿Cómo compro un producto?',
      respuesta: 'Elegí una prenda del catálogo, tocá Ver detalles para revisar la información y después usá Agregar al carrito o Comprar ahora si el producto tiene link directo.',
    },
    {
      pregunta: '¿Cómo agrego productos al carrito?',
      respuesta: 'Desde la card del producto tocá Agregar al carrito. Podés seguir navegando, sumar más productos y luego entrar al carrito desde el menú superior.',
    },
    {
      pregunta: '¿Puedo modificar la cantidad?',
      respuesta: 'Sí. En el carrito podés aumentar o disminuir unidades con los botones + y -. También podés quitar un producto completo.',
    },
    {
      pregunta: '¿Qué significa Comprar ahora?',
      respuesta: 'Es una compra rápida sobre un producto puntual. Si la prenda tiene un link de compra cargado, te lleva al enlace externo configurado para ese artículo.',
    },
    {
      pregunta: '¿Cómo compro todo el carrito?',
      respuesta: 'Entrá al carrito, revisá el resumen y tocá Comprar todo. Luego completá tus datos para generar el detalle final del pedido.',
    },
    {
      pregunta: '¿Necesito una cuenta para comprar?',
      respuesta: 'No. El flujo de compra del proyecto permite preparar el pedido sin registrar una cuenta de usuario.',
    },
    {
      pregunta: '¿Cómo contacto a DeCompritas?',
      respuesta: 'Podés usar el botón de WhatsApp de este panel para enviar una consulta directa sobre productos, talles o formas de compra.',
    },
  ];

  function cerrarPanel(panel, boton) {
    panel.classList.remove('open');
    panel.setAttribute('aria-hidden', 'true');
    boton.setAttribute('aria-expanded', 'false');
  }

  function abrirPanel(panel, boton) {
    panel.classList.add('open');
    panel.setAttribute('aria-hidden', 'false');
    boton.setAttribute('aria-expanded', 'true');
  }

  document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('helpPanel')) {
      return;
    }

    var boton = document.createElement('button');
    boton.type = 'button';
    boton.className = 'help-launcher';
    boton.setAttribute('aria-controls', 'helpPanel');
    boton.setAttribute('aria-expanded', 'false');
    boton.innerHTML =
      '<span class="help-launcher-dot"></span>' +
      '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">' +
      '<path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z"></path>' +
      '</svg>' +
      '<span>Ayuda</span>';

    var panel = document.createElement('section');
    panel.id = 'helpPanel';
    panel.className = 'help-panel';
    panel.setAttribute('aria-hidden', 'true');
    panel.setAttribute('aria-label', 'Centro de ayuda de DeCompritas');
    panel.innerHTML =
      '<header class="help-panel-header">' +
      '<div class="help-panel-icon">?</div>' +
      '<div>' +
      '<strong>Centro de ayuda</strong>' +
      '<span>Preguntas frecuentes y WhatsApp</span>' +
      '</div>' +
      '<button class="help-close" type="button" aria-label="Cerrar ayuda">x</button>' +
      '</header>' +
      '<div class="help-panel-body">' +
      '<p class="help-intro">Te dejamos respuestas rápidas para comprar en DeCompritas.</p>' +
      '<div class="help-faq" id="helpFaq"></div>' +
      '<a class="help-whatsapp" href="' + whatsappUrl + '" target="_blank" rel="noopener">' +
      '<svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">' +
      '<path d="M12.04 2a9.94 9.94 0 0 0-8.5 15.1L2.1 22l5.02-1.35A9.95 9.95 0 1 0 12.04 2Zm0 18.13c-1.64 0-3.16-.48-4.45-1.31l-.32-.2-2.98.8.8-2.9-.2-.33a8.12 8.12 0 1 1 7.15 3.94Zm4.46-6.08c-.24-.12-1.43-.7-1.65-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-.24-.12-1.02-.37-1.94-1.2-.72-.64-1.2-1.43-1.34-1.67-.14-.24-.01-.37.11-.49.11-.11.24-.28.36-.42.12-.14.16-.24.24-.4.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.46-.39-.4-.54-.41h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2s.86 2.32.98 2.48c.12.16 1.69 2.58 4.1 3.62.57.25 1.02.4 1.37.51.58.18 1.1.16 1.52.1.46-.07 1.43-.58 1.63-1.15.2-.56.2-1.04.14-1.15-.06-.1-.22-.16-.46-.28Z"></path>' +
      '</svg>' +
      '<span>Consultar por WhatsApp</span>' +
      '</a>' +
      '</div>';

    document.body.appendChild(boton);
    document.body.appendChild(panel);

    var faq = panel.querySelector('#helpFaq');
    preguntas.forEach(function (item, indice) {
      var bloque = document.createElement('article');
      var respuestaId = 'helpAnswer' + indice;
      bloque.className = 'help-question';
      bloque.innerHTML =
        '<button type="button" aria-expanded="false" aria-controls="' + respuestaId + '">' +
        '<span></span>' +
        '<span class="help-chevron">›</span>' +
        '</button>' +
        '<div class="help-answer" id="' + respuestaId + '">' +
        '<p></p>' +
        '</div>';

      bloque.querySelector('button span:first-child').textContent = item.pregunta;
      bloque.querySelector('p').textContent = item.respuesta;

      bloque.querySelector('button').addEventListener('click', function () {
        var estaAbierta = bloque.classList.contains('open');
        faq.querySelectorAll('.help-question.open').forEach(function (preguntaAbierta) {
          preguntaAbierta.classList.remove('open');
          preguntaAbierta.querySelector('button').setAttribute('aria-expanded', 'false');
        });

        if (!estaAbierta) {
          bloque.classList.add('open');
          bloque.querySelector('button').setAttribute('aria-expanded', 'true');
        }
      });

      faq.appendChild(bloque);
    });

    boton.addEventListener('click', function () {
      if (panel.classList.contains('open')) {
        cerrarPanel(panel, boton);
      } else {
        abrirPanel(panel, boton);
      }
    });

    panel.querySelector('.help-close').addEventListener('click', function () {
      cerrarPanel(panel, boton);
    });

    document.addEventListener('keydown', function (evento) {
      if (evento.key === 'Escape') {
        cerrarPanel(panel, boton);
      }
    });

    document.addEventListener('click', function (evento) {
      if (!panel.classList.contains('open')) {
        return;
      }

      if (!panel.contains(evento.target) && !boton.contains(evento.target)) {
        cerrarPanel(panel, boton);
      }
    });
  });
})();

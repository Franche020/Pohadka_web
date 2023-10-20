const botonMenu = document.querySelector(".navegacion__boton");
const botonMostrar = document.querySelector(".navegacion__boton--mostrar");
const botonCerrar = document.querySelector(".navegacion__boton--cerrar");
const barraNav = document.querySelector(".navegacion__enlaces");


// Variables e inicializacion tanto de si el menu está mostrado como del viewport del dispositivo
let menuMostrado = false;
let anchoCliente = window.visualViewport.width;

document.addEventListener('DOMContentLoaded', function () {
    app();
})

// Inicializo la app


function app() {
  initEstado();
  mostrarMenu();
}

// Declaro el estado inicial para en función del tamaño del viewport mostrar o no la navbar o el boton
function initEstado() {
  if (anchoCliente < 1008) {
    barraGrande("none", "flex", "none");
  } else {
    barraGrande("flex", "none", "none");
  }
}

// Funcion para mostrar u ocultar el menú
function mostrarMenu() {
  // Evento para el pulsado del boton
  botonMenu.addEventListener("click", function () {
    if (anchoCliente < 1008) {
      if (menuMostrado === false) {
        barraGrande("flex", "none", "flex");
        menuMostrado = true;

        //console.log('Mostrando el menu')
      } else {
        barraGrande("none", "flex", "none");
        menuMostrado = false;

        //console.log('ocultando el menu')
      }
    }
  });

  // Evento para el cambio de tamaño de la pantalla, para que funcione correctamente se tiene que vincular al elemento window
  window.onresize = function () {
    //console.log(anchoCliente); 
    anchoCliente = window.visualViewport.width;
    if (anchoCliente > 1008) {
      barraGrande("flex", "none", "none");
      menuMostrado = false;

      //console.log('la barra se va a mostrar dentro de resize')
    } else {
      barraGrande("none", "flex", "none");
      menuMostrado = false;

      //console.log('la barra se va a ocultar al crecer la pantalla')
    }
  };
}

// Funcion para los estados de los elementos y reducir el código
function barraGrande(barra, bMostrar, bCerrar) {
  barraNav.style.display = barra;
  botonMostrar.style.display = bMostrar;
  botonCerrar.style.display = bCerrar;
}

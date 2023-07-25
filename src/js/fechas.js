const checkIn = document.querySelector("#checkin");
const checkOut = document.querySelector("#checkout");
const room = document.querySelectorAll(".room");
const formFecha = document.querySelector("#form-fecha");
const acommodationSubmit = document.querySelector("#acommodation-submit");
const map = document.querySelector("#mapa");
var tipo;
var roomnumber;
var checkInValue;
var checkOutValue;
var acommodationType;
var lang;

document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  // Obtencion del lenguaje
  lang = lenguaje();
  rellenarFechas();
});

function eventListeners() {
  map.addEventListener("click", function () {
    if (checkInValue === undefined && checkOutValue === undefined) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Please select dates first!",
      });
    }
  });

  checkIn.addEventListener("change", function (e) {
    checkInValue = e.target.value;
    comprobarEstado();
  });
  checkOut.addEventListener("change", function (e) {
    checkOutValue = e.target.value;
    comprobarEstado();
  });
  acommodationSubmit.addEventListener("click", function (e) {
    e.preventDefault();

    tipo = document.querySelector('input[name="tipo"]:checked');
    if (checkInValue !== undefined && checkOutValue !== undefined) {
      if (tipo !== null) {
        console.log(
          `/acommodation/confirm?checkIn=${checkInValue}&checkOut=${checkOutValue}&tipo=${tipo.value}`
        );

        //window.location.href = `/acommodation/confirm?roomNumber=${roomnumber}&checkIn=${checkInValue}&checkOut=${checkOutValue}&tipo=${tipo.value}`;
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Please select one acommodation option!",
        });
      }
    } else {
      Swal.fire({
        icon: "error",
        title: "Oops...",

        text: "Please select dates!",
      });
    }
  });
}

function eventListenersRooms() {
  room.forEach((room) => {
    room.addEventListener("click", (e) => {
      tipo = document.querySelector('input[name="tipo"][value="room"]');
      tipo.checked = true;

      // Dentro del event listener

      // Obtener el número de habitación del ID del elemento clicado
      roomnumber = e.target.id.charAt(4);

      // Llamar a la función obtenerHabitacion() y obtener los detalles de la habitación
      obtenerHabitacion(roomnumber)
        .then((datosHabitacion) => {
          // Pasar el resultado a la función mostrarRoom()
          mostrarRoom(datosHabitacion);
        })
        .catch(() => {
          console.log("ERROR EN API");
        });
    });
  });
}

async function comprobarEstado() {
  if (checkInValue !== undefined && checkOutValue !== undefined) {
    if (
      checkInValue !== undefined &&
      checkOutValue !== undefined &&
      checkInValue <= checkOutValue
    ) {
      let datosResultado = [];

      const datos = new FormData();
      datos.append("checkIn", checkInValue);
      datos.append("checkOut", checkOutValue);

      try {
        const url = "http://localhost:3000/api/rooms";
        const respuesta = await fetch(url, {
          method: "POST",
          body: datos,
        });
        const resultado = await respuesta.json();

        if (resultado["resultado"] !== null) {
          resultado["resultado"].forEach((objeto) => {
            datosResultado.push(objeto["castillo"]);
          });
          actualizarRooms(datosResultado);
        } else {
          datosResultado = [];
          actualizarRooms(datosResultado);
        }
      } catch (error) {
        console.log(error);
      }
    } else {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "The checkout date must be after the check-in date!",
      });
    }
  }
}

function actualizarRooms(datos) {
  const room1 = document.querySelector("#room1");
  const room2 = document.querySelector("#room2");
  const room3 = document.querySelector("#room3");
  const room4 = document.querySelector("#room4");

  if (datos.includes("1")) {
    room1.classList.add("reserved");
    room1.classList.remove("avaiable");
  } else {
    room1.classList.add("avaiable");
    room1.classList.remove("reserved");
  }
  if (datos.includes("2")) {
    room2.classList.add("reserved");
    room2.classList.remove("avaiable");
  } else {
    room2.classList.add("avaiable");
    room2.classList.remove("reserved");
  }
  if (datos.includes("3")) {
    room3.classList.add("reserved");
    room3.classList.remove("avaiable");
  } else {
    room3.classList.add("avaiable");
    room3.classList.remove("reserved");
  }
  if (datos.includes("4")) {
    room4.classList.add("reserved");
    room4.classList.remove("avaiable");
  } else {
    room4.classList.add("avaiable");
    room4.classList.remove("reserved");
  }

  eventListenersRooms();
}

function mostrarRoom(datosHabitacion) {
  //console.log(datosHabitacion);

  // Carpeta imagenes
  carpetaImg = "../imagenes/rooms/";

  // Aqui agrego todos los elementos referentes al body
  const body = document.querySelector("body");
  const overlay = document.createElement("DIV");
  overlay.classList.add("overlay");
  body.classList.add("no-scroll");
  body.appendChild(overlay);

  // Tarjeta
  const card = document.createElement("DIV");
  card.classList.add("card", "center");
  overlay.appendChild(card);

  // Cierre modal
  const cerrarModal = document.createElement("DIV");
  cerrarModal.classList.add("cerrar");
  card.appendChild(cerrarModal);
  cerrarModal.onclick = () => {
    overlay.remove();
    body.classList.remove("no-scroll");
    tipo = document.querySelector('input[name="tipo"][value="room"]');
    tipo.checked = false;
  };

  cerrarModal.innerHTML = `
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
    <line x1="18" y1="6" x2="6" y2="18" />
    <line x1="6" y1="6" x2="18" y2="18" />
    </svg>`;

  //Elementos
  const nombre = document.createElement("H3");
  const descripcion = document.createElement("DIV");

  const capacidad = document.createElement("P");
  capacidad.classList.add("pax");

  const precio = document.createElement("P");
  precio.classList.add("price");

  nombre.innerText = datosHabitacion.nombre;

  if (lang.toLowerCase === "cs") {
    descripcion.innerHTML = datosHabitacion.descripcionCheco;
  } else {
    descripcion.innerHTML = datosHabitacion.descripcionIngles;
  }
  capacidad.innerHTML = "<span>Pax: </span>" + datosHabitacion.capacidad;
  precio.innerHTML = datosHabitacion.precio + " <span>Kc</span>";

  card.appendChild(nombre);
  card.appendChild(descripcion);
  card.appendChild(capacidad);
  card.appendChild(precio);

  let objetoHabitacion = datosHabitacion.fotosHabitacion[0] || 0;

  const divImagen = document.createElement("DIV");
  divImagen.classList.add("div-imagen");

  // Imagen
  if (typeof objetoHabitacion === "object") {
    let index = 0;
    imagenHabitacion(divImagen, datosHabitacion.fotosHabitacion, index);
    card.appendChild(divImagen);
  } else {
    const noFoto = document.createElement("H2");
    noFoto.innerText = "NO FOTO";
    noFoto.classList.add("no-foto");
    card.appendChild(noFoto);
  }

  // Boton submit
  const submit = document.createElement("BUTTON");
  submit.textContent = "Select Room";
  submit.classList.add("boton", "boton-submit");
  card.appendChild(submit);

  submit.addEventListener("click", (e) => {
    window.location.href = `/acommodation/confirm?roomNumber=${roomnumber}&checkIn=${checkInValue}&checkOut=${checkOutValue}&tipo=room`;
  });

  //nombre, descripcionIngles, descripcionCheco, capacidad, precio, castillo
}

async function obtenerHabitacion(id) {
  const datos = new FormData();
  datos.append("id", id);

  try {
    const url = "http://localhost:3000/api/room";
    const respuesta = await fetch(url, {
      method: "POST",
      body: datos,
    });
    const resultado = await respuesta.json();
    return resultado["habitacion"];
  } catch (error) {
    console.log(error);
    resultado = [];
    return resultado;
  }
}

function lenguaje() {
  var lenguaje = navigator.language || navigator.userLanguage;
  return lenguaje;
}

function detectarDeslizamiento(elemento) {
  return new Promise((resolve) => {
    let inicioX = 0;
    let finX = 0;

    elemento.addEventListener(
      "touchstart",
      (event) => {
        inicioX = event.touches[0].clientX;
      },
      { passive: true }
    );

    elemento.addEventListener(
      "touchend",
      (event) => {
        finX = event.changedTouches[0].clientX;
        const desplazamientoX = finX - inicioX;

        if (desplazamientoX > 0) {
          // Deslizamiento hacia la derecha
          resolve("derecha");
        } else if (desplazamientoX < 0) {
          // Deslizamiento hacia la izquierda
          resolve("izquierda");
        } else {
          // Sin deslizamiento horizontal
          resolve("sin deslizamiento");
        }
      },
      { passive: true }
    );
  });
}

function imagenHabitacion(divImagen, fotosHabitacion, index) {
  // TODO mantener div imagen pero cambiar solo la img
  var i = index;
  // determinar longitud array
  const arrayLenght = Object.keys(fotosHabitacion).length - 1;

  const imagen = document.createElement("IMG");

  imagen.src = carpetaImg + fotosHabitacion[i].url;
  if (lang.toLowerCase === "cs") {
    imagen.alt = fotosHabitacion[i].altCheco;
  } else {
    imagen.alt = fotosHabitacion[i].altIngles;
  }

  divImagen.appendChild(imagen);

  const siguienteFoto = document.createElement("DIV");
  const anteriorFoto = document.createElement("DIV");

  siguienteFoto.innerHTML = `
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
      <path d="M5 12l14 0" />
      <path d="M13 18l6 -6" />
      <path d="M13 6l6 6" />
      </svg>`;

  anteriorFoto.innerHTML = `
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
      <path d="M5 12l14 0" />
      <path d="M5 12l6 6" />
      <path d="M5 12l6 -6" />
      </svg>`;

  siguienteFoto.classList.add("siguiente-foto");
  anteriorFoto.classList.add("anterior-foto");
  divImagen.appendChild(siguienteFoto);
  divImagen.appendChild(anteriorFoto);

  siguienteFoto.addEventListener("click", () => {
    //console.log("siguiente");
    let newIndex;
    newIndex = fotoSiguiente(i, arrayLenght);
    // volver a llamar la funcion imagenHabitacion
    imagenHabitacion(divImagen, fotosHabitacion, newIndex);
    // Eliminacion de la imagen anterior
    imagen.remove();
  });

  anteriorFoto.addEventListener("click", () => {
    //console.log("siguiente");
    let newIndex;
    newIndex = fotoAnterior(i, arrayLenght);
    // volver a llamar la funcion imagenHabitacion
    imagenHabitacion(divImagen, fotosHabitacion, newIndex);
    // Eliminacion de la imagen anterior
    imagen.remove();
  });

  detectarDeslizamiento(divImagen)
    .then((direccion) => {
      let newIndex;

      if (direccion === "izquierda") {
        newIndex = fotoSiguiente(i, arrayLenght);
      } else if (direccion === "derecha") {
        newIndex = fotoAnterior(i, arrayLenght);
      } else {
        return;
      }
      // volver a llamar la funcion imagenHabitacion
      imagenHabitacion(divImagen, fotosHabitacion, newIndex);
      imagen.remove();
    })
    .catch();
}

function fotoSiguiente(index, arrayLenght) {
  // determinar index actual
  let newIndex = index;
  if (index < arrayLenght) {
    newIndex++;
  } else {
    newIndex = 0;
  }
  return newIndex;
}

function fotoAnterior(index, arrayLenght) {
  // determinar index actual
  let newIndex = index;
  if (index === 0) {
    newIndex = arrayLenght;
  } else {
    newIndex--;
  }
  return newIndex;
}

function rellenarFechas() {
  if (checkIn.value !== "") {
    checkInValue = checkIn.value;
  }
  if (checkOut.value !== "") {
    checkOutValue = checkOut.value;
  }

  if (checkInValue === undefined) {
    checkIn.value = "";
  }
  if (checkOutValue === undefined) {
    checkOut.value = "";
  }
}

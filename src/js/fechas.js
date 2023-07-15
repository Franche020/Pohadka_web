const checkIn = document.querySelector('#checkin');
const checkOut = document.querySelector('#checkout');
const room = document.querySelectorAll('.room');
const formFecha = document.querySelector('#form-fecha');
var checkInValue;
var checkOutValue;

document.addEventListener("DOMContentLoaded", function () {
    eventListeners();
  });

function eventListeners() {
    checkIn.addEventListener('change' , function(e) {
        checkInValue = e.target.value;
        comprobarEstado();
    })
    checkOut.addEventListener('change' , function(e) {
        checkOutValue = e.target.value;
        comprobarEstado();
    })
}
function eventListenersRooms() {
        room.forEach(e => {
        e.addEventListener('click', e=> {
            mostrarRoom(e.target.id);
        })
    })  
}

async function comprobarEstado() {

    if(checkInValue !== undefined && checkOutValue !== undefined && checkInValue<=checkOutValue) {
        let datosResultado = [];
        
        const datos = new FormData();
        datos.append('checkIn', checkInValue);
        datos.append('checkOut', checkOutValue);

        try {
            const url = 'http://localhost:3000/api/rooms'
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if (resultado['resultado']!== null) {
                console.log(resultado);
                    //console.log(resultado['resultado']['castillo']);
                    resultado['resultado'].forEach(objeto => {
                        datosResultado.push(objeto['castillo']);
                    });
                    actualizarRooms(datosResultado);
                } else {
                    datosResultado = [];
                    actualizarRooms(datosResultado);
                }
            

        } catch (error) {
            console.log(error)
        }


    } else {
        //alert('Wrong Dates');
    }
}

function actualizarRooms(datos) {
    //console.log(datos);

    const room1 = document.querySelector('#room1');
    const room2 = document.querySelector('#room2');
    const room3 = document.querySelector('#room3');
    const room4 = document.querySelector('#room4');

    if(datos.includes('1')) {
        room1.classList.add('reserved');
        room1.classList.remove('avaiable');
    } else {
        room1.classList.add('avaiable');
        room1.classList.remove('reserved');
    }
    if (datos.includes('2')) {
        room2.classList.add('reserved');
        room2.classList.remove('avaiable');
    } else {
        room2.classList.add('avaiable');
        room2.classList.remove('reserved');
    }
    if (datos.includes('3')) {
        room3.classList.add('reserved');
        room3.classList.remove('avaiable');
    } else {
        room3.classList.add('avaiable');
        room3.classList.remove('reserved');
    }
    if (datos.includes('4')) {
        room4.classList.add('reserved');
        room4.classList.remove('avaiable');
    } else{
        room4.classList.add('avaiable');
        room4.classList.remove('reserved');
    }

    eventListenersRooms();
}

function mostrarRoom (roomN) {
    const roomnumber = roomN.charAt(4);
    obtenerHabitacion(roomnumber);

    //TODO Fethc API

    const overlay = document.createElement('DIV');
    const body = document.querySelector('#body');
    overlay.classList.add('Overlay');
    // const host = window.location.host;
    // const src = `https://${host}/room?id=${roomnumber}`

    // iframe.src = src

    // // Aplicar estilos CSS al iframe
    // iframe.style.position = "fixed";
    // iframe.style.top = "0";
    // iframe.style.left = "0";
    // iframe.style.width = "100%";
    // iframe.style.height = "100%";
    // iframe.style.border = "none";
    // iframe.style.zIndex = "9999";

  
    // // Agregar el iframe al documento
    // main.appendChild(iframe);
     
    // TODO Crear API el iframe no funciona
    // TODO comprobar las clases para no actuar el evento   s
    // TODO Mostrar pagina como overlay
}

async function obtenerHabitacion (id) {
    let habitacion = [];
        
    const datos = new FormData();
    datos.append('id', id);

    try {
        const url = 'http://localhost:3000/api/room'
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
        const resultado = await respuesta.json();

        console.log(resultado['habitacion']['id']);
        console.log(resultado['habitacion']['nombre']);
        console.log(resultado['habitacion']['descripcionIngles']);
        console.log(resultado['habitacion']['descripcionCheco']);
        console.log(resultado['habitacion']['capacidad']);
        console.log(resultado['habitacion']['castillo']);
        console.log(resultado['habitacion']['precio']);
        console.log(resultado['habitacion']['tipo']);

    } catch (error) {
        console.log(error)
    }
}
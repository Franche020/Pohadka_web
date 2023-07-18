//  const imagen

// Galeria
document.addEventListener('DOMContentLoaded', function () {
    iniciarGaleria();
})


function iniciarGaleria () {

      
  
      imagen.onclick = function () {
        ampliarImagen(i,numeroImagenes);
      };
  
      galeria.appendChild(imagen);
    }
  
  
    
  function ampliarImagen(id,numeroImagenes) {
    //Imagen
    const imagen = document.createElement("picture");
    const overlay = document.createElement("DIV");
    const body = document.querySelector("body");
    const botones = document.createElement("DIV")
    const cerrarModal = document.createElement("SVG");
    const siguienteModal   = document.createElement("SVG");
    const anteriorModal = document.createElement("SVG");
    mostrarImagen(id);
  
  
    function mostrarImagen (i) {
      id = i;
      console.log(i);
      
      imagen.innerHTML = `
            <picture>
            <source srcset="build/img/gallery/picture${i}.webp" type="image/webp">                
            <img src="build/img/gallery/picture${i}.jpg" alt="Image of Pohadka">
            </picture>`;
      // Overlay con la imagen
      
      overlay.classList.add("overlay");
      overlay.appendChild(imagen);
      // body para asignar el overlay
      
      body.appendChild(overlay);
      body.classList.add("fijar-body");
      // Botón para cerrar ventana modal y los botones siguiente y anterior
      
      cerrarModal.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
            </svg>`;
      
      siguienteModal.innerHTML =`
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-right" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 12l14 0" />
            <path d="M13 18l6 -6" />
            <path d="M13 6l6 6" />
            </svg>`;
      
      anteriorModal.innerHTML =`
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M5 12l14 0" />
            <path d="M5 12l6 6" />
            <path d="M5 12l6 -6" />
            </svg>`;
    
      botones.classList.add("botones");
      overlay.appendChild(botones);
      anteriorModal.classList.add("anterior","boton--gallery");
      botones.appendChild(anteriorModal);
      cerrarModal.classList.add("cerrar","boton--gallery");
      botones.appendChild(cerrarModal);
      siguienteModal.classList.add("sigiente","boton--gallery");
      botones.appendChild(siguienteModal);
      // Detectar click en botón
  
    }
  
    cerrarModal.onclick = function () {
      ocultarImagen();
    };
  
    // Detectar click en imagen
    imagen.onclick = function () {
      ocultarImagen();
    };
  
    // Detectar click en Overlay //! DESACTIAVAD POR INCOMPATIBILIDAD CON CAMBIO IMAGEN
    /*overlay.onclick = function () {
      ocultarImagen();
    };*/
  
    // anterior y sigiente
    anteriorModal.onclick = function () {
      cambiarImagen(true);
    };
    siguienteModal.onclick = function () {
      cambiarImagen(false);
    };
  
  
    // eliminación de elementos creados
    function ocultarImagen() {
      overlay.remove();
      body.classList.remove("fijar-body");
    } 
    
    function cambiarImagen(anterior) {
      
    if(anterior === true){
      ocultarImagen();
      id--;
      if (id<1){
        id = numeroImagenes;
      }
      console.log(id);
      mostrarImagen(id);
    } else {
      ocultarImagen();
      id++;
      if (id > numeroImagenes){
        id = 1;
      }
      console.log(id);
      mostrarImagen(id);
    }
    }
  }
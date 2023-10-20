const confirmationBack = document.querySelector('.retroceder--confirmar');
const urlParams = new URLSearchParams(window.location.search);

document.addEventListener('DOMContentLoaded', ()=> {
    eventListeners();
})

function eventListeners() {
    confirmationBack.addEventListener('click', (e)=>{
        e.preventDefault();
        const checkIn = urlParams.get('checkIn');
        const checkOut = urlParams.get('checkOut');


        window.location.href = `/acommodation?checkIn=${checkIn}&checkOut=${checkOut}`;
    })
}   
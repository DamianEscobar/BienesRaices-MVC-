document.addEventListener('DOMContentLoaded', function(){

    eventListener();

    darkMode();
});

function eventListener() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navMobile);

    // Mostrar campos condicionalmente (telefono/email)
    const metodoContacto = document.querySelectorAll('input[name="contacto"]');

    metodoContacto.forEach(input => input.addEventListener('click',formaContacto));


}

function navMobile() {
    const navegacion = document.querySelector('.navegacion');

    // Esta linea de codigo hace los mismo que el if de abajo
    navegacion.classList.toggle('mostrar');

    /*if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    }*/
}

function darkMode() {
    const prefiereDark = window.matchMedia('(prefers-color-scheme: dark)');
    //console.log(prefiereDark.matches)

    if (prefiereDark.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    prefiereDark.addEventListener('change', () => {
        if (prefiereDark.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    })

    const bntDark = document.querySelector('.btn-dark');
    bntDark.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    })
}

function formaContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `     
            <input
                id="telefono"
                type="tel"
                name="telefono"
                placeholder="Tu Telefono"
                required
            >

            <p>Elija la fecha y la hora para contactarlo</p>

            <label for="fecha">Fecha:</label>
            <input id="fecha" type="date" name="fecha" required>

            <label for="hora">Hora:</label>
            <input 
                id="hora" 
                type="time" 
                name="hora"
                min="09:00" 
                max="18:00"
                placeholder="Tu Precio o Presupuesto"
                required 
            >
        `;
    } else {
        contactoDiv.innerHTML = `
            <input
                id="email"
                type="email"
                name="email"
                placeholder="Tu E-mail"
                required
            >
        `;
    }
}
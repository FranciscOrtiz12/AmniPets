let paso = 1;
let pasoInicial = 1;
let pasoFinal = 3;
const perfil = {
    rut: '',
};

const solicitud = {
    rutCl:  '',
    idMas: '',
    fecha: '',
    comentario: ''

};


document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
})

function iniciarApp(){
    mostrarSeccion();
    tabs(); //Cambia la seccion cuando se presionen los tabs
    botonesPaginador();
    paginaAnterior();
    paginaSiguiente();
    botonSolicitarControl();

    rutCliente();

    consultarMascotasAPI(); //Consulta la API en el backend de PHP
    consultarControlesAPI(); //Consulta la API en el backend de PHP

};

function mostrarSeccion(){
    // Ocultar la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if( seccionAnterior ){
        seccionAnterior.classList.remove('mostrar');
    }
    
    // Seleccionar la seccion con el paso
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // Quita la clase de actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if( tabAnterior ){
        tabAnterior.classList.remove('actual');
    }

    // Resalta el tab actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
    

};

function tabs(){
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach( boton => {
        boton.addEventListener('click', (e) => {
            paso = parseInt( e.target.dataset.paso );
            mostrarSeccion();
            botonesPaginador();   
        })
    } )
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if( paso === 1 ){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    } else if( paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
    }else if( paso === 2 ){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () => {
        if( paso <= pasoInicial ) return;
        paso --;

        botonesPaginador();
    })
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () => {
        if( paso >= pasoFinal ) return;
        paso ++;
        
        botonesPaginador();
    })
}

async function consultarMascotasAPI(){

    const { rut } = perfil;
    try{
        const url = `http://localhost:3000/api/obtenermas?rut=${rut}`;
        const resultado = await fetch(url);    
        const mascotas = await resultado.json();
        
        mostrarMascotas( mascotas );

        /* mostrarMascotas(mascotas); */
    } catch( error ){
        console.log(error);
    }

}

async function consultarControlesAPI(){
    const { rut } = perfil;

    try{
        const url = `http://localhost:3000/api/obtenercon?rut=${rut}`;
        const resultado = await fetch(url);
        const controles = await resultado.json();

        mostrarControles( controles );

    }catch( error ){
        console.log( error );
    }
}

function mostrarMascotas( mascotas ){
    //Iterar y mostrar las mascotas del cliente
    mascotas.forEach( mascota => {
        const { tipo_mas, sexo_mas, nombre_mas, edad_mas } = mascota;

        const nombreMascota = document.createElement('P');
        nombreMascota.classList.add('nombre-mascota');
        nombreMascota.textContent = 'Nombre: ' + nombre_mas;

        const tipoMascota = document.createElement('P');
        tipoMascota.classList.add('tipo-mascota');
        tipoMascota.textContent = 'Tipo: ' + tipo_mas;
        
        const sexoMascota = document.createElement('P');
        sexoMascota.classList.add('sexo-mascota');
        sexoMascota.textContent = 'Sexo: ' + sexo_mas;

        const edadMascota = document.createElement('P');
        edadMascota.classList.add('edad-mascota');
        edadMascota.textContent = 'Edad: ' + edad_mas;

        const datosDiv = document.createElement('DIV');
        datosDiv.classList.add('datos');

        datosDiv.appendChild(nombreMascota);
        datosDiv.appendChild(tipoMascota);
        datosDiv.appendChild(sexoMascota);
        datosDiv.appendChild(edadMascota);

        const imagen = document.createElement('IMG');
        imagen.src = "/build/img/mascota-virtual.png";

        const imagenDiv = document.createElement('DIV');
        imagenDiv.classList.add('credencial');

        imagenDiv.appendChild(imagen);

        const mascotaDiv = document.createElement('DIV');
        mascotaDiv.classList.add('mascota');


        mascotaDiv.appendChild(datosDiv);
        mascotaDiv.appendChild(imagenDiv);
        
        document.querySelector('#mascotas').appendChild(mascotaDiv);
    
    });
}

function mostrarControles( controles ){
    //Iterar y mostrar los controles del cliente
    controles.forEach( control => {
        const { veterinario, mascota, servicio, fecha, total } = control;

        const nombreVeterinario = document.createElement('P');
        nombreVeterinario.classList.add('nombre-veterinario');
        nombreVeterinario.textContent = 'Veterinario: ' + veterinario;

        const nombreMascota = document.createElement('P');
        nombreMascota.classList.add('nombre-mascota');
        nombreMascota.textContent = 'Mascota: ' + mascota;
        
        const tipoServicio = document.createElement('P');
        tipoServicio.classList.add('tipo-servicio');
        tipoServicio.textContent = 'Servicio: ' + servicio;

        const fechaServicio = document.createElement('P');
        fechaServicio.classList.add('fecha-servicio');
        fechaServicio.textContent = "Fecha: " + fecha;

        const totalServicio = document.createElement('P');
        totalServicio.classList.add('total-servicio');
        totalServicio.textContent = "Valor: $" + total;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('control');

        servicioDiv.appendChild(nombreVeterinario);
        servicioDiv.appendChild(nombreMascota);
        servicioDiv.appendChild(tipoServicio);
        servicioDiv.appendChild(fechaServicio);
        servicioDiv.appendChild(totalServicio);
        
        document.querySelector('#controles').appendChild(servicioDiv);

    });
    
}

function rutCliente(){
    perfil.rut = document.querySelector('#rut').value;
}

function botonSolicitarControl(){
    const botonSolicitar = document.createElement('BUTTON');
    botonSolicitar.classList.add('boton-rosa');
    botonSolicitar.classList.add('derecha');
    botonSolicitar.textContent = "Solicitar Control";
    const formularioDiv = document.querySelector('#solicitarControl');
    formularioDiv.appendChild(botonSolicitar);
};

function sincronizarParar(){
    const rut = document.querySelector('#rut').value;
    const mascota = document.querySelector('#mascota').value;
    const fecha = document.querySelector('#fecha').value;
    const comentario = document.querySelector('#comentario').value;

    if( fecha === '' || mascota === ''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Asegurese de Elegir Mascota y Fecha Para la Solicitud',
            button: 'OK'
        })
        return false;    
    }else{
        solicitud.rutCl = rut;
        solicitud.idMas = mascota;
        solicitud.fecha = fecha;
        solicitud.comentario = comentario

        solicitarControl();
        
    }
    return false;
};

async function solicitarControl(){
    const { rutCl, idMas, fecha, comentario } = solicitud;
    const datos =  new FormData();

    datos.append('rutCl', rutCl);
    datos.append('idMas', idMas);
    datos.append('fecha', fecha);
    datos.append('comentario', comentario);

    try {
        const url = 'http://localhost:3000/api/solicitarControl';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: datos
        });
        const resultado = respuesta.json();
        if( resultado ){
            Swal.fire({
                icon: 'success',
                title: 'Solicitud Enviada',
                text: 'Tu solicitud fue enviada correctamente, nos pondremos en contacto a la brevedad',
                button: 'OK'
            }).then( () => {
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            })
        }

    } catch ( error ){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al registrar tu Solicitud',
            button: 'OK'
          })
    }
}
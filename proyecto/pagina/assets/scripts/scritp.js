
const $d = document,
    $buscador = $d.querySelector("#buscador"),
    $categorias = $d.querySelectorAll(".categorias"),
    $localizaciones = $d.querySelectorAll(".localizacion"),
    $secionAnuncios = $d.querySelector(".section-anuncios"),
    $btnAdd = $d.querySelector(".publicar-anuncio")
    
const categorias = [
    { id: 1, nombre: "Venta" },
    { id: 2, nombre: "Anuncio" },
    { id: 3, nombre: "Aviso" },
    { id: 4, nombre: "Evento" },
    { id: 6, nombre: "Otros" }

]
const localizaciones = [
    { id: 1, nombre: "Madrid" },
    { id: 2, nombre: "Barcelona" },
    { id: 3, nombre: "Valencia" },
    { id: 4, nombre: "Sevilla" },
    { id: 5, nombre: "Bilbao" },
    { id: 6, nombre: "Malaga" },
    { id: 7, nombre: "Alicante" },
    { id: 8, nombre: "Granada" },
    { id: 9, nombre: "Murcia" },
    { id: 10, nombre: "Zaragoza" }
]
const anuncios=[
    anuncio={
        id: 1,
        titulo: "Anuncio 1",
        derscripcion: "Descripcion del anuncio 1",
        texto: "Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1",
        img : "./assets/img/logo.png"
    },
    anuncio={
        id: 1,
        titulo: "Anuncio 2",
        derscripcion: "Descripcion del anuncio 1",
        texto: "Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1",
        img : "./assets/img/logo.png"
    },
    anuncio={
        id: 1,
        titulo: "Anuncio 3",
        derscripcion: "Descripcion del anuncio 1",
        texto: "Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1 Texto del anuncio 1",
        img : "./assets/img/logo.png"
    }
]

function renderCategorias(categorias) {
    $categorias.forEach(categoria => {
        categoria.innerHTML = '<option value="">Seleccionar Categoria</option>'
        categoria.innerHTML += categorias.map(categoria => `<option value="${categoria.id}">${categoria.nombre}</option>`).join("")
    })
}
function renderLocalizaciones(localizaciones) {
    $localizaciones.forEach(localizacion => {
        localizacion.innerHTML = '<option value="">Seleccionar Localizacion</option>'
        localizacion.innerHTML += localizaciones.map(localizacion => `<option value="${localizacion.id}">${localizacion.nombre}</option>`).join("")
    })
}


function renderAnuncios(anuncios){
    renderCategorias(categorias)
    renderLocalizaciones(localizaciones)
    $secionAnuncios.innerHTML= anuncios.map(anuncio => `<article class="anuncio" id="${anuncio.id}">
                <h3 class="anuncio-titulo">${anuncio.titulo}</h3>
                <img class="anuncio-img" src="${anuncio.img}" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: ${anuncio.derscripcion}</p>
                <button class="anuncio-bnt">Ver mas...</button>
            </article>`
        ).join("")
    }


$d.addEventListener("DOMContentLoaded", ev => {
    console.log("DOM Cargado")
    renderAnuncios(anuncios)
})

const $d = document,
    $buscador = $d.querySelector("#buscador"),
    $categorias = $d.querySelectorAll(".categorias"),
    $localizaciones = $d.querySelectorAll(".localizacion"),
    $secionAnuncios = $d.querySelector(".section-anuncios"),
    $btnAdd = $d.querySelector(".publicar-anuncio")



function renderAnuncios(anuncios){
    
    renderCategorias(categorias)
    renderLocalizaciones(localizaciones)
    $secionAnuncios.innerHTML= anuncios.map(anuncio => 
        `<article class="anuncio" id="${anuncio.id}">
                <h3 class="anuncio-titulo">${anuncio.titulo}</h3>
                <img class="anuncio-img" src="${anuncio.imagen_url}" alt="Imagen del anuncio">
                <p class="anuncio-texto">Descripcion: ${anuncio.descripcion}</p>
                <button class="anuncio-bnt">Ver mas...</button>
            </article>`
        ).join("")
    }


$d.addEventListener("DOMContentLoaded", ev => {
    renderAnuncios(anuncios)
})
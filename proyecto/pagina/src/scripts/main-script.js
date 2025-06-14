
const $d = document,
    $formBusqueda= $d.querySelector(".formBusqueda"),
    $buscador = $d.querySelector("#buscador"),
    $categorias = $d.querySelector(".categorias"),
    $localidades = $d.querySelector(".localizacion"),
    $secionAnuncios = $d.querySelector(".section-anuncios"),
    $btnAdd = $d.querySelector(".publicar-anuncio"),
    $modal = $d.querySelector("#modal")

    const url = baseUrl + "?controller=MainController&action=getAnuncios"
    const anuncios = []

      function getAnunciosAxios() {
        axios.get(url)
        .then((response) => {
            anuncios.splice(0, anuncios.length, ...response.data);
            renderAnuncios(anuncios);
        }).catch(error => fError({
            status: error.response.status,
            statusText: error.response.statusText || "Error al recuperar anuncios"
        }));
    }
   
function renderAnuncios(anuncios){
    if (anuncios.length === 0) {
        $secionAnuncios.innerHTML = 
            `<article class="anuncio">
                    <h3 class="anuncio-titulo">No existen anuncios...</h3>
                </article>`
    }else{
        $secionAnuncios.innerHTML= anuncios.map(anuncio => 
            `<article class="anuncio">
                    <h3 class="anuncio-titulo">${anuncio.titulo}</h3>
                    <figure>
                        <img class="anuncio-img" src="${anuncio.imagen_url}" alt="${anuncio.titulo}">
                    </figure>
                    <p class="anuncio-texto">${anuncio.descripcion}</p>
                    <ul class="anuncio-info">
                        <li>
                            <p><span class="bold">${categorias.find(c => c.id == anuncio.id_categoria).nombre_categoria}</span></p>
                        </li>
                         <li>
                            <p><span class="bold">${localidades.find(l => l.id == anuncio.id_localidad).nombre_localidad}</span></p>
                         </li>
                    </ul>
                    <ul class="anuncio-btn">
                        <li>
                             <button class="btn-modal verMas" data-id=${anuncio.id} onclick="window.modal.showModal()"><i class="fa fa-eye" data-id=${anuncio.id} ></i></button>
                        </li>
                        <li>
                            <a href="?controller=AnuncioController&action=anuncioPage&id=${anuncio.id}"><i class="fas fa-arrow-right"></i></a>
                        </li>
                    </ul>
                </article>`
            ).join("")
        }
    }
    
function renderModal(id) {
    anuncio = anuncios.find(anuncio => anuncio.id == id);
    $modal.innerHTML = `
        <article class="elemento-modal">
        <h3 class="anuncio-titulo">${anuncio.titulo}</h3>
            <div class="anuncio-content">
                <div class="anuncio-texto">
                    <p class="descripcion"><span class="bold">Descripcion:</span> ${anuncio.descripcion}</p>
                    <p class="contenido"><span class="bold">Contenido: </span> ${anuncio.contenido}</p>
                    <ul class="anuncio-info">
                        <li>
                            <p>Categoria: <span class="bold">${categorias.find(c => c.id == anuncio.id_categoria).nombre_categoria}</span></p>
                        </li>
                         <li>
                            <p>Localidad: <span class="bold">${localidades.find(l => l.id == anuncio.id_localidad).nombre_localidad}</span></p>
                         </li>
                    </ul>
                </div>
                <figure>
                    <img class="anuncio-img" src="${anuncio.imagen_url}" alt="${anuncio.titulo}">
                </figure>
            </div>
            <ul class="anuncio-links">
                <li>
                    <a href="?controller=AnuncioController&action=anuncioPage&id=${anuncio.id}"><i class="fas fa-arrow-right"></i> Ir al Anuncio</a>
                    </li>
                </ul>
            <a class="modalCerrar" onclick="window.modal.close();"><i class="fas fa-window-close"></i></a>
        </article>`
}

function filterAnuncios(anuncios) {
    let anunciosfiltrados = [...anuncios]; 
    const buscador = $buscador.value.toLowerCase();
    const categoria= $categorias?.value;
    const localidad = $localidades?.value;

    if (categoria != 0) {
        anunciosfiltrados = anuncios.filter(anuncio => anuncio.id_categoria == categoria);
    }
    if (localidad != 0) {
        anunciosfiltrados = anunciosfiltrados.filter(anuncio => anuncio.id_localidad == localidad);
    }
    if (buscador) {
        anunciosfiltrados = anunciosfiltrados.filter(anuncio => 
            anuncio.titulo.toLowerCase().includes(buscador)
        );
    }   

    return anunciosfiltrados;
}

$d.addEventListener("DOMContentLoaded", ev => {
    getAnunciosAxios() 
})

$secionAnuncios.addEventListener("click", ev => {   
    if (ev.target.dataset.id) {
        const id = ev.target.dataset.id;
        renderModal(id);
        $modal.showModal();
    }
}) 

$formBusqueda.addEventListener("submit", ev => {  
    ev.preventDefault();  
    renderAnuncios(filterAnuncios(anuncios))
})


const  $buscador = document.querySelector("#buscador"),
    $categorias = document.querySelectorAll(".categorias"),
    $localizaciones = document.querySelectorAll(".localizacion"),
    $secionAnuncios = document.querySelector(".section-anuncios"),
    $btnAdd = document.querySelector(".publicar-anuncio"),
    $modal = document.querySelector("#modal")

    const url = baseUrl + "?controller=AnuncioController&action=getAnunciosByUser"
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
        
            $secionAnuncios.innerHTML = 
            `<article class="anuncio anuncio-add">
                <a href="?controller=AnuncioController&action=publicarAnuncio" class="publicar-anuncio"><i class="fa fa-plus" aria-hidden="true"></i> </a>
                </article>`
        
            $secionAnuncios.innerHTML+= anuncios.map(anuncio => 
                `<article class="anuncio">
                        <h3 class="anuncio-titulo">${anuncio.titulo}</h3>
                        <figure>
                            <img class="anuncio-img" src="${anuncio.imagen_url}" alt="${anuncio.titulo}">
                        </figure>
                        <p class="anuncio-texto">Descripcion: ${anuncio.descripcion}</p>
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
                                 <button class="btn-modal verMas" data-id="${anuncio.id}" onclick="window.modal.showModal()"><i class="fa fa-eye" data-id=${anuncio.id}></i></button>
                            </li>
                            <li>
                                <a class="editar" href="?controller=AnuncioController&action=updateAnuncioPage&id=${anuncio.id}"><i class="fas fa-edit"></i></a>
                            </li>
                            <li>
                                <a href="?controller=AnuncioController&action=anuncioPage&id=${anuncio.id}"><i class="fas fa-arrow-right"></i></a>
                            </li>
                        </ul>
                    </article>`
                ).join("")
            
        }
        console.log(anuncios)

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
                            <a class="editar" href="?controller=AnuncioController&action=updateAnuncioPage&id=${anuncio.id}"><i class="fas fa-edit"></i> Editar Anuncio</a>
                        </li>
                        <li>
                            <a class="eliminar" href="?controller=AnuncioController&action=deleteAnuncio&id=${anuncio.id}"><i class="fa fa-trash"></i> Borrar Anuncio</a>
                        </li>
                        <li>
                            <a href="?controller=AnuncioController&action=anuncioPage&id=${anuncio.id}"><i class="fas fa-arrow-right"></i> Ir al Anuncio</a>
                        </li>
                    </ul>
           <a class="modalCerrar" onclick="window.modal.close();"><i class="fas fa-window-close"></i></a>
        </article>`
}
document.addEventListener("DOMContentLoaded", ev => {
    getAnunciosAxios() 
    const $bntModal = $d.querySelectorAll(".btn-modal")
})
$secionAnuncios.addEventListener("click", ev => {   
    if (ev.target.dataset.id) {
        const id = ev.target.dataset.id;
        renderModal(id);
        $modal.showModal();
    }
}) 


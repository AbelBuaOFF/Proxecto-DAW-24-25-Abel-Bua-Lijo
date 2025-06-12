const $d = document,
    $buscador = $d.querySelector("#buscador"),
    $categorias = $d.querySelectorAll(".categorias"),
    $localizaciones = $d.querySelectorAll(".localizacion"),
    $secionAnuncios = $d.querySelector(".section-anuncios"),
    $btnAdd = $d.querySelector(".publicar-anuncio"),
    $modal = $d.querySelector("#modal")

    const url = baseUrl + "?controller=AnuncioController&action=getAnunciosByUser"
    const anuncios = []

    function ajax(options) {  
        const {url,method,fExito,fError,data}=options
      
        fetch(url,{
          method:method || 'GET',
          headers:{
            "Content-type":"application/json;charset=utf-8"
          },
          body:JSON.stringify(data)
        })
        .then((resp)=>resp.ok?resp.json():Promise.reject(resp))
        .then((json)=>fExito(json))
        .catch((error=>fError({
          status:error.status,
          statusText:error.statusText
        })))
      
      }

      function getAnuncios(){
        ajax({
            url: url,
            fExito: (json) => {
                anuncios.splice(0, anuncios.length, ...json);
                renderAnuncios(anuncios);
            },
            fError: (error) => console.log(error),
          });
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
                        <ul class="anuncio-btn">
                            <li>
                                 <button class="btn-modal verMas" data-id=${anuncio.id} onclick="window.modal.showModal()"><i class="fa fa-eye"></i></button>
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
                            <p class="titulo"><span class="bold">${anuncio.titulo}</span></p>
                            <p class="descripcion">${anuncio.descripcion}</p>
                            <p class="contenido">${anuncio.contenido}</p> 
                        </div>
                        <figure>
                            <img class="anuncio-img" src="${anuncio.imagen_url}" alt="${anuncio.titulo}">
                        </figure>
                    </div>
                    <ul class="anuncio-links">
                        <li>
                            <a href="?controller=AnuncioController&action=updateAnuncioPage&id=${anuncio.id}"><i class="fas fa-edit"></i> Editar Anuncio</a>
                        </li>
                        <li>
                            <a href="?controller=AnuncioController&action=deleteAnuncio&id=${anuncio.id}"><i class="fa fa-trash"></i> Borrar Anuncio</a>
                        </li>
                        <li>
                            <a href="?controller=AnuncioController&action=anuncioPage&id=${anuncio.id}"><i class="fas fa-arrow-right"></i> Ir al Anuncio</a>
                        </li>
                    </ul>
           <a class="modalCerrar" onclick="window.modal.close();"><i class="fas fa-window-close"></i></a>
        </article>`
}
$d.addEventListener("DOMContentLoaded", ev => {
    getAnuncios()
    const $bntModal = $d.querySelectorAll(".btn-modal")
})
$secionAnuncios.addEventListener("click", ev => {   
    if (ev.target.classList.contains("btn-modal")) {
        const id = ev.target.dataset.id;
        renderModal(id);
        $modal.showModal();
    }
}) 


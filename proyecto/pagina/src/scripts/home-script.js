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
                        <button class="btn-modal" data-id=${anuncio.id} onclick="window.modal.showModal();">Ver mas...</button>
                    </article>`
                ).join("")
            
        }
        console.log(anuncios)

function renderModal(id) {

    anuncio = anuncios.find(anuncio => anuncio.id == id);
    $modal.innerHTML = `
        <article class="elemento-modal">
                        <h3 class="anuncio-titulo">${anuncio.titulo}</h3>
                        <p class="descripcion">${anuncio.descripcion}</p>
                        <p class="contenido">${anuncio.contenido}</p>
                        <figure>
                            <img class="anuncio-img" src="${anuncio.imagen_url}" alt="${anuncio.titulo}">
                        </figure>
                        <a href="?controller=AnuncioController&action=anuncioPage&id=${anuncio.id}" >Ir a Pagina...</a>
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


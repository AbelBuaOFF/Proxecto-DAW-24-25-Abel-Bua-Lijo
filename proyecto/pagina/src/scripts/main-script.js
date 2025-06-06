
const $d = document,
    $buscador = $d.querySelector("#buscador"),
    $categorias = $d.querySelectorAll(".categorias"),
    $localizaciones = $d.querySelectorAll(".localizacion"),
    $secionAnuncios = $d.querySelector(".section-anuncios"),
    $btnAdd = $d.querySelector(".publicar-anuncio"),
    $modal = $d.querySelector("#modal")

    const url = baseUrl + "?controller=MainController&action=getAnuncios"
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
                    <p class="anuncio-texto">Descripcion: ${anuncio.descripcion}</p>
                    <a href="?controller=AnuncioController&action=anuncioPage&id=${anuncio.id}"><i class="fas fa-arrow-right"></i></a>
                    <button class="btn-modal" data-id=${anuncio.id} onclick="window.modal.showModal()"><i class="fa fa-eye"></i> Ver mas...</button>
                </article>`
            ).join("")
        }
    }
    
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
                    <a href="?controller=AnuncioController&action=anuncioPage&id=${anuncio.id}">
                           <span class="link"><i class="fas fa-arrow-right"></i> Ir a Pagina...</span>
                    </a>
                <a class="modalCerrar" onclick="window.modal.close();"><i class="fas fa-window-close"></i></a>
        </article>`
}

$d.addEventListener("DOMContentLoaded", ev => {
    getAnuncios()
    
  const $bntModal = $d.querySelectorAll(".btn-modal")
})

$secionAnuncios.addEventListener("click", ev => {  
    console.log(anuncios); 
    if (ev.target.classList.contains("btn-modal")) {
        const id = ev.target.dataset.id;
        renderModal(id);
        $modal.showModal();
    }
}) 



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
            "Content-type":"applications/json;charset=utf-8"
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
    $secionAnuncios.innerHTML= anuncios.map(anuncio => 
        `<article class="anuncio" id="${anuncio.id}">
                <h3 class="anuncio-titulo">${anuncio.titulo}</h3>
                <figure>
                    <img class="anuncio-img" src="${anuncio.imagen_url}" alt="${anuncio.titulo}">
                </figure>
                <p class="anuncio-texto">Descripcion: ${anuncio.descripcion}</p>
                <button class="btn-modal" data-id=${anuncio.id} onclick="window.modal.showModal();">Ver mas...</button>
            </article>`
        ).join("")
  
        

    }

function rederModal(id) {

    anuncio = anuncios.find(anuncio => anuncio.id == id);

    modal.innerHTML = `
        <article class="elemento-modal">
                        <h3 class="anuncio-titulo">${anuncio.titulo}</h3>
                        <p class="descripcion">${anuncio.descripcion}</p>
                        <p class="contenido">${anuncio.contenido}</p>
                        <figure>
                            <img class="anuncio-img" src="${anuncio.imagen_url}" alt="${anuncio.titulo}">
                        </figure>

                        <button onclick="window.modal.close();">Cerrar</button>
        </article>
                `
    console.log(anuncio);

    
}

$d.addEventListener("DOMContentLoaded", ev => {
    getAnuncios()
  const $bntModal = $d.querySelectorAll(".btn-modal")
})

$secionAnuncios.addEventListener("click", ev => {   
    if (ev.target.classList.contains("btn-modal")) {
        const id = ev.target.dataset.id;
        rederModal(id);
        $modal.showModal();
    }
}) 


const $d = document,
    $selector = $d.querySelector(".section-tipo-form"),
    $empresa = $d.querySelector(".empresa")
    
function renderFormEmpresa() {

    $empresa.innerHTML = `
            <fieldset class="empresa .off">
                <p>Datos de la Empresa</p>
                <ul class="fila-form">
                    <label for="nombre-comercial"> Nombre  Comercial:</label>
                    <input type="text" placeholder="Nombre..." name="nombre-comercial" id="nombre-comercial" required>
                </ul>
                <ul class="fila-form">
                    <label for="url_web"> Pagin Web:</label>
                    <input type="text" placeholder="Nombre..." name="url_web" id="url_web">
                </ul>
                </fieldset>`
    
}

$selector.addEventListener("change", (e) => {

    if (e.target.value === "empresa") {
        renderFormEmpresa();
    } else {
        $empresa.innerHTML = "";
    }

})


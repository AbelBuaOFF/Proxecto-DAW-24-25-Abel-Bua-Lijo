console.log("Admins script loaded");

const $panel=document.querySelector(".AdminTools"),
      $opciones = document.querySelector(".opciones"),
      $botonAdmin = document.querySelector(".btn-admin"),
      $bloquear = document.querySelector(".bloquear")

$botonAdmin.addEventListener("click", (ev) => {
    ev.preventDefault();
    if ($opciones.classList.contains("off")) {
        $opciones.classList.remove("off");
    } else {
        $opciones.classList.add("off");
    }

});

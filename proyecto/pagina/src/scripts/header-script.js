console.log("Header script loaded");

const $menuMovil=document.querySelector(".menu-hamburguesa"),
      $btn = document.querySelector(".menu-hamburguesa-btn")

    $btn.addEventListener("click", ev => {
        if ($menuMovil.classList.contains("off")){
            $menuMovil.classList.remove("off");
            $btn.innerHTML = `<i class="fas fa-window-close close"></i>`;
            $btn.classList.add("btn-close");
        }else{
            $menuMovil.classList.add("off");
            $btn.innerHTML = `<i class="fas fa-bars"></i>`;
            $btn.classList.remove("btn-close");
        }
    });
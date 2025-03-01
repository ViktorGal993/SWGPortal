/*Animotion von icons*/

let icons_animation = document.querySelectorAll(".animat");

for(let i=0;i<icons_animation.length;i++){

    icons_animation[i].addEventListener("mouseover",function(){
        icons_animation[i].style.transform = "scale(1.1)";
    });
    
    for(let i=0;i<icons_animation.length;i++){

        icons_animation[i].addEventListener("mouseout",function(){
            icons_animation[i].style.transform = "scale(1)";
        });
    }        
}
/*Kontakt Liste einrichten*/

let kontakt = document.querySelector(".kontakt"),
    liste = document.querySelector(".kontakt_funktion"),
    closeBtn = document.querySelector(".close");

    kontakt.addEventListener("mouseover", function(){
        liste.style.display = "block";
    });

    kontakt.addEventListener("mouseout", function(){
        liste.style.display = "none";
    });  

/*Support window einrichten*/

let support = document.querySelector(".support__button"),
    support_modal = document.querySelector(".modal__support"),
    close_support = document.querySelector(".close__support");

    support.addEventListener("click", function(){
        support_modal.style.display = "block";
    });

    close_support.addEventListener("click", function(){
        support_modal.style.display = "none";
    });

    /*Kunden Portal window einrichten*/
 
    let portal = document.querySelector(".portal__button"),
    kunden_potal_modal = document.querySelector(".kunden_portal"),
    close_close_kp = document.querySelector(".close__portal");

    portal.addEventListener("click", function(){
        kunden_potal_modal.style.display = "flex";
    });

    close_close_kp.addEventListener("click", function(){
        kunden_potal_modal.style.display = "none";
    });





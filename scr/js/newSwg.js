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
/*Animotion 2(dopelt zu gross) von icons*/

let icons_animation2 = document.querySelectorAll(".animat2");

for(let i=0;i<icons_animation2.length;i++){

    icons_animation2[i].addEventListener("mouseover",function(){
        icons_animation2[i].style.transform = "scale(1.3)";
    });
    
    for(let i=0;i<icons_animation2.length;i++){

        icons_animation2[i].addEventListener("mouseout",function(){
            icons_animation2[i].style.transform = "scale(1)";
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




    /* Termin Kalender einrichten (Terminplanung)*/
    let termin = document.querySelectorAll(".termin").forEach(btn =>{
        btn.addEventListener('click',()=> 
            termin_modal.style.display = "block")
    }),
    termin_modal = document.querySelector(".modal__termin"),
    close_termin = document.querySelector(".close__termin");
/*
    termin.addEventListener("click", function(){
        termin_modal.style.display = "block";
    });
*/
    close_termin.addEventListener("click", function(){
        termin_modal.style.display = "none";
    });

     /*Frage einrichten */
     let frage = document.querySelector(".frage");     
    frage.addEventListener("click", function(){
        termin_modal.style.display = "block";
    });

    /*downlod Modal einrichten*/
    let modal_download_btn = document.querySelector(".button_download"),
        close_download = document.querySelector(".close__download"),
        modal_download = document.querySelector(".modal_download");

        modal_download_btn.addEventListener("click", function(){
            modal_download.style.display = "block";
        });

        close_download.addEventListener("click", function(){
            modal_download.style.display = "none";
        });

    

    /*die heutige Datum erhalten*/
    document.addEventListener("DOMContentLoaded", function(){
        let today = new Date().toISOString().split("T")[0];

        /*deufault Datum einsetzen*/
    let date_input =   
    document.querySelector('#date');
    date_input.min = today;
    date_input.value = today;
    });





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
    liste = document.querySelector(".kontakt_funktion");

    kontakt.addEventListener("click", function(){
        liste.style.display = "block";
    });

/*
    kontakt.addEventListener("mouseout", function(){
        liste.style.display = "none";
    });

    liste.addEventListener("mouseover", function(){
        liste.style.display = "block";
    });
*/






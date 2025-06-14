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

let feedback = document.querySelector('.end_message'); //Nachricht Message einrichten

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
        termin_modal.style.display = "none";
        modal_download.style.display = "none";
        modal_bewerb.style.display = "none";        
    });
    close_support.addEventListener("click", function(){
        support_modal.style.display = "none";
    }); 

   
//Termin Fenster einrichtung
let termin = document.querySelectorAll(".termin"),
termin_modal = document.querySelector(".modal__termin"),
close_termin = document.querySelector(".close__termin");

for(let i =0;i< termin.length; i++) {
    termin[i].addEventListener("click", function() {
        termin_modal.style.display = "block";
        support_modal.style.display = "none";  
        modal_download.style.display = "none";
        modal_bewerb.style.display = "none";
    });
}
close_termin.addEventListener("click", function(){
    termin_modal.style.display = "none";
});

const form_termin = document.getElementById('termin_reserv'); 
form_termin.addEventListener('submit', function (e) {
     termin_modal.style.display = "none";

     feedback.style.display= "block";
//warten 1,5 Sekunde
setTimeout(()=>{
        
        feedback.style.display= "none";
    },1500);


});

     /*Frage einrichten  (2ein für laptop version, ein für mobil) */
     let frage = document.querySelectorAll(".frage");
     
     for(let i=0;i<frage.length;i++){

        frage[i].addEventListener("click",function(){
            support_modal.style.display = "block";
        });
    }    

    /*downlod Modal einrichten*/
    let modal_download_btn = document.querySelector(".button_download"),
        close_download = document.querySelector(".close__download"),
        modal_download = document.querySelector(".modal_download");

        modal_download_btn.addEventListener("click", function(){
            modal_download.style.display = "block";
            support_modal.style.display = "none";  
            termin_modal.style.display = "none";            
            modal_bewerb.style.display = "none";
        });

        close_download.addEventListener("click", function(){
            modal_download.style.display = "none";
        });    

    /*die heutige Datum erhalten*/
    document.addEventListener("DOMContentLoaded", function(){
        let today = new Date().toISOString().split("T")[0];

        /*deufault Datum einsetzen*/
    let date_input =   
    document.getElementById("date")
    date_input.min = today;
    date_input.value = today;
    });

   /* Modal Bewerbungen*/
   
/*Import elements*/
   function uploadPDF() {
    let file_input = document.getElementById("pdf_file"),
        status = document.getElementById("status");

/* prüft auswahl*/
        if(file_input.length === 0) {
            status.innerText = "Datei auswählen";
            return;
        }
/* Object erstellen für den server*/
        let file = file_input[0];
        let formData = new FormData();
        formData.append("pdfFile", file);
/* sendet object an server*/
        fetch("upload.php", {
            method:"POST",
            body:formData
        })
/* antwort von server bearbeiten*/
        .then(response=> response.text()) //antwort im Text format
        .then(result => {
            status.innerText = result; // gibt Text als status
        })
        .catch(error => {
            status.innerText = "Fehler beim uploaden";
            console.error("Fehler", error);
        });
   }

let modal_bewerb_btn = document.querySelector(".button_bewerbung"),
    modal_bewerb = document.querySelector(".modal_bewerb"),
    close_bewerb = document.querySelector(".close__bewerb");

    modal_bewerb_btn.addEventListener("click", function(){
        modal_bewerb.style.display = "block";
        support_modal.style.display = "none";
        termin_modal.style.display = "none";
        modal_download.style.display = "none";
        });
    close_bewerb.addEventListener("click", function(){
        modal_bewerb.style.display = "none";
    });

     const form_bewerbung = document.getElementById('uploads'); 
    form_bewerbung.addEventListener('submit', function (e) {
     modal_bewerb.style.display = "none";

     feedback.style.display= "block";
//warten 1,5 Sekunde
setTimeout(()=>{        
        feedback.style.display= "none";
    },2000);

});

    /*mobil Nav Einrichtung*/
    document.addEventListener("DOMContentLoaded", function() {        // um die Seite voll geladen
        const menu_Toggle = document.getElementById("menu_toggle"),
            menu = document.getElementById("menu");      

        menu_Toggle.addEventListener("click", function(){
           menu.classList.toggle("show");
           modal_bewerb.style.display = "none";
        support_modal.style.display = "none";
        termin_modal.style.display = "none";
        modal_download.style.display = "none";
       }); 
    });


    
   
// die form Support auf zwei action sendne

const form = document.getElementById('massage_suport');    
form.addEventListener('submit', function (e) {
// Verhindern des Standardverhaltens des Formulars
    e.preventDefault(); 
    // Datei von Form erstellen        
    const formData = new FormData(form);

// Sendung auf erste action      
fetch('save_user.php', {            
    method: 'POST',            
    body: formData        
}).then(response => {            
    if (response.ok) {                
        console.log('Данные успешно отправлены на /action1'); 
                
    }        
});
// Sendung auf zweite action       
fetch('sendPHPMaler.php', {            
    method: 'POST',            
    body: formData        
}).then(response => {            
    if (response.ok) {                
        console.log('Данные успешно отправлены на /action2');
              
                
    }        
}); 

document.querySelector(".modal__support").style.display='none'; 
feedback.style.display= "block";
//warten 1,5 Sekunde
setTimeout(()=>{ 
        feedback.style.display= "none";
    },1500);
//leren das Form
this.reset();    
 
});


// modal Ruckruf

let ruckruf_btn = document.querySelector(".ruckruf"),
    modal_ruckruf = document.querySelector(".modal_ruckruf"),
    close_ruckruf = document.querySelector(".close__ruckruf");
   
    

    ruckruf_btn.addEventListener("click", function(){
        modal_ruckruf.style.display = "block";
        support_modal.style.display = "none";        
        termin_modal.style.display = "none";
        modal_download.style.display = "none";
        modal_bewerb.style.display = "none";        
    });
    close_ruckruf.addEventListener("click", function(){
         modal_ruckruf.style.display = "none";
    });

    const form_ruckruf = document.getElementById('ruckruf'); 
    form_ruckruf.addEventListener('submit', function (e) {
     modal_ruckruf.style.display = "none";

     feedback.style.display= "block";
//warten 1,5 Sekunde
setTimeout(()=>{        
        feedback.style.display= "none";
    },1500);

});




    
    
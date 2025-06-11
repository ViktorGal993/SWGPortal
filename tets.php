<?php
header("Location:http://service.swg-datensysteme.de/");
exit();

?>


// die form Support auf zwei action sendne

//muss noch Überprüfen; da für diese Funktion ein PHP file erstelt wurden
/*
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
});

document.querySelector(".modal__support").style.display='none'; 
feedback.style.display= "block";
//warten 1,5 Sekunde
setTimeout(()=>{ 
        feedback.style.display= "none";
    },1500);
//leren das Form
this.reset();

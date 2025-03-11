let skills = ["html","css", "js"];

function skill(name,age, num){
    for(let i =0; i<skills.length;i++){
        alert(` ${name} ich bechersche ${skills[i]}`);
    }

    function age(age){
        if(age>18){
            alert("du kannst gute fronend werden");
        }else {alert("du bist noch jung");}
    }

    age(age);

    function quadrat(num){
     alert(num*num);
    }

    quadrat(num);


}

skill("Viktor",17,3);
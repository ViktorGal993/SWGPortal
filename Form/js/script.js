let shooseBtn = document.querySelector("#choose"),
    textDatai = document.getElementsByTagName("h2")[0],
    twooBtn = document.querySelector("#receive") ,
    modals = document.querySelector(".modal"),
    modalClose = document.querySelector(".close"),
    Textname = document.getElementsByName("message")[0],
    nameInput = document.getElementsByClassName(".contactform_name") [0];
    

    shooseBtn.addEventListener("mouseenter", function(){
      textDatai.textContent = "bauuuuu!!!";
    });

    shooseBtn.addEventListener("mouseleave", function(){
        textDatai.textContent = " wieder so, wie war früher!";
    });

    twooBtn.addEventListener("click",function(){
    modals.style.display = "block";
    });

    modalClose.addEventListener("click", function(){
        modals.style.display = "none";
    });

    
    nameInput.addEventListener("input",function(){
        Textname.value = `my name is ${nameInput.value}....`;
    });


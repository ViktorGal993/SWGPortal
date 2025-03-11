window.addEventListener('DOMContentLoaded', function(){


        function creatCart(){
            let cart = document.createElement('div'),
                field = document.createElement('div'),
                heading=document.createElement('h2'),
                closeBtn = document.createElement('button');

                 cart.classList.add('cart');
                 field.classList.add('cart_field');
                 closeBtn.classList.add('closse');

                 heading.textContent='in Kaufwagen';
                 closeBtn.textContent= 'clossed';

                 document.body.appendChild(cart);
                 cart.appendChild(heading);
                 cart.appendChild(field);
                 cart.appendChild(closeBtn);
        }
        creatCart();



        
});





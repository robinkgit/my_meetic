$("#connexion_form").submit(function(e){
    e.preventDefault();
    email = $(this).find("input[name=email_connexion]").val();
    password = $(this).find("input[name=password_connexion]").val();

   $.post("../controller/controller_connexion.php", {emailco: email,passwordco: password},function(response){
     console.log(response); 
        if(response == "false"){
            alert("Compte supprimé, Veuillez vous réinscrire")
            return;
        }
        else if(response == ""){
            alert("La connexion à échoué.. Veuillez réessayer");
            return;
          
        }
        else{
            alert("Connexion réussi ! Bienvenu");
            var button =  document.createElement("button");
            var p_button = document.createElement("p");

            document.body.append(button);
            button.appendChild(p_button);
            p_button.innerHTML = "Mon Compte";

            button.addEventListener("click",function(){
                var data =  response;
                sessionStorage.setItem('data',data);
                location.href = "view_mon_compte.php";
                
                
            })
            var button_recherche = document.createElement("button");
            var p_button_recherche = document.createElement("p");
            document.body.append(button_recherche);
            button_recherche.appendChild(p_button_recherche);
            p_button_recherche.innerHTML = "Recherche..";
           // export default data;      

           button.style.borderRadius = "2rem";
           button.style.backgroundColor = "blueviolet"
           button.style.color = "white";
           button.style.width = "7rem";
           button.style.height = "2rem";
           button.style.marginRight = "1.5rem";


           button_recherche.style.borderRadius = "2rem";
           button_recherche.style.backgroundColor = "blueviolet"
           button_recherche.style.color = "white";
           button_recherche.style.width = "7rem";
           button_recherche.style.height = "2rem";
           button_recherche.style.marginRight = "1.5rem";

           button_recherche.addEventListener("click",function(){
            location.href = "view_recherche.php";
           })
        }
       
    })
    })



        
        
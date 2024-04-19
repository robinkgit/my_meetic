var data1 = sessionStorage.getItem('data');
 var arr = $.parseJSON(data1);
 var nom   = arr["nom"];
 var prenom = arr["prenom"];
 var naissance = arr["date_de_naissance"];
 var genre = arr["genre"];
 var ville = arr["ville"];
 var mail = arr["email"];

 if(arr.hasOwnProperty("0")){
    var loisir = arr["0"];
 }if(arr.hasOwnProperty("1")){
    var loisir = arr["0"] + "," +  arr ["1"];
 }
 if(arr.hasOwnProperty("2")){
    var loisir = arr["0"] + "," +  arr ["1"] + "," + arr["2"];
 }if(arr.hasOwnProperty("3")){
    var loisir = arr["0"] + "," +  arr ["1"] + "," + arr["2"] + "," + arr["3"];
 }if(arr.hasOwnProperty("4")){
    var loisir = arr["0"] + "," +  arr ["1"] + "," + arr["2"] + "," + arr["3"] + "," + arr["4"];
 }

// console.log(nom);
 

 var welcome  = document.createElement("h1");
 var p_infos = document.createElement("p");
 var p_nom = document.createElement("p");
 var p_prenom = document.createElement("p");
 var p_date_de_naissance = document.createElement("p");
 var p_genre = document.createElement("p");
 var p_email = document.createElement("p");
 var p_loisir = document.createElement("p");

 document.body.append(welcome);
 welcome.innerHTML = "Bienvenue chez vous" + " "+ nom + " "+ prenom + "!";
 document.body.append(p_infos);
 p_infos.innerHTML = "Vos informations"
 p_infos.style.textDecoration = "underline";
 document.body.append(p_nom);
 p_nom.innerHTML = "Nom :" + " "+ nom;
 document.body.append(p_prenom);
 p_prenom.innerHTML = "Prénom :" + " "+ prenom;
 document.body.append(p_date_de_naissance);
 p_date_de_naissance.innerHTML = "Date de naissance :" + " " + naissance;
 document.body.append(p_genre);
 p_genre.innerHTML = "Genre :" + " " + genre;
 document.body.append(p_email);
 p_email.innerHTML = "Adresse e-mail :" + " " + mail;
 document.body.append(p_loisir);
 p_loisir.innerHTML = "Vos Loisirs :" + " " + loisir;

 var input_mot_passe_actuel = document.createElement("input");
 var label_mot_passe_actuel = document.createElement("label");
 var input_nouveau_mot_de_passe = document.createElement("input");
 var label_nouveau_mot_de_passe = document.createElement("label");
 var button_valid = document.createElement("button");
 var fieldset = document.createElement("fieldset");
 var legend = document.createElement("legend");


document.body.append(fieldset);
fieldset.appendChild(legend);
legend.innerHTML = "Modifier vos informations";
fieldset.append(label_mot_passe_actuel);
label_mot_passe_actuel.innerHTML = "Entrez votre mot de passe actuel : ";
fieldset.append(input_mot_passe_actuel);
input_mot_passe_actuel.setAttribute("type","password");
fieldset.appendChild(label_nouveau_mot_de_passe);
label_nouveau_mot_de_passe.innerHTML = "Entrez le nouveau mot de passe : ";
fieldset.append(input_nouveau_mot_de_passe);
input_nouveau_mot_de_passe.setAttribute("type","password");
fieldset.append(button_valid);
button_valid.innerHTML = "Valider";

button_valid.addEventListener("click",function(){
    var value_actuel_mdp = input_mot_passe_actuel.value;
    var value_new_mdp = input_nouveau_mot_de_passe.value;
    console.log(value_new_mdp);
    $.post("../controller/controller_mon_compte_mdp.php",{actual_mdp: value_actuel_mdp, new_mdp: value_new_mdp},function(){
        alert("Changement de mot de passe effectué !");
    })
})


 var input_mail_actuel = document.createElement("input");
 var label_mail_actuel = document.createElement("label");
 var input_nouveau_mail = document.createElement("input");
 var label_nouveau_mail = document.createElement("label");
 var button_valid_mail = document.createElement("button");

 fieldset.appendChild(label_mail_actuel);
 label_mail_actuel.innerHTML = "Entrez votre e-mail actuel : ";
 fieldset.appendChild(input_mail_actuel);
 input_mail_actuel.setAttribute("type","email");
 fieldset.appendChild(label_nouveau_mail);
 label_nouveau_mail.innerHTML = "Entrez votre nouvel e-mail : ";
 fieldset.appendChild(input_nouveau_mail);
 input_nouveau_mail.setAttribute("type","email");
 fieldset.appendChild(button_valid_mail);
 button_valid_mail.innerHTML = "Valider";

 button_valid_mail.style.borderRadius = "2rem"
 button_valid.style.borderRadius = "2rem"



fieldset.style.marginTop = "2.5rem";
input_mot_passe_actuel.style.marginLeft = "7rem";
input_nouveau_mot_de_passe.style.marginLeft = "7rem";
button_valid.style.marginLeft = "10rem" ;
input_mail_actuel.style.marginLeft = "7rem";
input_nouveau_mail.style.marginLeft ="7rem";
button_valid_mail.style.marginLeft = "10rem" ;

 button_valid_mail.addEventListener("click",function(){
    var value_actuel_mail = input_mail_actuel.value;
    var value_new_mail = input_nouveau_mail.value;
    console.log(value_new_mail);

    $.post("../controller/controller_mon_compte_mail.php",{actuel_mail: value_actuel_mail, new_mail: value_new_mail},function(){
        alert("Changement d'e-mail effectué !");
    })
 })

 var button_sup = document.createElement("button");
 fieldset.appendChild(button_sup);
 button_sup.innerHTML ="Supprimer mon compte";
 button_sup.style.backgroundColor = "#F00042";
 button_sup.style.marginLeft= "7rem";
 button_sup.style.borderRadius= "2rem";


 button_sup.addEventListener("click",function(){
    var conf = confirm("Etes-vous sûr de vouloir supprimer votre commpte ?")
    if(conf == true){
        $.post("../controller/controller_mon_compte_sup.php",function(){
            alert("Compte supprimé");
        })
    }else{
        alert("vous avez annulé");
    }
 })








 
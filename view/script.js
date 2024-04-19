date_actual = new Date();
var day = date_actual.getDate();
var month = date_actual.getMonth() + 1;
var year = date_actual.getFullYear();

var fullDate = 2006 + '-' + month + '-' + day;
//console.log(fullDate);
$("#inscription_form").submit(function(e){
    e.preventDefault();
    nom = $(this).find("input[name=name_inscription]").val();
    prenom = $(this).find("input[name=prenom_inscription]").val();
    date = $(this).find("input[name=date_inscription]").val();
    genre = $(this).find("input[name='genre_inscription']:checked").val();
    ville = $(this).find("select[name=ville_inscription]").val();
    email = $(this).find("input[name=email_inscription]").val();
    password = $(this).find("input[name=password_inscription]").val();
    loisir = $(this).find("input[name=loisir_inscription]:checked").serialize();

    if(date > fullDate){
       // e.preventDefault();
        alert("Vous devez être majeur pour vous inscrire");
    }
    else{
        $.post("../controller/controller_inscription.php", {nom: nom, prenom: prenom, date: date, genre: genre, ville: ville,email: email,password: password, loisir: loisir},function(response){
            //alert($.parseJSON(response).length == 0);
            if($.parseJSON(response).length == 0){
                alert("L'adresse mail est déjà associé à un compte");
            }else{
                alert("Inscription validé, Bienvenue chez nous !");
            }
           
            //$.ajax({url: '../controller/controller_inscription.php'});
        
        });
    }

    //return false;
})
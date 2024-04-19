var div = document.getElementById("result_recherche");
var div_next = document.getElementById("next-previous")
var i = 0;
$("#recherche").submit(function(e){
    e.preventDefault();
    genre = $(this).find("select[name=genre]").val();
    age = $(this).find("select[name=tranche_age]").val();
    loisir = [];
    ville = [];
    $("input:checkbox[name=loisir]:checked").each(function(){
        loisir.push($(this).val());
    })
    $("input:checkbox[name=ville]:checked").each(function(){
        ville.push($(this).val());
    })

    if(genre !== "" && age == "" && loisir.length == 0 && ville.length == 0){
    $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
       // alert(response);
        var arr_data = $.parseJSON(response);
        var arr_1 = arr_data;
        if(arr_data.length == 0){
           div.innerText = "Aucun résultat";
        }else{
       //$(arr_1).each(function(){
        localStorage.setItem('array',response);
        div.innerText = arr_1[i];
       //})
    }
    })
    }

    if(genre == "" && age !=="" && loisir.length == 0 && ville.length == 0){
        $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
            console.log($.parseJSON(response).length);
            if($.parseJSON(response).length == 0) {
                div.innerText = "Aucun résultat";
            }else{
                var arr_data = $.parseJSON(response);
                localStorage.setItem('array',response);
                div.innerText = arr_data[i];
        }

        })

    }

    if(genre == "" && age =="" && loisir.length == 0 && ville.length !== 0){
        $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
            //alert($.parseJSON(response));
            if($.parseJSON(response) == "") {
                div.innerText = "Aucun résultat";
            }else{
                var arr_data = $.parseJSON(response);
               // console.log(arr_data);
                var arr_1 = arr_data;
                localStorage.setItem('array',response);
                div.innerText = arr_1[i];
            }
        })

    }

    if(genre == "" && age =="" && loisir.length !== 0 && ville.length == 0){
        $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
           // alert(response);
            if($.parseJSON(response) == "") {
                div.innerText = "Aucun résultat";
            }else{
                var arr_data = $.parseJSON(response);
                console.log(arr_data);
               // var arr_1 = arr_data;
                localStorage.setItem('array',response);
                div.innerText = arr_data[i];
        }

        })

    }



    if(genre !== "" && age !== "" && loisir.length == 0 && ville.length == 0){
        $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
           // alert(response);
            var arr_data = $.parseJSON(response);
            var arr_1 = arr_data;
            if(arr_data.length == 0){
               div.innerText = "Aucun résultat";
            }else{
                localStorage.setItem('array',response);
                div.innerText = arr_1[i];
        }
        })
        }


        if(genre !== "" && age == "" && loisir.length !== 0 && ville.length == 0){
            $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
               // alert(response);
                var arr_data = $.parseJSON(response);
                var arr_1 = arr_data;
                if(arr_data.length == 0){
                   div.innerText = "Aucun résultat";
                }else{
                    localStorage.setItem('array',response);
                    div.innerText = arr_1[i];
            }
            })
            }

            if(genre !== "" && age == "" && loisir.length == 0 && ville.length !== 0){
                $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                   // alert(response);
                    var arr_data = $.parseJSON(response);
                    var arr_1 = arr_data;
                    if(arr_data.length == 0){
                       div.innerText = "Aucun résultat";
                    }else{
                        localStorage.setItem('array',response);
                        div.innerText = arr_1[i];
                }
                })
                }

                if(genre == "" && age == "" && loisir.length !== 0 && ville.length !== 0){
                    $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                       // alert(response);
                        var arr_data = $.parseJSON(response);
                        var arr_1 = arr_data;
                        if(arr_data.length == 0){
                           div.innerText = "Aucun résultat";
                        }else{
                            localStorage.setItem('array',response);
                            div.innerText = arr_1[i];
                    }
                    })
                    }

                    if(genre == "" && age !== "" && loisir.length == 0 && ville.length !== 0){
                        $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                           // alert(response);
                            var arr_data = $.parseJSON(response);
                            var arr_1 = arr_data;
                            if(arr_data.length == 0){
                               div.innerText = "Aucun résultat";
                            }else{
                                localStorage.setItem('array',response);
                                div.innerText = arr_1[i];
                        }
                        })
                        }
                        if(genre == "" && age !== "" && loisir.length !== 0 && ville.length == 0){
                            $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                               // alert(response);
                                var arr_data = $.parseJSON(response);
                                var arr_1 = arr_data;
                                if(arr_data.length == 0){
                                   div.innerText = "Aucun résultat";
                                }else{
                                    localStorage.setItem('array',response);
                                    div.innerText = arr_1[i];
                            }
                            })
                            }


                            if(genre !== "" && age !== "" && loisir.length !== 0 && ville.length !== 0){
                                $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                                   // alert(response);
                                    var arr_data = $.parseJSON(response);
                                    var arr_1 = arr_data;
                                    if(arr_data.length == 0){
                                       div.innerText = "Aucun résultat";
                                    }else{
                                        localStorage.setItem('array',response);
                                        div.innerText = arr_1[i];
                                }
                                })
                                }


                                if(genre !== "" && age == "" && loisir.length !== 0 && ville.length !== 0){
                                    $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                                       // alert(response);
                                        var arr_data = $.parseJSON(response);
                                        var arr_1 = arr_data;
                                        if(arr_data.length == 0){
                                           div.innerText = "Aucun résultat";
                                        }else{
                                            localStorage.setItem('array',response);
                                            div.innerText = arr_1[i];
                                    }
                                    })
                                    }

                                    if(genre !== "" && age !== "" && loisir.length !== 0 && ville.length == 0){
                                        $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                                           // alert(response);
                                            var arr_data = $.parseJSON(response);
                                            var arr_1 = arr_data;
                                            if(arr_data.length == 0){
                                               div.innerText = "Aucun résultat";
                                            }else{
                                                localStorage.setItem('array',response);
                                                div.innerText = arr_1[i];
                                        }
                                        })
                                        }

                                        if(genre !== "" && age !== "" && loisir.length == 0 && ville.length !== 0){
                                            $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                                               // alert(response);
                                                var arr_data = $.parseJSON(response);
                                                var arr_1 = arr_data;
                                                if(arr_data.length == 0){
                                                   div.innerText = "Aucun résultat";
                                                }else{
                                                    localStorage.setItem('array',response);
                                                    div.innerText = arr_1[i];
                                            }
                                            })
                                            }
                                        
                                            if(genre == "" && age !== "" && loisir.length !== 0 && ville.length !== 0){
                                                $.post("../controller/controller_recherche.php", {genre: genre, age: age , loisir: loisir, ville: ville}, function(response){
                                                   // alert(response);
                                                    var arr_data = $.parseJSON(response);
                                                    var arr_1 = arr_data;
                                                    if(arr_data.length == 0){
                                                       div.innerText = "Aucun résultat";
                                                    }else{
                                                        localStorage.setItem('array',response);
                                                        div.innerText = arr_1[i];
                                                }
                                                })
                                                }

                                    

    if($('#next_button').length == 0 && $('#previous_button').length == 0){
        var next = document.createElement("button");
        var previous = document.createElement("button");   
        var p_next = document.createElement("p")
        var p_previous = document.createElement("p")                             
                             
        div_next.appendChild(next);
        div_next.appendChild(previous);
        next.appendChild(p_next);
        previous.appendChild(p_previous);
        p_next.innerHTML = "Next";
        p_previous.innerHTML ="Previous";
        next.setAttribute("id","next_button");
        previous.setAttribute("id","previous_button");
        previous.setAttribute("id", "previous_button");
        
        
           next.style.borderRadius = "2rem";
           next.style.backgroundColor = "blueviolet"
           next.style.color = "white";
           next.style.width = "7rem";
           next.style.height = "2rem";

           previous.style.borderRadius = "2rem";
           previous.style.backgroundColor = "blueviolet"
           previous.style.color = "white";
           previous.style.width = "7rem";
           previous.style.height = "2rem";
    }


    $("#next_button").on("click",function(){
        var item = localStorage.getItem('array');
        var table = $.parseJSON(item);
        if(i < table.length -1){
            i++;
            div.innerHTML = table[i];
        }
    })

    $("#previous_button").on("click", function(){
        if(i > 0){
            i--;
        var item = localStorage.getItem('array');
        var table = $.parseJSON(item);
        div.innerHTML = table [i];
        }
    })
})
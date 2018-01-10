$(document).ready(function(){

$("span[id]").click(function () {
    alert("coucou");
});
    //pour pouvoir utiliser regex
    $.validator.addMethod("regex", function (value, element, regexpr) {
        return regexpr.test(value);
    }, "Format non valide.");
    
    $("#form_auth").validate({
        rules: {
            email: "required",
            password: {
                required: true,
                minlength: 6                
            }
        },
        submitHandler: function (form) {
        $.ajax({
            url: './admin/lib/php/ajax/post_authentification.php',
            type: 'POST',
            data: $(form).serialize(),
            success: function (data) {
                if(data === "1"){
                    location.reload();
                } else{
                    $("#auth_denied").empty().html("<br>Accès refusé !");
                }
                
                //$("#compte").load(location.href + " #compte"); // refresh uniquement la zone 
                //$("#ModalLoginForm").modal('toggle'); 
            },
            error: function () {
                alert('failed');
            }
        });
    }
    });
    
    $("#form_ins").validate({
        rules: {
            nom: "required",
            prenom: "required",
            pw1: {
                required: true,
                minlength: 6
            },
            pw2: {
                required: true,
                equalTo: "#pw1"
            },
            email:"required",
            
            numero: {
               number: true,
               required: true
            },
            adresse: "required",
            cp: {
                number: true,
                required: true,
                min: 1000,
                max: 9999
            },
            localite: "required"
            
        },
        submitHandler: function (form) {
            $.ajax({
                url: './admin/lib/php/ajax/post_inscription.php',
                type: 'POST',
                data: $(form).serialize(),
                success: function (data) {
                    if(data === "1"){
                        location.reload();
                    } else {
                        $('#recap_inscription').append("Erreur lors de l'inscription");
                        $('#modal_inscription').modal();
                    }
                },
                error: function () {
                    alert('failed');
                }
            });
        }
    });
});
$(document).ready(function($) {
    $.extend($.validator.messages, {
        required: "Ce champ est obligatoire.",
        email: "email invalide.",
        url: "Veuillez renseigner une URL valide.",
        date: "Veuillez renseigner une date valide.",
        number: "Veuillez ne renseigner que des chiffres",
        digits: "Veuillez ne renseigner que des chiffres",
        equalTo: "Les valeurs doivent être identiques",
        maxlength: $.validator.format("Saisissez {0} caract&egrave;res maximum."),
        minlength: $.validator.format("Saisissez au minimum {0} caract&egrave;res"),
        rangelength: $.validator.format("Entr&eacute;e entre {0} and {1} caract&egrave;res."),
        range: $.validator.format("Entrez une valeur entre {0} et {1}."),
        max: $.validator.format("Valeur maximum : {0}."),
        min: $.validator.format("Valeur minimum : {0}.")
    });
});
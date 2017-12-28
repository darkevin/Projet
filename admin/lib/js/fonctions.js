$(document).ready(function () {
    
    $(".player").css( "display", "none" );
    $("#barre_rechercher").hide();
    $("#rechercher_off").click(function () {
        $("#barre_menu").hide();
        $("#barre_rechercher").show();
        $("#input_rechercher").focus();
    });

    $("#rechercher_on").click(function () {
        $("#barre_menu").show();
        $("#barre_rechercher").hide();
        $("#input_rechercher").val("");
        $("#browsers").remove();

    });

    $(".start_2d").mouseover(function () {
        var a = $(this).parent().attr("id");
        $.post('./admin/lib/php/single.php', {input: a}, function (data) {
            $("#div_modal").empty().append(data);
        });
    });

    $(".start_2d").click(function (e) {
        e.preventDefault();
        $("#exampleModal").modal();        
    });
    
    $(".start_3d").click(function(e){
        e.preventDefault();
        var id = $(this).parent().attr("id");
        $(".player-"+id).css( "display", "block" );
        $(this).find('i').toggleClass('fa-pause fa-play');
        
        $("#3d_"+id).show();
        
        $("#3d_"+id).rotate({
            imageDir:'images/montres/'+id,
            imageCount:72,
            imageExt:'jpg',
            canvasID:'montre_'+id,
            canvasWidth:400,
            canvasHeight:400,
            autoRotate:false
        });
        
        var x = $(".card").width();
        if(x<300){
            $('canvas').css( { width :(x-40)+'px', height:(x-40)+'px' });
        } else {
            $('canvas').css( { width :'300px', height:'300px' });
        }
        $("#2d_"+id).hide();
    });
    
    $(".stop_3d").click(function(e){
        e.preventDefault();
        
        var id = $(this).parent().parent().attr("id");
        $("#"+id).hide();
        id = id.replace("3d", "2d");
        $("#"+id).show();
        id = id.replace("2d_", "");
        $(".player-"+id).css( "display", "none" );
        
    });
    
    //JS pour la barre rechercher
    $("#input_rechercher").keyup(function (e) {
        var code = e.which;
        var recherche = $("#input_rechercher").val();
        if (code === 13) {
            alert('Votre recherche = ' + recherche);
        }
        if (code === 27) {
            $("#barre_menu").show();
            $("#barre_rechercher").hide();
            $("#input_rechercher").val("");
            $("#browsers").remove();
        }
        $.post('./admin/lib/php/rechercher.php', {input: recherche}, function (data) {
            $("#feedback").html(data);
        });

    });
    
    $("#temp").click(function(){
        $('#recap_inscription').append("hello");
        $('#modal_inscription').modal();
    });
    
    $(".auth").click(function(e){
        e.preventDefault();
        $("#ModalLoginForm").modal(); 
    });
    
    $(".order").click(function(e){
        $.ajax({
            url:'./admin/lib/php/post_recap_commande.php',
            type:'POST',
            dataType: 'json'
        }).done(function (data) {
            $("#NUMCOMMANDE").empty().append(data["num"]);
            $("#MONTANT").empty().append(data["montant"]);
            $("#ModalOrder").modal();
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });
    
    $(".detail_commande").click(function (e){
        e.preventDefault();
        var num = $(this).attr("data-num");
        $.ajax({
            url:'./admin/lib/php/post_detail_commande.php',
            type:'POST',
            data: ({numfact: num})
        }).done(function (data) {
            $("#recap_commande").hide();
            $("#detail_commande").empty().append(data);
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });
    
    $("").click(function (e){
        e.preventDefault();
        var num = $(this).attr("data-num");
        $.ajax({
            url:'./admin/lib/php/post_variable.php',
            type:'POST',
            data: ({numfact: num})
        }).done(function () {
            window.location.href = "admin/lib/php/script_pdf2.php";
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });
    
    //pour que JS fonctionne sur du html ajouté par ajax
    $(document).on("click", ".pdf_commande", function(e) {
        e.preventDefault();
        var num = $(this).attr("data-num");
        if (e.shiftKey) var mode = 1;
        else var mode = 2;
        $.ajax({
            url:'./admin/lib/php/post_variable.php',
            type:'POST',
            data: ({numfact : num, mode : mode})
        }).done(function () {
            window.location.href = "admin/lib/php/script_pdf2.php";
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });
    
    $("#ModalLoginForm").on('shown.bs.modal', function() {
        $("#auth_email").focus();
    });
    
    
    $("#deco").click(function(e){
        e.preventDefault();
        $.post({
            url:'./admin/lib/php/post_deconnexion.php',
            type:'POST',
            success: function () {
                window.location.href = "index.php";
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest);
                alert(textStatus);
                alert(errorThrown);
            }
        });
    });

$("#panier").click(function(){
    $.ajax({
        url:'./admin/lib/php/post_aff_panier.php',
        type:'POST'
    }).done(function (data) {
        $("#liste_panier").empty().append(data);
        
        
    }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
        alert(XMLHttpRequest);
        alert(textStatus);
        alert(errorThrown);
    });
});

$(".trash")
    .on('mouseover', function () {
        $(".trash").css({
            cursor : 'pointer'
        });
    })
    .on('click', function () {
        var n = $(this).attr("id");
        $.ajax({
            url:'./admin/lib/php/post_del_item.php',
            type:'POST',
            data: ({num_ligne: n})
        }).done(function (data) {
            location.reload();
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });

$(".add_panier")
    .on('mouseover', function () {
        $(".add_panier").css({
            cursor : 'pointer'
        });
    })
    .on('mouseout', function () {
    
    })
    .on('click', function () {
        var img_print = $(this).parent().attr("id");
        $.ajax({
            url:'./admin/lib/php/post_panier.php',
            type:'POST',
            data: ({img_print: img_print})
        }).done(function (data) {
            var arr = data.split('&&');
            $("#notif_panier").find(".modal-title").empty().append(arr[0]);
            $("#notif_panier").find(".modal-body").empty().append(arr[1]);
            $("#notif_panier").modal(); 
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });
    
//    $("#generate_pdf").click(function(){
//        $.ajax({
//            url:'./admin/lib/php/script_pdf.php',
//            type:'POST'
//        }).done(function (data) {
//            alert(data);
//            window.location.href = './admin/'+data;
//        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
//            alert(XMLHttpRequest);
//            alert(textStatus);
//            alert(errorThrown);
//        });
//    });
    
    $(".changer_qte").change(function (e){
        var id = $(this).attr("id");
        var i = id.substring(1);
        var val = $("#"+id).find("option:selected").attr("value");
        //alert(id);
        $.ajax({
            type:'POST',
            data: ({indice: i, valeur : val}),
            dataType: 'json',
            url:'./admin/lib/php/changer_qte.php'
        }).done(function (data) {
            $("#total_panier").empty().append(data["total"]);
            $("#subtotal_"+i).empty().append(data["subtotal"]);
//            data["total"]
//            data["subtotal"]
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });
    
    $( window ).resize(function() {
        var x = $(".card").width();
        if(x<300){
            $('canvas').css( { width :(x-40)+'px', height:(x-40)+'px' });
        } else {
            $('canvas').css( { width :'300px', height:'300px' });
        }  
    });
    
    $("#myDIV").on('mousewheel', '.owl-stage', function (e) {
    alert("ok");
    e.preventDefault();
});
});


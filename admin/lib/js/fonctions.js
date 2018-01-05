$(document).ready(function () {
    
    $("#fermerModalSearch").click(function(e){
        $('#ModalSearch .close').click();
    });
    $(".player").css( "display", "none" );
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
    
    
    $("#temp").click(function(){
        $('#recap_inscription').append("hello");
        $('#modal_inscription').modal();
    });
    
    $(".auth").click(function(e){
        e.preventDefault();
        $("#ModalLoginForm").modal(); 
    });

    $("#rechercher").click(function(e){
        e.preventDefault();
        $("#ModalSearch").modal(); 
    });
    
    
    $(".order").click(function(e){
        e.preventDefault();
        $.ajax({
            url:'./admin/lib/php/ajax/post_recap_commande.php',
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
    
    $('#ModalOrder').on('hidden.bs.modal', function () {
        location.reload();
    });
    
    $(".detail_commande").click(function (e){
        e.preventDefault();
        var num = $(this).attr("data-num");
        $.ajax({
            url:'./admin/lib/php/ajax/post_detail_commande.php',
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
            url:'./admin/lib/php/ajax/post_variable.php',
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
            url:'./admin/lib/php/ajax/post_variable.php',
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
            url:'./admin/lib/php/ajax/post_deconnexion.php',
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
        url:'./admin/lib/php/ajax/post_aff_panier.php',
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
            url:'./admin/lib/php/ajax/post_del_item.php',
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
            url:'./admin/lib/php/ajax/post_panier.php',
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
    
    $(".changer_qte2").click(function(){
        $(".changer_qte2").blur();
    });
    $(".changer_qte2").change(function (e){
        
        $(".changer_qte2").blur();
        var id = $(this).attr("id");
        var val = $("#"+id).val();
        $.ajax({
            type:'POST',
            data: ({indice: id, valeur : val}),
            dataType: 'json',
            url:'./admin/lib/php/ajax/changer_qte.php'
        }).done(function (data) {
            $("#total_panier").empty().append(data["total"]);
            $("#subtotal_"+id).empty().append(data["subtotal"]);
//            data["total"]
//            data["subtotal"]
        }).fail(function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
        
    });
    
    $(".changer_qte").change(function (e){
        var id = $(this).attr("id");
        var i = id.substring(1);
        var val = $("#"+id).find("option:selected").attr("value");
        //alert(id);
        $.ajax({
            type:'POST',
            data: ({indice: i, valeur : val}),
            dataType: 'json',
            url:'./admin/lib/php/ajax/changer_qte.php'
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
    
    $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $("#msg_upload").empty().html('Fichier "' + fileName +  '" selectionné !');
    });
});
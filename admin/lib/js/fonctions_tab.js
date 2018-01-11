$(document).ready(function () {
    $('#example').dataTable({
        "language": {
            "sSearch": "Effectuer une recherche :",
            "sInfo": "_TOTAL_ résultats à afficher (_START_ à _END_)",
            "sInfoFiltered": " - provenant de _MAX_ résultats",
            "lengthMenu": "Afficher _MENU_ résultats par page",
            "zeroRecords":"Aucun résultat pour cette recherche",
            "infoEmpty":  "0 résultat",
            "oPaginate": {
                "sNext": "Page suivante",
                "sPrevious": "Page précédente"
            }
        },
        "aoColumns": [
            null,
            null,
            null,
            null,
            {"orderable": false},
            {"orderable": false}
    ]});
    $(document).on("change", ".changer_stock", function(e) {
        $(".changer_stock").blur();
        var id = $(this).attr("id");
        var val = $("#" + id).val();
        $.ajax({
            type: 'POST',
            data: ({id: id, valeur: val}),
            url: 'lib/php/ajax/changer_stock.php'
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });
    $(document).on("change", ".changer_dispo", function(e) {
        var id = $(this).attr("data-num");
        var val = $(this).find("option:selected").attr("value");
        $.ajax({
            type: 'POST',
            data: ({id: id, dispo: val}),
            url: 'lib/php/ajax/changer_dispo.php'
        }).done(function () {
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest);
            alert(textStatus);
            alert(errorThrown);
        });
    });
    $('input[type="file"]').change(function(e){
            var fileName = e.target.files[0].name;
            $("#msg_upload").empty().html('Fichier "' + fileName +  '" selectionné !');
    });
});


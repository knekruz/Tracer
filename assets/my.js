

$("#supports").DataTable({
    dom: 'l<"clear">frtiBp',
    buttons: {
        buttons: [
            {
            extend: "collection",
            text: "Exporter",
            buttons: [ 'print', 'csv', 'excel' ],
            },
        ],
    },
   /*  buttons: 
    {
        name: 'primary',
        buttons: [ 'print', 'csv', 'excel', 'pdf' ],
    }, */
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    }
});

$("#encours").DataTable({
    dom: 'l<"clear">frtiBp',
    buttons: {
        buttons: [
            {
            extend: "collection",
            text: "Exporter",
            buttons: [ 'print', 'csv', 'excel' ],
            },
        ],
    },
   /*  buttons: 
    {
        name: 'primary',
        buttons: [ 'print', 'csv', 'excel', 'pdf' ],
    }, */
    language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    }
});
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

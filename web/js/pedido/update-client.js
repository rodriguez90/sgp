var handleDataTable = function() {

    if ($('#data-table').length !== 0) {

        var ajax = null;

        var columns = [
            {
                "title": "Nombre",
                "data":"nombre"
            },
            {
                "title": "Código",
                "data":"codigo"
            },
            {
                "title": "Cantidad",
                "data":"cantidad"
            },
            {
                "title": "Proveedor",
                "data":"proveedor"
            },
            {
                "title": "Acciones",
                "data":null
            }
        ];

        var columnDefs = [
            {
                targets: 4,
                data:null,
                render: function ( data, type, full, meta ) {
                    var elementId =  String(full.id);
                    if(type == 'display')
                    {
                        // var ticketClass = full.countContainer == full.countTicket ? 'btn-default':'btn-success';

                        var selectHtml = "<div class=\"row row-fluid\">";
                        selectHtml += "<button data-row=\"" + meta.row +"\" + data-name=\"" + elementId +  "\" class=\"btn btn-danger btn-icon btn-circle btn-xs\" title=\"Eliminar\"><i class=\"fa fa-trash\"></i></button>";
                        selectHtml += "</div>";

                        return selectHtml;
                    }
                    return "-";
                }
            }
        ];

        var  table = $('#data-table').DataTable({
            // dom: '<"top"iflp<"clear">>rt',
            // data:[],
            dom: '<"top"<"clear">>tp',
            // processing:true,
            lengthMenu: [5, 10, 15],
            pageLength: 3,
            language: lan,
            order: [[ 0, 'asc' ]],
            responsive: true,
            deferRender: false,
            // "ajax": ajax,
            columns: columns,
            columnDefs:columnDefs
        });

        $('#data-table').on('click', 'button', function()
        {
            var id = $(this).data('name');
            var row = $(this).data('row');

            $.confirm({
                title: 'Advertencia!',
                content: 'Esta seguro que desea eliminar el medicamento del pedido?',
                buttons: {
                    confirm: {
                        text:'Confirmar',
                        btnClass: 'btn-danger',
                        action: function () {
                            table
                                .row(row)
                                .remove()
                                .draw();

                            $('#btnEmpty').attr("disabled", table.rows().count() === 0);
                            $('#btnSave').attr("disabled", table.rows().count() === 0);
                        }
                    },
                    cancel: {
                        text:'Cancelar'
                    }
                }
            });
        });
    }
};

var init = function(){

    handleDataTable();
    // recuperar los medicamentos del pedido

    $('#btnEmpty').attr("disabled", true);
    $('#btnSave').attr("disabled", true);

    $('#w1').submit(function (event) {
        var params = $('#w1').serializeObject();
        console.log('pedidoDetalles', params);

        var table = $('#data-table').DataTable();

        params['PedidoForm[pedidoDetalles]'] = [];

        if(table
            .rows()
            .count()  == 0) {

            $.alert({
                title: 'Advertencia!',
                content: 'Debe seleccionar los medicamentos del pedido.',
                buttons: {
                    confirm: {
                        text:'Aceptar',
                        btnClass: 'btn-info',
                    },
                }
            });

            return false;
        }

        var detalles = [];
        table
            .rows()
            .data()
            .each( function ( value, index ) {
                detalles.push(value);

            });

        $('#pedidoform-pedidodetalles').val(JSON.stringify(detalles));

        console.log('pedidoDetalles', detalles);

        return true;
    });

    $.ajax({
        // async:false,
        url: homeUrl + "pedido/detalles",
        type: "get",
        dataType: "json",
        data: {id: pedidoId} ,
//                            contentType: "application/json; charset=utf-8",
        beforeSend:function () {

        },
        success: function (response) {

            if(response.success)
            {
                var table = $('#data-table').DataTable();
                table.rows.add(response.data).draw();
            }
            else
            {
                $.alert(
                    {
                        title:'Advertencia!',
                        content:response.msg,
                        buttons: {
                            confirm: {
                                text:'Aceptar',
                            }
                        }
                    }
                );
            }
        },
        error: function(data) {
            $.alert(
                {
                    title:'Advertencia!',
                    content:'Ah ocurrido un error al recuperar los medicamentos del pedido.',
                    buttons: {
                        confirm: {
                            text:'Aceptar',
                        }
                    }
                }
            );
        },
    });
};

var agregarMedicamento = function(medicamentoId) {
    var cantidad = parseInt($('#product-quantity-' + medicamentoId).val());
    console.log('medicamento', medicamentoId);
    console.log('cantidad', cantidad);

    var table = $('#data-table').DataTable();

    var row  = table.row(function (idx, data, node) {
        return parseInt(data.id) === parseInt(medicamentoId)
    });

    if(row.length > 0)
    {
        var medicamentoData = table.row(row).data();
        cantidad += parseInt(medicamentoData.cantidad);
    }

    $.ajax({
        // async:false,
        url: homeUrl + "medicamento/stock",
        type: "get",
        dataType: "json",
        data: {id: medicamentoId, cantidad: cantidad} ,
//                            contentType: "application/json; charset=utf-8",
        beforeSend:function () {

        },
        success: function (response) {

            if(response.success)
            {
                var medicamento = response.data;


                var row  = table.row(function (idx, data, node) {
                    return parseInt(data.id) === parseInt(medicamentoId)

                });

                if(row.length > 0)
                {
                    table.row(row).data(medicamento).draw();
                    console.log('medicamentoData', medicamentoData);

                }
                else {
                    table.row.add(medicamento).draw();
                }

                $('#btnEmpty').attr("disabled", table.rows().count() === 0);
                $('#btnSave').attr("disabled", table.rows().count() === 0);
            }
            else
            {
                $.alert(
                    {
                        title:'Advertencia!',
                        content:response.msg,
                        buttons: {
                            confirm: {
                                text:'Aceptar',
                            }
                        }
                    }
                );
            }
        },
        error: function(data) {
            $.alert(
                {
                    title:'Advertencia!',
                    content:'Ah ocurrido un error al añadir el medicamento al pedido.',
                    buttons: {
                        confirm: {
                            text:'Aceptar',
                        }
                    }
                }
            );
        },
    });

    return false;
}

var limpiarPedido = function() {

    $.confirm({
        title: 'Advertencia!',
        content: 'Esta seguro que desea limpiar el pedido?',
        buttons: {
            confirm: {
                text:'Confirmar',
                btnClass: 'btn-danger',
                action: function () {
                    var table = $('#data-table').DataTable();
                    table.clear().draw();

                    $('#btnEmpty').attr("disabled", true);
                    $('#btnSave').attr("disabled", true);
                }
            },
            cancel: {
                text:'Cancelar'
            }
        }
    });

    return false;
}

$(document).ready(function () {
    init();
});
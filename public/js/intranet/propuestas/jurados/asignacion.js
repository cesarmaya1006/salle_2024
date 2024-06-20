$(document).ready(function () {
    $(".jurado_check").change(function() {
        if(this.checked) {
            valor= 1;
        }else{
            valor= 0;
        }
        const url_t = $(this).attr('data_url');
        var data = {
            "valor": valor,
            _token: $('input[name=_token]').val(),
        };
        $.ajax({
            url: url_t,
            type: 'POST',
            data: data,
            success: function(respuesta) {
                if (respuesta.mensaje == "ok") {
                    Sistema.notificaciones('Jurado asignado a la propuesta correctamente', 'Sistema', 'success');
                } else {
                    Sistema.notificaciones('Jurado desasociadoa a la propuesta correctamente', 'Sistema', 'warning');
                }
            },
            error: function() {

            }
        });
    });
});

function asignacion(url,id) {
    const valor= 1;
    const url_t = url;
    const id_tr = id;
    var data = {
        "valor": valor,
        _token: $('input[name=_token]').val(),
    };
    $.ajax({
        url: url_t,
        type: 'POST',
        data: data,
        success: function(respuesta) {
            if (respuesta.mensaje == "ok") {
                $('#tr_'+id_tr).remove();
                Sistema.notificaciones('El equipo fue asignado correctamente', 'Sistema', 'success');
            } else {
                Sistema.notificaciones('El equipo no pudo ser eliminado, hay recursos usandolo', 'Sistema', 'error');
            }
        },
        error: function() {

        }
    });
}
function des_asignacion(url,id) {
    const valor= 0;
    const url_t = url;
    const id_tr = id;
    var data = {
        "valor": valor,
        _token: $('input[name=_token]').val(),
    };
    $.ajax({
        url: url_t,
        type: 'POST',
        data: data,
        success: function(respuesta) {
            if (respuesta.mensaje == "ok") {
                Sistema.notificaciones('El equipo fue asignado correctamente', 'Sistema', 'success');
            } else {
                $('#tr_'+id_tr).remove();
                Sistema.notificaciones('Se quito la asignación del equipo correctamente', 'Sistema', 'success');
            }
        },
        error: function() {

        }
    });
}

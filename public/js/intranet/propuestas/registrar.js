$(document).ready(function () {
    $('#boton_registrar').click(function(e){
        e.preventDefault();
        //-------------------------------------------------------
        //validate fields
        var fail = false;
        var fail_log = "";
        var name;
        $("#form_propuesta_guardar").find("select, input, textarea").each(function () {
            if ($(this).prop("required")) {
                if (!$(this).val()) {
                    fail = true;
                    name = $(this).attr("data_nombre");
                    fail_log += '<p style="text-align: justify">El campo ' + name + ' es requerido</p>';
                }else{
                    $(this).prop("required",false);
                }
            }
        });
        //do your stuff.
        if (fail) {
            console.log("rechazado");
            Swal.fire({
                icon: "error",
                title: "Campos Requeridos",
                html: fail_log,
            });
            return false;
        }else{
            Swal.fire({
                title: "Esta Seguro de registrar esta propuesta?",
                html: "Una vez registrada su propuesta, no se podrá realizar ningún tipo de ajuste o deshacer la información que se suministró.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, registrar!",
                cancelButtonText: "Cancelar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('enviado')
                    $('#form_propuesta_guardar').submit();

                }
            });
        }



    });

    /*
    $("#form_propuesta_guardar").submit(function (e) {
        e.preventDefault();
        //-------------------------------------------------------
        //validate fields
        var fail = false;
        var fail_log = "";
        var name;
        $("#form_propuesta_guardar").find("select, input,textarea").each(function () {
            if ($(this).prop("required")) {
                if (!$(this).val()) {
                    fail = true;
                    name = $(this).attr("id");
                    fail_log += "<p>El campo " + name + " es requerido</p>";
                }
            }
        });

        //submit if fail never got set to true
        if (fail) {

            console.log("rechazado");
            Swal.fire({
                icon: "error",
                title: "Campos Requeridos",
                html: fail_log,
            });
            return false;
        } else {
            const form = $(this);
            Swal.fire({
                title: "Esta Seguro de registrar esta propuesta?",
                html: "Una vez registrada su propuesta, no se podrá realizar ningún tipo de ajuste o deshacer la información que se suministró.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, registrar!",
                cancelButtonText: "Cancelar!",
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('enviado')
                    enviarFormulario(form);

                } else {
                    console.log("no enviado");
                }
            });
        }
        //-------------------------------------------------------
    });

    function enviarFormulario(form) {
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            success: function (respuesta) {
                console.log(respuesta);
            },
            error: function () {},
        });
    }
        */
       //********************** */
    /*
    //----------------------------------------------------
    $("#boton_registrar_").on("click", function (e) {
        e.preventDefault();
        //-------------------------------------------------------
        //validate fields
        var fail = false;
        var fail_log = "";
        var name;
        $("#form_propuesta_guardar").find("select, input").each(function () {
            if (!$(this).prop("required")) {
            } else {
                if (!$(this).val()) {
                    fail = true;
                    name = $(this).attr("id");
                    fail_log += '<p>El campo '+  name + " es requerido</p>";
                }
            }
        });

        $("#form_propuesta_guardar").find("textarea").each(function () {
            if (!$(this).prop("required")) {
            } else {
                if (!$(this).val()) {
                    fail = true;
                    name = $(this).attr("data_name");
                    fail_log += '<p>El campo '+  name + " es requerido</p>";
                }
            }
        });


            name = $(this).attr("id");
        //submit if fail never got set to true
        if (!fail) {
            //process form here.
        } else {
            //alert(fail_log);
            Swal.fire({
                icon: "error",
                title: "Campos Requeridos",
                html: fail_log
              });
            return false;
        }
        //-------------------------------------------------------
        //var form = $('#form_propuesta_guardar');
        //console.log(form)
        Swal.fire({
            title: "Esta Seguro de registrar esta propuesta?",
            html: "Una vez registrada su propuesta, no se podrá realizar ningún tipo de ajuste o deshacer la información que se suministró.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, registrar!",
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.isConfirmed) {
                $('form#form_propuesta_guardar').submit();
            }
        });
    });
    //------------------------------------------------------
    //submit registrar
    $("#form_propuesta_guardar").submit(function(e) {
        e.preventDefault();
        //-------------------------------------------------------
        //-------------------------------------------------------
        //validate fields
        var fail = false;
        var fail_log = "";
        var name;
        $("#form_propuesta_guardar").find("select, input").each(function () {
            if (!$(this).prop("required")) {
            } else {
                if (!$(this).val()) {
                    fail = true;
                    name = $(this).attr("id");
                    fail_log += '<p>El campo '+  name + " es requerido</p>";
                }
            }
        });

        $("#form_propuesta_guardar").find("textarea").each(function () {
            if (!$(this).prop("required")) {
            } else {
                if (!$(this).val()) {
                    fail = true;
                    name = $(this).attr("data_name");
                    fail_log += '<p>El campo '+  name + " es requerido</p>";
                }
            }
        });


            name = $(this).attr("id");
        //submit if fail never got set to true
        if (!fail) {
            //process form here.
        } else {
            //alert(fail_log);
            Swal.fire({
                icon: "error",
                title: "Campos Requeridos",
                html: fail_log
              });
            return false;
        }
        //-------------------------------------------------------
        //-------------------------------------------------------
        //var form = $('#form_propuesta_guardar');
        //console.log(form)
        const form = $(this);
        Swal.fire({
            title: "Esta Seguro de registrar esta propuesta?",
            html: "Una vez registrada su propuesta, no se podrá realizar ningún tipo de ajuste o deshacer la información que se suministró.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, registrar!",
            cancelButtonText: "Cancelar!",
        }).then((result) => {
            if (result.isConfirmed) {
                ajaxRequest_form(form);
            }
        });


    });
    function ajaxRequest_form(form){
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            success: function (respuesta) {
                if (respuesta.mensaje == "ok") {
                    form.parents("tr").remove();
                    Sistema.notificaciones(
                        "El registro fue eliminado correctamente",
                        "Sistema",
                        "success"
                    );
                } else {
                    Sistema.notificaciones(
                        "El registro no pudo ser eliminado, hay recursos usandolo",
                        "Sistema",
                        "error"
                    );
                }
            },
            error: function () {},
        });
    }*/
    //------------------------------------------------------
    // Cajas PDF
    $(".caja_pdf").addClass("d-none");
    $(".agregar_pdf").click(function () {
        const sub_componente = $(this).attr("data_comp");
        $(".caja_ini_pdf_gen" + sub_componente)
            .clone()
            .appendTo("#cajas_pdfs" + sub_componente);
        $(".caja_ini_pdf_gen" + sub_componente).addClass(
            "caja_show_pdf" + sub_componente
        );
        $(".caja_ini_pdf_gen" + sub_componente + ":first").removeClass(
            "caja_show_pdf" + sub_componente
        );
        $(".caja_show_pdf" + sub_componente).removeClass(
            "caja_ini_pdf_gen" + sub_componente
        );
        $(".caja_show_pdf" + sub_componente).removeClass("d-none");

        var cajas = $("#cajas_pdfs" + sub_componente).find(
            ".caja_show_pdf" + sub_componente
        );
        var cont = 0;
        cajas.each(function () {
            cont++;
            $(this).attr("id", "caja_pdf_" + sub_componente + "_" + cont);
            $(this)
                .find("label")
                .attr("for", "pdf_" + sub_componente);
            $(this)
                .find("label")
                .html("Archivo " + cont);
            $(this)
                .find("input")
                .attr("id", "pdf_" + sub_componente + "_" + cont);
        });
    });
    //------------------------------------------------------
    //cajas Imagenes
    $(".caja_imagen").addClass("d-none");

    $(".agregar_imagen").click(function () {
        const sub_componente = $(this).attr("data_comp");
        $(".caja_ini_imagen_gen" + sub_componente)
            .clone()
            .appendTo("#cajas_imagenes" + sub_componente);
        $(".caja_ini_imagen_gen" + sub_componente).addClass(
            "caja_show_imagen" + sub_componente
        );
        $(".caja_ini_imagen_gen" + sub_componente + ":first").removeClass(
            "caja_show_imagen" + sub_componente
        );
        $(".caja_show_imagen" + sub_componente).removeClass(
            "caja_ini_imagen_gen" + sub_componente
        );
        $(".caja_show_imagen" + sub_componente).removeClass("d-none");

        var cajas = $("#cajas_imagenes" + sub_componente).find(
            ".caja_show_imagen" + sub_componente
        );
        var cont = 0;
        cajas.each(function () {
            cont++;
            $(this).attr("id", "caja_imagen_" + sub_componente + "_" + cont);
            $(this)
                .find("label")
                .attr("for", "imagen_" + sub_componente);
            $(this)
                .find("label")
                .html("Archivo " + cont);
            $(this)
                .find("input")
                .attr("id", "imagen_" + sub_componente + "_" + cont);
        });
    });
    $("#descripcion").keyup(function () {
        var thought = jQuery("textarea#descripcion").val();
        var words = thought.split(" ");
        cantPalabras = words.length;
        var stringFinal = "";
        if (cantPalabras > 30) {
            control = 0;
            $.each(words, function (index, item) {
                control++;
                if (control <= 29) {
                    stringFinal += item + " ";
                }
                if (control == 30) {
                    stringFinal += item;
                }
            });
            //-------------------
            let timerInterval;
            Swal.fire({
                title: "Mas de 30 palabras!",
                html: "En la descripción no puede incluir mas de 30 palabras. <br/> Espera <b></b> milisegundos.",
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                    const b = Swal.getHtmlContainer().querySelector("b");
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft();
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                },
            }).then((result) => {
                $("textarea#descripcion").val(stringFinal);
            });
            //-------------------
        }
    });
});

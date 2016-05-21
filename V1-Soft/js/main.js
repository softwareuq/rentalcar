$(document).on("ready", function () {

    $(".crearUsuario").on("submit", function (e) {
        e.preventDefault();
        $.post($(this).attr("action"), $(this).serialize(), function (data) {
            $(".resultados-crear-usuario").html(data);
        });

    });

    $(".busquedaUsuarios").on("submit", function (e) {
        e.preventDefault();
    });

    $(".buscar-usuario").on("click", function (e) {
        e.preventDefault();
        var bus = $("#idBuscarUsuario").val();
        $.get($(".busquedaUsuarios").attr("action"), {id: bus}, function (data) {
            if (data == "") {
                $(".resultados-buscar-usuario").html("<span class='label label-danger'>**No se han encontrado resultados**</span>");
            } else {
                $(".resultados-buscar-usuario").html(data);
            }
        });

    });

    $(".actualizarUsuario").on("submit", function (e) {
        e.preventDefault();
        $.post($(this).attr("action"), $(this).serialize(), function (data) {
            $(".resultados-actualizar-usuario").html(data);
        });

    });

    $(".eliminarUsuario").on("submit", function (e) {
        e.preventDefault();
        $.post($(this).attr("action"), $(this).serialize(), function (data) {
            $(".resultados-eliminar-usuario").html(data);
        });

    });
    
});



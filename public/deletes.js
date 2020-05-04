// # EN ESTE ARCHIVO JS VAN TODAS LAS FUNCIONES AJAX PARA ELIMINAR 
// ADEMAS DE MOSTRAR EN FRON-END LA RESPUESTA DEL SERVIDOR

function eliminarCompetidor() {
    var numeroCompetidor = $('#_numeroCompetidor').val();
    var token = $('#tokenAsignar').val();
    
    $.ajax({
        type: "delete",
        url: url+"/home/competidores/"+numeroCompetidor,
        headers: {'X-CSRF-TOKEN':token},
        data: {},
        dataType: "json",
        success: function (response) {
            switch(response['codigo']){
                case "eliminado":
                    getDanger(response['mensaje']);
                    $('#exampleModal').modal('hide');
                    competidores();
                break;
            }
        }
    });
}
// # EN ESTE ARCHIVO JS VAN TODAS LAS FUNCIONES AJAX PARA HACER UPDATES EN LA BASE DE DATOS 
// ADEMAS DE MOSTRAR EN FRON-END LA RESPUESTA DEL SERVIDOR

function updateCompetidor() {
    var numeroCompetidor = $('#_numeroCompetidor').val();
    var token = $('#tokenAsignar').val();
    
    $.ajax({
        type: "post",
        url: url+"/home/competidores/"+numeroCompetidor,
        headers: {'X-CSRF-TOKEN':token},
        data: {numeroCompetidor: numeroCompetidor},
        dataType: "json",
        success: function (response) 
        {
            switch(response['codigo'])
            {
                case "update":
                    getSuccess(response['mensaje']);
                break;

                default:
                    getDanger(response['mensaje']);
                break;
            }
        }
    });
}
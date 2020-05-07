// # EN ESTE ARCHIVO JS VAN TODAS LAS FUNCIONES AJAX PARA ELIMINAR 
// ADEMAS DE MOSTRAR EN FRON-END LA RESPUESTA DEL SERVIDOR

// <--------------------------- FUNCION PARA ELIMINAR COMPETIDOR ---------------------------->
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
                    getSuccess(response['mensaje']);
                    $('#exampleModal').modal('hide');
                    competidores();
                break;
            }
        }
    });
}
// <----------------------------------------------------------------------------------------->

// <--------------------------- FUNCION PARA QUITAR UN ENTRENADOR --------------------------->

function quitarEntrenador()
{
  var numeroCompetidor = $('#numeroCompetidor').val();
  var idEntrenador = $('#idEntrenador').val();
  var idCompetencia = $('#idCompetencia').val();
  var token = $('#token').val();

   $.ajax({
      url: url+'/home/competidores/quitarEntrenador',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'json',
      data:{numeroCompetidor: numeroCompetidor, idCompetencia: idCompetencia, 
              idEntrenador: idEntrenador},

      success:function(response)
      {
        getSuccess(response['mensaje']);
        $('#modalQuitarEntrenador').modal('hide');
        setTimeout(
          function() {
            getStatR();
           $('#modalQuitarEntrenador').modal('hide');
          },300
        );
      }

  });
}

// <----------------------------------------------------------------------------------------->

function eliminarUsuario() {
  $.ajax({
      type: "delete",
      headers: {'X-CSRF-TOKEN':$('#token').val()},
      url: url+"/home/usuarios/"+$('#idUsuario').val(),
      data: {},
      dataType: "json",
      success: function (response) {
          switch(response['codigo']){
              case "eliminado":
                  getSuccess(response['mensaje']);
                  $('#modalDeleteUser').modal('hide');
                  setTimeout(
                    function() {
                      usuarios();
                     $('#modalDeleteUser').modal('hide');
                    },300
                  );
              break;

              case "root":
                  getDanger(response['mensaje']);
                  $('#modalDeleteUser').modal('hide');
                  setTimeout(
                    function() {
                      usuarios();
                     $('#modalDeleteUser').modal('hide');
                    },300
                  );
              break;
          }
      }
  });
}
// # EN ESTE ARCHIVO JS VAN TODAS LAS FUNCIONES AJAX PARA ENVIAR DATOS A SERVIDOR Y LOS GUARDE 
  // ADEMAS DE MOSTRAR EN FRON-END LA RESPUESTA DEL SERVIDOR


// <------------------------------------- Funcion para Enviar Formulario USUARIO ------------------------------------>
function enviarUsuario()
{

  var name = $('#name').val();
  var email = $('#email').val();
  var password = $('#password').val();
  var password_confirm = $('#password-confirm').val();
  var tipoUsuario = $('#tipoUsuario').val();

  var token = $('#token').val();

  $.ajax({
    url: url+'/home/usuarios',
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    dataType: 'json',
    data:{name: name, email: email, password: password, passwordConfirm: password_confirm,idtipoUsuario: tipoUsuario},

    success:function(response)
    {
      console.log(response);
      switch(response['mensaje'])
      {
        case "creado":
          getSuccess("El Usuario fue creado correctamente!!!");
          newUser();
        break;

        case "duplicado":
          getDanger("ERROR, El Email: '"+response['email']+"'' ya esta Registrado");
          document.getElementById('email').focus();
        break;

        case "noUsuario":
          getDanger("Dedes elegir un tipo de Usuario!!!");
          document.getElementById('tipoUsuario').focus();
        break;

        case "passwordNoCoincide":
          getDanger("Las contraseñas no coinciden, por favor vuelva a confirmar la contraseña");
          $('#password-confirm').val('');
          document.getElementById('password-confirm').focus();
        break;

        default:
          getDanger("ERROR al crear el Nuevo Usuario :(");
        break;
      }
    }
  });
}
// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <------------------------------------- Funcion para Enviar Formulario COMPETIDOR ------------------------------------>
function enviarCompetidor()
{

  var nombre = $('#nombre').val();
  var apellidoPaterno = $('#apellidoPaterno').val();
  var apellidoMaterno = $('#apellidoMaterno').val();
  var numeroCompetidor = $('#numeroCompetidor').val();
  var competencia = $('#competencia').val();
  var entrenador = $('#entrenador').val();
  var tiempoEntrenamiento = $('#tiempoEntrenamiento').val();

  var token = $('#token').val();

  $.ajax({
    url: url+'/home/competidores',
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    dataType: 'json',
    data:{nombre: nombre, apellidoPaterno: apellidoPaterno, apellidoMaterno: apellidoMaterno, 
          numeroCompetidor: numeroCompetidor, competencia: competencia, entrenador:entrenador, tiempoEntrenamiento, tiempoEntrenamiento},

    success:function(response)
    {
      switch(response['codigo'])
      {
        case "creado":
            getSuccess(response['mensaje']);
            newComp();
        break;

        case "creadoSinEntrenador":
            getWarning(response['mensaje']);
            newComp();
        break;

        case "creadoSolo":
            getWarning(response['mensaje']);
            newComp();
        break;

        case "duplicado":;
            getDanger(response['mensaje']);
        break;

        case "numCero":
            getDanger(response['mensaje']);
        break;

        case "soloEntrenador":
          getDanger(response['mensaje']);
        break;

        default:
            getDanger(response['mensaje']);
            newComp();
        break;
      }
    }
  });
}
// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <----------------------------------------- FUNCION PARA ENVIAR ASIGNACION DE COMPETENCIA ------------------------------------------------------->

function asignarCompetencia()
{
  var numeroCompetidor = $('#_numeroCompetidor').val();
  var competencia = $('#asignarCompetencia').val();
  var entrenador = $('#asignarEntrenador').val();
  var mesesEntrenamiento = $('#mesesEntrenamiento').val();

  var token = $('#tokenAsignar').val();

   $.ajax({
    url: url+'/home/competidores/asignarCompetencia',
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    dataType: 'json',
    data:{numeroCompetidor: numeroCompetidor, competencia: competencia, entrenador: entrenador, mesesEntrenamiento: mesesEntrenamiento},
    
    success:function(response)
    {
      switch(response['codigo'])
      {
        case "creado":
            getSuccess(response['mensaje']);
            $('#modalAsignarCompe').modal('hide');
            setTimeout(
              function() {
                getCompR();
               $('#modalAsignarCompe').modal('hide');
              },300
            );
        break;

        case "creadoSinEntrenador":
            getWarning(response['mensaje']);
            $('#modalAsignarCompe').modal('hide');
            setTimeout(
              function() {
                getCompR();
               $('#modalAsignarCompe').modal('hide');
              },300
            );
        break;

        case "duplicadoFaltaEntrenador":
            document.getElementById('miAlert').className = "alert alert-danger mb-0 mt-4";
            $('#miAlert').fadeOut();
            $('#miAlert').html(response['mensaje']);
            $('#miAlert').fadeIn(200);
        break;

        case "duplicado":
            document.getElementById('miAlert').className = "alert alert-danger mb-0 mt-4";
            $('#miAlert').fadeOut();
            $('#miAlert').html(response['mensaje']);
            $('#miAlert').fadeIn(200);
        break;

        default:
            document.getElementById('miAlert').className = "alert alert-danger mb-0 mt-4";
            $('#miAlert').fadeOut();
            $('#miAlert').html(response['mensaje']);
            $('#miAlert').fadeIn(200);
        break;
      }
    }

    });
}
// <----------------------------------------------------------------------------------------------------------------------------------------------->

// <---------------------------------- PARA ENVIAR PUNTAJE DE UNA CARRERA ------------------------------------------------------------------------->

function enviarPuntajeCarrera()
{
  var numeroCompetidor = $('#numeroCompetidor').val();
  var idCarrera = $('#idCarrera').val();
  var puntaje = $('#puntajeCarrera').val();
  var lugarLlegada = $('#lugarLlegadaCarrera').val();
  var token = $('#token').val();

   $.ajax({
      url: url+'/home/competidores/asignarPuntajeCarrera',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'json',
      data:{numeroCompetidor: numeroCompetidor, idCarrera: idCarrera, puntaje: puntaje, 
        lugarLlegada: lugarLlegada, idEstatus: statusCarrera},

      success:function(response)
      {
        getSuccess(response['mensaje']);
        
        $('#modalCarrera').modal('hide');
        setTimeout(
          function() {
            getStatR();
           $('#modalCarrera').modal('hide');
          },300
        );
      }

  });
}
// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <--------------------------------------- ASIGNAR ENTRENADOR A UNA COMPETENCIA DE UN COMPETIDOR ----------------------------------------->

function asignarEntrenador()
{
  var numeroCompetidor = $('#numeroCompetidor').val();
  var idEntrenador = $('#asignarEntrenador').val();
  var idCompetencia = $('#idCompetencia').val();
  var mesesEntrenamiento = $('#mesesEntrenamiento').val();
  var token = $('#token').val();

   $.ajax({
      url: url+'/home/competidores/asignarEntrenador',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'json',
      data:{numeroCompetidor: numeroCompetidor, idCompetencia: idCompetencia, 
              idEntrenador: idEntrenador, mesesEntrenamiento: mesesEntrenamiento},

      success:function(response)
      {
        getSuccess(response['mensaje']);
        $('#modalEntrenador').modal('hide');
        setTimeout(
          function() {
            getStatR();
           $('#modalEntrenador').modal('hide');
          },300
        );
      }

  });
}

// <----------------------------------------------------------------------------------------------------------------------------------------------->

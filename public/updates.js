// # EN ESTE ARCHIVO JS VAN TODAS LAS FUNCIONES AJAX PARA HACER UPDATES EN LA BASE DE DATOS 
// ADEMAS DE MOSTRAR EN FRON-END LA RESPUESTA DEL SERVIDOR

// <-------------------------------------------------- UPDATE COMPETIDOR ----------------------------------------------------------------------------->
function updateCompetidor() 
{
    var numeroCompetidor = $('#_numeroCompetidor').val();  
    var nombre = $('#nombre').val();
    var apellidoPaterno = $('#apellidoPaterno').val();
    var apellidoMaterno = $('#apellidoMaterno').val();
    var token = $('#tokenAsignar').val();

    
    $.ajax({
        type: "post",
        url: url+"/home/competidores/update",
        headers: {'X-CSRF-TOKEN':token},
        data: {numeroCompetidor: numeroCompetidor, nombre: nombre, apellidoPaterno: apellidoPaterno, 
        	apellidoMaterno: apellidoMaterno},
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
// <----------------------------------------------------------------------------------------------------------------------------------------------->


//-------------------------------------------------         UPDATE USUARIO       ----------------------------------------------------------------------------
function editarUsuario(){
    $.ajax({
        type: "PUT",
        headers: {'X-CSRF-TOKEN':$('#token').val()},
        url: url+"/home/usuarios/"+$('#idUsuario').val(),
        data: {
                name: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                passwordConfirm: $('#password-confirm').val(),
                idtipoUsuario: $('#tipoUsuario').val()
              },
        dataType: "json",
        success: function (response) {
            switch(response['codigo'])
            {
                case "updated":
                    getSuccess(response['mensaje']);
                    usuarios();
                break;

                case "correoOcupado":
                    getDanger(response['mensaje']);
                    document.getElementById('email').focus();
                break;

                case "noCoincidePassword":
                    getDanger(response['mensaje']);
                    $('#password-confirm').val('');
                    document.getElementById('password-confirm').focus();
                break;

                default:
                    getDanger(response['mensaje']);
                break;
            }
        }
    });
    return false;
}
// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <--------------------------------------- UPDATE ENTRENADOR ------------------------------------------------------------------------------------->

function updateEntrenador()
{
    $.ajax({
        type: "PUT",
        headers: {'X-CSRF-TOKEN':$('#token').val()},
        url: url+'/home/entrenadores/'+$('#idEntrenador').val(),
        data: {
            nombre: $('#nombre').val(),
            apellidoPaterno: $('#apellidoPaterno').val(), 
            apellidoMaterno: $('#apellidoMaterno').val(), 
            patrocinio: $('#patrocinio').val()
        },
        dataType: "json",
        success: function (response) {
            getSuccess(response['mensaje']);
            getEntreR();
        }
    });
}

// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <--------------------------------------- UPDATE ENTRENADOR ------------------------------------------------------------------------------------->

function updateCompetencia()
{
    var idCompetencia = $('#idCompetencia').val();
    var nombreCompetencia = $('#nuevaCompetencia').val();
    var periodo = $('#periodoCompetencia').val();

    alert("Editar: "+idCompetencia+" : "+nombreCompetencia+" : "+periodo);

  $('#modalEditCompetencia').modal('hide');
      setTimeout(
        function() {
          getTourR();
        $('#modalEditCompetencia').modal('hide');
        },300
   );
}

// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <--------------------------------------- UPDATE CARRERA ------------------------------------------------------------------------------------->

function updateCarrera()
{
  var idCompetencia = $('#idCompetencia').val();
  var nombreCarrera = $('#nombreCarrera').val();
  var tipoCarrera = $('#tipoCarrera').val();
  var descripcion = $('#descripcionCarrera').val();


  //Guardamos
  alert("Update: "+idCompetencia+" : "+nombreCarrera+" : "+tipoCarrera+" : "+descripcion);



  $('#modalEditCarrera').modal('hide');
  setTimeout(
    function() {
      getCarreraR();
     $('#modalEditCarrera').modal('hide');
    },300
  );
}

// <----------------------------------------------------------------------------------------------------------------------------------------------->

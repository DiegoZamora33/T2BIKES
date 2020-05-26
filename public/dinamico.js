
// # EN ESTE ARCHIVO JS VAN TODAS LAS FUNCIONES AJAX PARA MOSTRAR CONTENIDO DE FORMA DINAMICA SIN RECARGAR LA PAGINA
  // ADEMAS DE CONTENER FUNCIONES PARA MANEJO DE ALERTS, GRAFICAS, Y DEMAS COSAS VISUALES.

// Variables Globales
var graficaCompetidor = "bar";
var graficaCompetencia = "bar";
var graficaCarrera = "bar";
var ip = 'localhost';
var url = ' ';
var statusCarrera = 5;
var estaCompetencia = 0;



$(document).ready(function ()
{
  // <-------------------------- PARA SIEMPRE RECORDAR LA URL Y FUNCIONE AJAX ------------------------------>
    ip = document.getElementById('miIP').value;
    url = 'http://'+ip+'/T2BIKES/public';

    // Funcion para el menu
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
	$('#lateral').toggleClass('active');
    });

    // Funcion para Mostar Lista de Competidores
    $('#competidores').click(function ()
    {
      miOff();
      this.className = "active active mt-2 mb-1";
        $.ajax({
              type: "get",
              url: url+"/home/competidores",
              data: {},
              dataType: "html",
              success: function (response) {
                  $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
              }
        });
      });

    // Para Mostrar lista de Entrenadores
    $("#entrenadores").click(function()
    {
      miOff();
      this.className = "active active mt-2 mb-1";
      $.ajax({
              type: "get",
              url: url+"/home/entrenadores",
              data: {},
              dataType: "html",
              success: function (response) {
                  $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
              }
        });
   });

    // Para Mostrar lista de Competencias
    $("#portaCompetencias").click(function()
    {
      miOff();
      this.className = "active  mt-2 mb-1";
      $.ajax({
              type: "get",
              url: url+"/home/competencias",
              data: {},
              dataType: "html",
              success: function (response) {
                  $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
              }
        });
    });

        // Para Mostrar lista de Competencias



    // Para mostrar lista de Usuarios
    $('#sistema').click(function () {

        miOff();
        this.className = "active active mt-2 mb-1";


        $.ajax({
            type: "get",
            url: url+"/home/usuarios",
            data: {},
            dataType: "html",
            success: function (response)
            {
                $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
            }
        });
    });

    // Funcion para mostrar  Form de Nuevo Entrenador
    $("#registrar-entrenador").click(function()
    {
      miOff();
      this.className = "active active mt-2 mb-1";
        $.ajax({
          url: "forms/registrar-entrenador.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
                effectFadeOut();
                effectFadeIn();
            }
          );
        }
        });
    });
});

function miOff()
{
  if(document.getElementById('home'))
  {
    document.getElementById('home').className = " ";
  }

  if(document.getElementById('competidores'))
  {
    document.getElementById('competidores').className = " ";
  }

  if(document.getElementById('entrenadores'))
  {
    document.getElementById('entrenadores').className = " ";
  }

  if(document.getElementById('portaCompetencias'))
  {
    document.getElementById('portaCompetencias').className = " ";
  }

  if(document.getElementById('sistema'))
  {
    document.getElementById('sistema').className = " ";
  }

}


/*------------Funciones genericas------------*/

// <-------------------- Funcion para Efecto FadeIn --------------------->
function effectFadeOut()
{
    //$('#mostrador').fadeOut(300);
    document.getElementById('mostrador').style = "display: none;";
}

function effectFadeIn()
{
    $('#mostrador').fadeIn(300);
}
// <--------------------------------------------------------------------->


// <------------------------- FUNCION PARA TOGLGLE ESTADISTICA/CARRERA (COMPETENCIA) ----------------------------->

function miToggle()
{
  if($('#toggle-trigger').prop('checked') == false)
  {
    document.getElementById('miEstadistica').style = "display: none;";
    document.getElementById('listaCarreras').style = "display: none;";
     $('#listaCarreras').fadeIn(800);
  }
  else
  {
    document.getElementById('listaCarreras').style = "display: none;";
    document.getElementById('miEstadistica').style = "display: none;";
    $('#miEstadistica').fadeIn(800);
  }
}

function plus()
{
  if($('#g').val() != 0)
  {
    if(parseInt($('#g').val()) + parseInt(1) <=  document.getElementById('g').max)
       document.getElementById('g').value = parseInt($('#g').val()) + parseInt(1);

    actualizaListaCarrera(document.getElementById('g'));
  }
}

function less()
{

  if($('#g').val() != 0)
  {
    if(parseInt($('#g').val()) - parseInt(1) >=  document.getElementById('g').min)
       document.getElementById('g').value = parseInt($('#g').val()) - parseInt(1);


    actualizaListaCarrera(document.getElementById('g'));
  }
}

// <-------------------------------------------------------------------------------------------------------------->


// <--------------------------- Funciones ALERT --------------------------->
function getSuccess(miMensaje)
{
  $.notify({
      // options
      message: miMensaje
  },{
      // settings
      type: 'success',
    placement: {
          from: "bottom",
          align: "right"
      }
  });
}

function getWarning(miMensaje)
{
  $.notify({
      // options
      message: miMensaje
  },{
      // settings
      type: 'warning',
    placement: {
          from: "bottom",
          align: "right"
      }
  });
}

function getDanger(miMensaje)
{
  $.notify({
      // options
      message: miMensaje
  },{
      // settings
      type: 'danger',
    placement: {
          from: "bottom",
          align: "right"
      }
  });
}

function getInfo(miMensaje)
{
  $.notify({
      // options
      message: miMensaje
  },{
      // settings
      type: 'info',
    placement: {
          from: "bottom",
          align: "right"
      }
  });
}
// <--------------------------------------------------------------------->

// <---------------- FUNCIONES PARA SABER CUAL COMPETENCIA VAMOS A QUITAR -------------------->

function quitaEstaCompe(miCompetencia)
{
  estaCompetencia = miCompetencia.id;
}

// <-------------------------------------------------------------------------------------------------------------------->

// <---------------- FUNCIONES PARA MOSTRAR LA INFO DE UNA CARRERA DE ESTADISTICA COMPETIDOR EN EL MODAL --------------->

function clickStatus(boton)
{
  switch(boton.id)
  {
    case "pendiente":
      statusCarrera = 5;
    break;

    case "siTermino":
      statusCarrera = 3;
    break;

    case "noTermino":
      statusCarrera = 4;
    break;
  }

  miFocus(boton);

}


function miFocus(miBoton)
{
  var misBotones = document.getElementById('contenedorStatus').children;
  miBoton.style = "transform: scale(1.15);";
  miBoton.classList.add('active');

  for (var i = 0; i < misBotones.length; i++)
  {
    if(misBotones[i].id != miBoton.id)
    {
      misBotones[i].style = "transform: scale(1);";
      misBotones[i].classList.remove('active');
    }
  }

}


function dataCarrera(idCarrera)
{
  var numeroCompetidor = $('#numeroCompetidor').val();
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/competidores/datosPuntajeCarrera',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'json',
      data:{numeroCompetidor: numeroCompetidor, idCarrera: idCarrera},

      success:function(response)
      {
        document.getElementById('puntajeCarrera').value = response['puntaje'];
        document.getElementById('lugarLlegadaCarrera').value = response['lugar'];
        document.getElementById('idCarrera').value = response['idCarrera'];
        statusCarrera = response['status'];
      }

  });
}

// <---------------------------------------------------------------------------------------------------------------------->



// <---------------- FUNCION PARA MOSTRAR LA INFO DE UNA CARRERA COMPETIDOR EN EL MODAL (COMPETENCIAS) ------------------->

function dataCarreraCompetencia(miNumeroCompetidor)
{
  var idCompetencia = $('#idCompetencia').val();
  var idCarrera = $('#idCarrera').val();
  var numeroCompetidor = miNumeroCompetidor;

  var token = $('#token').val();

  $.ajax({
      url: url+'/home/carreras/datosPuntajeCarrera',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'json',
      data:{numeroCompetidor: numeroCompetidor, idCarrera: idCarrera, idCompetencia: idCompetencia},

      success:function(response)
      {
        document.getElementById('puntajeCarrera').value = response['puntaje'];
        document.getElementById('lugarLlegadaCarrera').value = response['lugar'];
        document.getElementById('numeroCompetidor').value = response['numeroCompetidor'];
        statusCarrera = response['status'];
      }

  });
}

// <---------------------------------------------------------------------------------------------------------------------->



// <-------------------------- FUNCIONES PARA MOSTRAR UNA ESTADISTICA ---------------------------------------------------->
function getStat(miStat)
{
  var idCompetencia = miStat.id;
  var numeroCompetidor = $('#_numeroCompetidor').val();
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/competidores/estadistica',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{numeroCompetidor: numeroCompetidor, idCompetencia: idCompetencia},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

  });
}

function getStatR()
{
  var idCompetencia = $('#idCompetencia').val();
  var numeroCompetidor = $('#numeroCompetidor').val();
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/competidores/estadistica',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{numeroCompetidor: numeroCompetidor, idCompetencia: idCompetencia},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

  });
}

// <------------------------------------------------------------------------------------------>

// <------------------------------ PARA REGRESAR A VER LOS COMPETIDORES ---------------------->
function competidores(){
    $.ajax({
        type: "get",
        url: url+"/home/competidores",
        data: {},
        dataType: "html",
        success: function (response) {
            $('#mostrador').html(response);
          effectFadeOut();
          effectFadeIn();
        }
  });
}
// <------------------------------------------------------------------------------------------>


// <------------------------------ PARA REGRESAR A VER LOS ENTRENADORES ---------------------->
function entrenadores(){
        $.ajax({
        type: "get",
        url: url+"/home/entrenadores",
        data: {},
        dataType: "html",
        success: function (response) {
            $('#mostrador').html(response);
          effectFadeOut();
          effectFadeIn();
        }
  });
}
// <------------------------------------------------------------------------------------------>

function competencias()
{
  $.ajax({
        type: "get",
        url: url+"/home/competencias",
        data: {},
        dataType: "text",
        success: function (response) {
            $('#mostrador').html(response);
          effectFadeOut();
          effectFadeIn();
        }
  });
}

function usuarios(){

        this.className = "active active mt-2 mb-1";
        $.ajax({
            type: "get",
            url: url+"/home/usuarios",
            data: {},
            dataType: "html",
            success: function (response) {
                $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
            }
        });
}

// <-------------------------- Funcion Para Mostrar PERFIL COMPETIDOR ------------------------------>
function getComp(miCompetidor)
{

  var numeroCompetidor = miCompetidor.id;
  var token = miCompetidor.children[0].value;

  $.ajax({
      url: url+'/home/competidores/perfilCompetidor',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{numeroCompetidor: numeroCompetidor},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

  });

}

function getCompR()
{

  var numeroCompetidor = $('#_numeroCompetidor').val();
  var token = $('#tokenAsignar').val();

  $.ajax({
      url: url+'/home/competidores/perfilCompetidor',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{numeroCompetidor: numeroCompetidor},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

  });

}
// <------------------------------------------------------------------------------------------------>

// <---------------------- PARA MOSTRAR EL PERFIL DE UN ENTRENADOR --------------------------------->
function getEntre(miEntrenador)
{
  var idEntrenador = miEntrenador.id;
  var token = miEntrenador.children[0].value;

  $.ajax({
      url: url+'/home/entrenadores/perfilEntrenador',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idEntrenador: idEntrenador},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

  });
}

function getEntreR()
{
  var idEntrenador = $('#idEntrenador').val();
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/entrenadores/perfilEntrenador',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idEntrenador: idEntrenador},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

  });
}
// <------------------------------------------------------------------------------------------------>


// <--------------------------------- PARA MOTRAR EL PERFIL DE COMPETENCIA ---------------------------------->

function getTour(miCompetencia)
{
  var idCompetencia = miCompetencia.id;
  var token = $('#tokenG').val();

  $.ajax({
      url: url+'/home/competencias/perfilCompetencia',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia},

      success:function(response)
      {
        $('#mostrador').html(response);
        $('#toggle-trigger').bootstrapToggle('on');
                effectFadeOut();
                effectFadeIn();
      }

  });
}


function getTourR()
{
  var idCompetencia = $('#idCompetencia').val();
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/competencias/perfilCompetencia',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia},

      success:function(response)
      {
        $('#mostrador').html(response);
        $('#toggle-trigger').bootstrapToggle('on');
                effectFadeOut();
                effectFadeIn();

      }

  });
}

// <--------------------------------------------------------------------------------------------------------->

// <------------------ Mostrar Perfil de un Usuario ------------------->
function getUser(miUser)
{

  var user = miUser.id;
  var token = miUser.children[0].value;

  $.ajax({
      url: url+'/home/usuarios/perfilUsuario',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{user: user},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

    });

}
// <-------------------------------------------------------------------->

// <-------------------------------- FUNCIONES PARA MOSTRAR CARRERA DE UNA COMPETENCIA ---------------------------------->
function getCarrera(miCarrera)
{
  var idCompetencia = $('#idCompetencia').val();
  var idCarrera = miCarrera.id;
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/carreras/perfilCarrera',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia, idCarrera: idCarrera},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

    });
}

function getCarreraR()
{
  var idCompetencia = $('#idCompetencia').val();
  var idCarrera = $('#idCarrera').val();
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/carreras/perfilCarrera',
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia, idCarrera: idCarrera},

      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

    });
}
// <------------------------------------------------------------------------------------------------------------------->


// <------------------ Funcion para mostrar FORM de Nuevo Competidor ------------------->
function newComp(){
  this.className = 'active active mt-2 mb-1';

 $.ajax({
        type: "get",
        url: url+"/home/competidores/create",
        data: {},
        dataType: "html",
        success: function (response) {
            $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
        }
    });
}
// <----------------------------------------------------------------------------------->


// <----------------- FUNCION PARA EDOTAR LOS DATOS DE UN COMPETIDOR ------------------>
function editComp()
{
  var numeroCompetidor = $('#_numeroCompetidor').val();

  $.ajax({
        type: "get",
        url: url+"/home/competidores/"+numeroCompetidor+"/edit",
        dataType: "html",

    success: function(data)
    {
      $('#mostrador').html(data);
              effectFadeOut();
              effectFadeIn();
    }
  });
}
// <----------------------------------------------------------------------------------->


// <------------------ FUNCION PARA MOSTRAR FORM EDITAR ENTRENADOR -------------------->
function editEntre(){

  var idEntrenador = $('#idEntrenador').val();

  $.ajax({
        type: "get",
        url: url+"/home/entrenadores/"+idEntrenador+"/edit",
        dataType: "html",

    success: function(data)
    {
      $('#mostrador').html(data);
              effectFadeOut();
              effectFadeIn();
    }
  });

}
// <----------------------------------------------------------------------------------->

// <------------------ FUNCION PARA MOSTRAR FORM DE NUEVO ENTRENADOR ------------------>
function newTrain()
{
  this.className = 'active';

  $.ajax({
     type: "get",
        url: url+"/home/entrenadores/create",
        data: {},
        dataType: "html",
        success: function (response) {
            $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
        }
  });
}
// <------------------------------------------------------------------------------------>

// Funcion para mostrar FORM de Nuevo Usuario.
function newUser()
{
    this.className = "active";

    $.ajax({
        type: "get",
        url: url+"/home/usuarios/create",
        data: {},
        dataType: "html",
        success: function (response) {
            $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
        }
    });
}



function newCompet(){
  this.className = 'active';
  $.ajax({
    url: 'forms/registrar-competencia.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}


/*------------Funciones Para Graficas ------------*/

// Funcion Para convertir Grafica (Competidor Competencia)
function grafCompetidor()
{
  var numeroCompetidor = $('#numeroCompetidor').val();
  var token = $('#token').val();
  var idCompetencia = $('#idCompetencia').val();

  if(graficaCompetidor == "bar")
  {
    graficaCompetidor = "pie";

    $.ajax({
      url: url+'/home/graficas/competidor_competencia_pai' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{numeroCompetidor: numeroCompetidor, idCompetencia: idCompetencia},

      success: function(data){
        setTimeout(function(){
          $('#contenedorGrafica-competidor').html(data);
        }
      );
    }
    });

    document.getElementById('btn-cambiarGrafica-competidor').innerText = "Cambiar a Grafica de Barras";
  }
  else
  {
    graficaCompetidor = "bar";

    $.ajax({
      url: url+'/home/graficas/competidor_competencia_bar' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{numeroCompetidor: numeroCompetidor, idCompetencia: idCompetencia},

      success: function(data){
        setTimeout(function(){
          $('#contenedorGrafica-competidor').html(data);
        }
      );
    }
    });

    document.getElementById('btn-cambiarGrafica-competidor').innerText = "Cambiar a Grafica de Pastel";
  }
  $('html,body').animate({scrollTop: document.body.scrollHeight},"fast");
}



// Funcion Para convertir Grafica (Competencia)
function grafCompetencia()
{

  var idCompetencia = $('#idCompetencia').val();
  var totalMostrar = $('#miQuant').val();

  var token = $('#token').val();

  if(graficaCompetencia == "bar")
  {
    graficaCompetencia = "pie";
    $.ajax({
      url: url+'/home/graficas/competencia_pai' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia, totalMostrar: totalMostrar},
      success: function(data){
        setTimeout(function(){
          $('#contenedorGrafica-competencia').html(data);
        }
      );
    }
    });
    document.getElementById('btn-cambiarGrafica-competencia').innerText = "Cambiar a Grafica de Barras";
  }
  else
  {
    graficaCompetencia = "bar";
    $.ajax({
      url: url+'/home/graficas/competencia_bar' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia, totalMostrar: totalMostrar},
      success: function(data){
        setTimeout(function(){
          $('#contenedorGrafica-competencia').html(data);
        }
      );
    }
    });
    document.getElementById('btn-cambiarGrafica-competencia').innerText = "Cambiar a Grafica de Pastel";
  }
}




// Funcion Para convertir Grafica (Carrera)
function grafCarrera()
{

  var idCarrera = $('#idCarrera').val();
  var idCompetencia = $('#idCompetencia').val();
  var totalMostrar = $('#g').val();

  var token = $('#token').val();

  if(graficaCarrera == "bar")
  {
    graficaCarrera = "pie";
    $.ajax({
      url: url+'/home/graficas/carrera_pai' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia, idCarrera: idCarrera, totalMostrar: totalMostrar},
      success: function(data){
        setTimeout(function(){
          $('#contenedorGrafica-carrera').html(data);
        }
      );
    }
    });
    document.getElementById('btn-cambiarGrafica-carrera').innerText = "Cambiar a Grafica de Barras";
  }
  else
  {
    graficaCarrera = "bar";
    $.ajax({
      url: url+'/home/graficas/carrera_bar' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia, idCarrera: idCarrera, totalMostrar: totalMostrar},
      success: function(data){
        setTimeout(function(){
          $('#contenedorGrafica-carrera').html(data);
        }
      );
    }
    });
    document.getElementById('btn-cambiarGrafica-carrera').innerText = "Cambiar a Grafica de Pastel";
  }
  $('html,body').animate({scrollTop: document.body.scrollHeight},"fast");
}



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
    data:{name: name, email: email, password: password, idtipoUsuario: tipoUsuario},

    success:function(response)
    {
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
    data:{competencia: competencia, entrenador: entrenador, mesesEntrenamiento: mesesEntrenamiento},

    success:function(response)
    {
      switch(response['codigo'])
      {
        case "creado":
            getSuccess(response['mensaje']);
        break;

        case "creadoSinEntrenador":
            getWarning(response['mensaje']);
        break;

        case "duplicadoFaltaEntrenador":
            getDanger(response['mensaje']);
        break;

        case "duplicado":;
            getDanger(response['mensaje']);
        break;

        default:
            getDanger(response['mensaje']);
        break;
      }
    }

    });
}
// <----------------------------------------------------------------------------------------------------------------------------------------------->




// <------------------------------------------------ FUNCION DE BUSQUEDA --------------------------------------------------------->

function buscar()
{
  var busqueda = $('#busqueda').val();
  var token = $('#tokenG').val();


  $.ajax({
      url: url+'/home/busqueda/buscar' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      data:{busqueda: busqueda},
      dataType: 'html',
      success:function(response)
      {
        $('#mostrador').html(response);
                effectFadeOut();
                effectFadeIn();
      }

  });



}

// <----------------------------------------------------------------------------------------------------------------------------------------------->



// <------------------------------------- PARA CAMBIAR EL NUMERO DE COMPETIDORES A MOSTAR (COMPETENCIA) -------------------------------------------------------------->

function actualizaLista(miNumero)
{
  var idCompetencia = $('#idCompetencia').val();
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/competencias/statDinamic' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia, numero: miNumero.value},
      success: function(data){
        setTimeout(function(){
          $('#contenedorEstadistica').html(data);
          document.getElementById('contenedorEstadistica').style = "display: none;";
           $('#contenedorEstadistica').fadeIn(800);

        }
      );
    }
    });
}

// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <------------------------------------- PARA CAMBIAR EL NUMERO DE COMPETIDORES A MOSTAR (CARRERA) -------------------------------------------------------------->

function actualizaListaCarrera(miNumero)
{
  var idCompetencia = $('#idCompetencia').val();
  var idCarrera = $('#idCarrera').val();
  var token = $('#token').val();

  $.ajax({
      url: url+'/home/carreras/statDinamic' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia, idCarrera: idCarrera, numero: miNumero.value},
      success: function(data){
        setTimeout(function(){
          $('#contenedorEstadistica').html(data);
          document.getElementById('contenedorEstadistica').style = "display: none;";
           $('#contenedorEstadistica').fadeIn(800);

        }
      );
    }
    });
}

// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <------------------------------------------- FUNCION PARA MOSTRA MODULO QUITAR AGREGAR ---------------------------------------------------------->

function agregarQuitarCompe()
{
  var idCompetencia = $('#idCompetencia').val();
  var token = $('#token').val();

   $.ajax({
      url: url+'/home/competencias/agregarQuitar' ,
      headers: {'X-CSRF-TOKEN':token},
      type: 'POST',
      dataType: 'html',
      data:{idCompetencia: idCompetencia},
      success: function(data){
        setTimeout(function(){
          $('#mostrador').html(data);
          effectFadeOut();
          effectFadeIn();
        }
      );
    }
    });
}

// <----------------------------------------------------------------------------------------------------------------------------------------------->


// <--------------------------------------------- FUNCION MODULO PARA QUE VAMOAS A QUITAR --------------------------------------------------------->

function quienQuitar()
{

  var idCompetencia = $('#idCompetencia').val();
  var numeroCompetidor = $('#numeroCompetidorDel').val();

  var token = $('#token').val();


  $.ajax({
    url: url+'/home/competencias/quitarCompetidor',
    headers: {'X-CSRF-TOKEN':token},
    type: 'POST',
    dataType: 'json',
    data:{numeroCompetidor: numeroCompetidor, idCompetencia: idCompetencia},
    
    success:function(response)
    {
      switch(response['codigo'])
      {
        case "confirm": 
            document.getElementById('miAlert').className = "alert alert-warning mt-1";
            $('#miAlert').fadeOut();
            $('#miAlert').html(response['mensaje']);
            $('#miAlert').fadeIn(200);
        break;

        default:
            document.getElementById('miAlert').className = "alert alert-danger mt-1";
            $('#miAlert').fadeOut();
            $('#miAlert').html(response['mensaje']);
            $('#miAlert').fadeIn(200);
        break;
      }
    }

    });
}

// <----------------------------------------------------------------------------------------------------------------------------------------------->


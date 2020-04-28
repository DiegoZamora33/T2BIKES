
// Variables Globales
var graficaCompetidor = "bar";
var graficaCompetencia = "bar";
var graficaCarrera = "bar";
const url = 'http://localhost/T2BIKES/public';



$(document).ready(function ()
{
    // Funcion para el menu
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

    // Funcion para Mostar Lista de Competidores
    $('#competidores').click(function (e) { 

      miOff();
      this.className = "active";
          e.preventDefault();
          
          console.log(url+"/home/competidores");
          $.ajax({
              type: "get",
              url: url+"/home/competidores",
              data: {},
              dataType: "html",
              success: function (response) {
                  console.log(response);
                  $('#mostrador').html(response);
              }
        });
      });

    // Cuando damos click en Entrenadores y se ponga blanco el fondo
    $("#entrenadores").click(function()
    {
      miOff();
      this.className = "active";
        $.ajax({
          url: "tables/lista-entrenadores.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
   });


    // Funcion para mostrar  Reportes
    $("#reportes").click(function()
    {
      miOff();
      this.className = "active";
        $.ajax({
          url: "reportes.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            });
          }
        });
      });


    // Funcion para mostrar  Estadisticas
    $("#estadisticas").click(function()
    {
      miOff();
      this.className = "active";
        $.ajax({
          url: "perfil-competidor.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
      });


    $("#competencias").click(function()
    {
      miOff();
      this.className = "active";
      $.ajax({
        url: "tables/lista-competencias.html" ,
        success: function(data){
          setTimeout(function(){
            $("#mostrador").html(data);
          }
        );
      }
      });
    });

    $("#tab").click(function()
    {
      miOff();
      this.className = "active";
      $.ajax({
        url: "perfil-competidor.html" ,
        success: function(data){
          setTimeout(function(){
            $("#mostrador").html(data);
          }
        );
      }
      });
    });



    // Funcion para mostrar lista de Competidores
    $("#lista-competidores").click(function()
    {
      miOff();
      this.className = "active";
        $.ajax({
          url: "tables/lista-competidores.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
      });



    // Funcion para mostrar  Form de Nuevo Competidor
    $("#registrar-competidor").click(function()
    {
      miOff();
      this.className = "active";
        $.ajax({
          url: "forms/registrar-competidor.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
      });



    // Funcion para mostrar lista de Entrenadores
    $("#lista-entrenadores").click(function()
    {
      miOff();
      this.className = "active";
        $.ajax({
          url: "tables/lista-entrenadores.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
      });


      $('#sistema').click(function (e) { 

        miOff();
        this.className = "active";

        e.preventDefault();
        
        console.log(url+"/home/usuarios");
        $.ajax({
            type: "get",
            url: url+"/home/usuarios",
            data: {},
            dataType: "html",
            success: function (response) {
                console.log(response);
                $('#mostrador').html(response);
            }
        });
    });

    // Funcion para mostrar  Form de Nuevo Entrenador
    $("#registrar-entrenador").click(function()
    {
      miOff();
      this.className = "active";
        $.ajax({
          url: "forms/registrar-entrenador.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
      });

});

function miOff()
{
  document.getElementById('home').className = " ";
  document.getElementById('competidores').className = " ";
  document.getElementById('entrenadores').className = " ";
  /*document.getElementById('reportes').className = " ";
  document.getElementById('estadisticas').className = " ";*/
  document.getElementById('competencias').className = " ";
  document.getElementById('sistema').className = " ";
  /*document.getElementById('registrar-competidor').className = " ";
  document.getElementById('lista-competidores').className = " ";
  document.getElementById('registrar-entrenador').className = " ";
  document.getElementById('lista-entrenadores').className = " ";*/
}


/*------------Funciones genericas------------*/
function getStat(){
  this.className = 'active';
  $.ajax({
    url: 'estadisticas.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}

function competidores(){
        $.ajax({
          url: "tables/lista-competidores.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
}


function entrenadores(){
        $.ajax({
          url: "tables/lista-entrenadores.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
}

function competencias(){
        $.ajax({
          url: "tables/lista-competencias.html" ,
          success: function(data){
            setTimeout(function(){
              $("#mostrador").html(data);
            }
          );
        }
        });
}

function usuarios(){
        this.className = "active";

        console.log(url+"/home/usuarios");
        $.ajax({
            type: "get",
            url: url+"/home/usuarios",
            data: {},
            dataType: "html",
            success: function (response) {
                console.log(response);
                $('#mostrador').html(response);
            }
        });
}

function getComp(){
  this.className = 'active';
  $.ajax({
    url: 'perfil-competidor.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}
function getEntre(){
  this.className = 'active';
  $.ajax({
    url: 'perfil-entrenador.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}
function getTour(){
  this.className = 'active';
  $.ajax({
    url: 'tour.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}
function getUser(){
  this.className = 'active';
  $.ajax({
    url: 'perfil-usuario.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}
function getCarrera(){
  this.className = 'active';
  $.ajax({
    url: 'perfil-carrera.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}

function newComp(){
  this.className = 'active';
  $.ajax({
    url: 'forms/registrar-competidor.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}

function editComp(){
  this.className = 'active';
  $.ajax({
    url: 'forms/editar-competidor.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}

function editEntre(){
  this.className = 'active';
  $.ajax({
    url: 'forms/editar-entrenador.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}

function newTrain(){
  this.className = 'active';
  $.ajax({
    url: 'forms/registrar-entrenador.html' ,
    success: function(data){
      setTimeout(function(){
        $('#mostrador').html(data);
      }
    );
  }
  });
}


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
            console.log(response);
            $('#mostrador').html(response);
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
  if(graficaCompetidor == "bar")
  {
    graficaCompetidor = "pie";
    $.ajax({
      url: 'graficas/competidor-competencia-pai.html' ,
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
      url: 'graficas/competidor-competencia-bar.html' ,
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
  if(graficaCompetencia == "bar")
  {
    graficaCompetencia = "pie";
    $.ajax({
      url: 'graficas/competencia-pai.html' ,
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
      url: 'graficas/competencia-bar.html' ,
      success: function(data){
        setTimeout(function(){
          $('#contenedorGrafica-competencia').html(data);
        }
      );
    }
    });
    document.getElementById('btn-cambiarGrafica-competencia').innerText = "Cambiar a Grafica de Pastel";
  }
  $('html,body').animate({scrollTop: document.body.scrollHeight/4},"fast");
}




// Funcion Para convertir Grafica (Carrera)
function grafCarrera()
{
  if(graficaCarrera == "bar")
  {
    graficaCarrera = "pie";
    $.ajax({
      url: 'graficas/carrera-pai.html' ,
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
      url: 'graficas/carrera-bar.html' ,
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




// Funcion intento AJAX
function miAjax(datos)
{
  alert(datos);
}




// Funciones para Enviar Formularios
function enviarUsuario()
{

  var name = $('#name').val();
  var email = $('#email').val();
  var password = $('#password').val();
  var password-confirm = $('#password-confirm').val();
  var tipoUsuario = $('#tipoUsuario').val();

  var token = $('#token').val();

  alert(name+email+password+tipoUsuario);


}
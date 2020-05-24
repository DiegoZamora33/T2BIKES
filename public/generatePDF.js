// # EN ESTE ARCHIVO JS VAN TODAS LAS FUNCIONES PARA GENERAR LOS REPORTES PDF 

// <----------- Generar PDF de una Estadistica de un Competidor PDF a maxima calidad --------------------------->
function compStatPDF() 
{
      // Buscamos toda mi info
        var miCompetidor = $('#miCompetidor').text();
        var miNumeroCompetidor = $('#miNumeroCompetidor').text();
        var miCompetencia = $('#miCompetencia').text();
        var miPuntajeGlobal = $('#miPuntajeGlobal').text();
        var miPeriodoCompetencia  = $('#miPeriodoCompetencia').text();
        var namePDF = "Estadistica-"+miCompetidor.replace('Nombre:', ' ').trim();


        // Vemos cual grafica enta en Pantalla
        if ( document.getElementById( "competidor-grafica-bar" )) 
        {
           var newCanvas = document.querySelector('#competidor-grafica-bar');
        }
        else
        {
           var newCanvas = document.querySelector('#competidor-grafica-pie');
        }

        //Imagen desde la etiqueta canvas
        var newCanvasImg = newCanvas.toDataURL("image/png", 1.0);

        //Crear lienzo PDF
        var doc = new jsPDF('portrait');
        margins = {
          top: 20,
        };

        //Marca de Agua
        //doc = addWaterMark(doc);

        //Añadiendo elementos al PDF
        doc.setFontSize(20);
        doc.setFontStyle("bold");
        doc.text("Estadisticas sobre la competencia", 55, 20);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Numero de Competidor:', 22, 30);

        doc.setFontSize(15);
        doc.setFontStyle("normal");
        doc.text(miNumeroCompetidor.replace('Numero de Competidor:', ' '), 77, 30);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Nombre:', 22, 36);

        doc.setFontSize(15);
        doc.setFontStyle("normal")
        doc.text(miCompetidor.replace('Nombre:', ' '), 42, 36);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Competencia:', 22, 46);

        doc.setFontSize(15);
        doc.setFontStyle("normal")
        doc.text(miCompetencia, 22, 40);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Puntaje Global:', 22, 52);

        doc.setFontSize(15);
        doc.setFontStyle("normal")
        doc.text(miPuntajeGlobal.replace('Puntaje Global:', ' '), 59, 52);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Periodo:', 22, 58);

        doc.setFontSize(15);
        doc.setFontStyle("normal")
        doc.text(miPeriodoCompetencia.replace('Periodo:', ' '), 42, 58);


        // Nos Fijamos si Tiene Entrenador
        if ( document.getElementById( "idEntrenador" )) 
        {
          // Pintamos los Datos el Entrenador
          var miEntrenador = $('#miEntrenador').text();
          var miMesesEntrenamiento = $('#miMesesEntrenamiento').text();
          var miFechaEntrenamiento = $('#miFechaEntrenamiento').text();

          doc.setFontSize(14);
          doc.setFontStyle("bold");
          doc.text('Entrenador:', 22, 68);

          doc.setFontSize(15);
          doc.setFontStyle("normal");
          doc.text(miEntrenador.replace('Entrenador:', ' '), 49, 68);

          doc.setFontSize(14);
          doc.setFontStyle("bold");
          doc.text('Meses:', 22, 74);

          doc.setFontSize(15);
          doc.setFontStyle("normal");
          doc.text(miMesesEntrenamiento.replace('Tiempo de Entrenamiento:', ' '), 38, 74);

          doc.setFontSize(10);
          doc.setFontStyle("normal");
          doc.text(miFechaEntrenamiento.replace('De', '(')+')', 47, 74);
        }
        else
        {
          doc.setFontSize(14);
          doc.setFontStyle("bold");
          doc.text('** No tiene Asignado un Entrenador para esta Competencia **', 22, 68);
        }


        // Metemos la Grafica
        doc.addImage(newCanvasImg, 'PNG', 30, 80, 150, 75 );

        // Metemos la Tabla
        doc.autoTable({ html: '#carrers', margin: {top: 155} }); 

        //Guardar
        doc.save(namePDF);
 }
// <----------------------------------------------------------------------------------------->

// <------------------------- FUNCION PARA PONER MARCA DE AGUA ---------------------------->
function addWaterMark(doc) 
{
  var totalPages = doc.internal.getNumberOfPages();
  var logo = new Image();
  logo.src = 't2bikes/img/logo.png';
  logo.style.opacity = '0.2';
  logo.style.filter  = 'alpha(opacity=20)';


  for (i = 1; i <= totalPages; i++) {
    doc.setPage(i);
    doc.addImage(logo, 'PNG', 50, 100, 115, 115);
    //doc.setTextColor(150);
    //doc.text(50, doc.internal.pageSize.height - 30, 'Watermark');
  }

  return doc;
}
// <----------------------------------------------------------------------------------------->


// <------------------------- FUNCION PARA GENERAR PDF DE PERFIL COMPETIDOR---------------------------->

function compAllPDF(miCompetencia, miPuntajeGlobal, miPeriodo, miEstatus, miEntrenador)
{
  // Buscamos toda mi info
    var miCompetidor = $('#miCompetidor').text();
    var miNumeroCompetidor = $('#miNumeroCompetidor').text();
    var miFechaRegistro =$('#miFechaRegistro').text();

    var namePDF = "Perfil-"+miCompetidor.replace('Nombre:', ' ').trim();

    //Crear lienzo PDF
    var doc = new jsPDF('portrait');


     //Añadiendo elementos al PDF
        doc.setFontSize(20);
        doc.setFontStyle("bold");
        doc.text("Perfil del Competidor", 70, 20);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Numero de Competidor:', 22, 30);

        doc.setFontSize(15);
        doc.setFontStyle("normal");
        doc.text(miNumeroCompetidor, 80, 30);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Nombre:', 22, 36);

        doc.setFontSize(15);
        doc.setFontStyle("normal")
        doc.text(miCompetidor.replace('Nombre:', ' '), 42, 36);

        // Titulo de Competencias
        doc.setFontSize(20);
        doc.setFontStyle("bold");
        doc.text("Competencias", 80, 46);

        if(miCompetencia.length > 0)
        {
            // Comenzamosa pintar mis competencias
            var y=50;

            for (var i = 0; i < miCompetencia.length; i++) 
            {
                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('Competencia:', 22, y);

                doc.setFontSize(15);
                doc.setFontStyle("normal")
                doc.text(miCompetencia[i], 57, y);

                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('Puntaje Global:', 22, y);

                doc.setFontSize(15);
                doc.setFontStyle("normal");
                doc.text(" "+miPuntajeGlobal[i], 60, y);

                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('Periodo:', 22, y);

                doc.setFontSize(15);
                doc.setFontStyle("normal")
                doc.text(miPeriodo[i], 45, y);

                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('Estatus:', 22, y);

                doc.setFontSize(15);
                doc.setFontStyle("normal")
                doc.text(miEstatus[i], 45, y);

                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('Entrenador:', 22, y);

                doc.setFontSize(15);
                doc.setFontStyle("normal")
                doc.text(miEntrenador[i], 53, y);

                y += 4;
            }
        }
        else
        {
          // No tiene Competencias
           doc.setFontSize(14);
            doc.setFontStyle("bold");
            doc.text('** Este Competidor no esta en ninguna competencia **', 22, 56);
        }


    //Guardar
    doc.save(namePDF);
}

// <--------------------------------------------------------------------------------------------------->



// <--------------------------------------------------------------------------------------------------->
function entreAllPDF(miNombre, miCompetencia, miMeses, miPeriodo, miTotal)
{
    // Buscamos toda mi info
    var miEntrenador = $('#miEntrenador').text();
    var miPatrocinio = $('#miPatrocinio').text();
    var miFechaRegistro =$('#miFechaRegistro').text();

    var namePDF = "Perfil-"+miEntrenador.replace('Nombre:', ' ').trim();

    //Crear lienzo PDF
    var doc = new jsPDF('portrait');


     //Añadiendo elementos al PDF
        doc.setFontSize(20);
        doc.setFontStyle("bold");
        doc.text("Perfil del Entrenador", 70, 20);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Nombre:', 22, 30);

        doc.setFontSize(15);
        doc.setFontStyle("normal");
        doc.text(miEntrenador.replace('Nombre:', ' '), 42, 30);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Patrocinadores:', 22, 36);

        doc.setFontSize(12);
        doc.setFontStyle("normal")
        doc.text(miPatrocinio, 25, 42);

        // Titulo de a Quienes Entrena
        doc.setFontSize(20);
        doc.setFontStyle("bold");
        doc.text("Entrena a "+miTotal+" Competidores", 62, 54);

        if(miNombre.length > 0)
        {
            // Comenzamosa pintar mis competencias
            var y=56;

            for (var i = 0; i < miNombre.length; i++) 
            {
                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('Competidor:', 22, y);

                doc.setFontSize(15);
                doc.setFontStyle("normal")
                doc.text(miNombre[i], 52, y);

                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('En la Competencia:', 22, y);

                doc.setFontSize(15);
                doc.setFontStyle("normal");
                doc.text(miCompetencia[i], 70, y);

                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('Durante:', 22, y);

                doc.setFontSize(15);
                doc.setFontStyle("normal")
                doc.text(miMeses[i]+" meses", 45, y);

                y += 6;
                doc.setFontSize(14);
                doc.setFontStyle("bold");
                doc.text('Periodo:', 22, y);

                doc.setFontSize(12);
                doc.setFontStyle("normal")
                doc.text(miPeriodo[i], 45, y);

                y += 4;
            }
        }
        else
        {
          // No tiene Competencias
           doc.setFontSize(14);
            doc.setFontStyle("bold");
            doc.text('** Este Entrenador no entrena a ningun Competidor**', 22, 56);
        }






     //Guardar
    doc.save(namePDF);
}
// <--------------------------------------------------------------------------------------------------->

// <---------------------------------- FUNCION PARA PDF DE COMPETENCIA PERFIL ----------------------------------------------------------------->
function competenciaALLPDF()
{
     // Buscamos toda mi info
    var miCompetencia = $('#nombreCompetencia').text();
    var estatus = $('#estatus').text();
    var miPeriodo =$('#periodo').text();
    var miFechaRegistro =$('#fechaRegistro').text();
    var inscritos =$('#inscritos').text();
    var totalCarreras =$('#totalCarreras').text();

    var namePDF = miCompetencia+" ";

    //Crear lienzo PDF
    var doc = new jsPDF('portrait');


    //Añadiendo elementos al PDF
        doc.setFontSize(20);
        doc.setFontStyle("bold");
        doc.text(miCompetencia, 70, 20);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Estatus:', 22, 30);

        doc.setFontSize(15);
        doc.setFontStyle("normal");
        doc.text(estatus.replace('Estatus:', ' '), 42, 30);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Periodo:', 22, 36);

        doc.setFontSize(12);
        doc.setFontStyle("normal")
        doc.text(miPeriodo.replace('Periodo:', ' '), 45, 36);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Fecha de Registro:', 22, 42);

        doc.setFontSize(12);
        doc.setFontStyle("normal")
        doc.text(miFechaRegistro.replace('Fecha de Registro:', ' '), 68, 42);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Competidores Inscritos:', 22, 48);

        doc.setFontSize(12);
        doc.setFontStyle("normal")
        doc.text(inscritos.replace('Competidores Inscritos:', ' '), 83, 48);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Carreras de la Competencia:', 22, 54);

        doc.setFontSize(12);
        doc.setFontStyle("normal")
        doc.text(totalCarreras.replace('Carreras de la Competencia:', ' '), 95, 54);


        // Vemos cual grafica enta en Pantalla
        if ( document.getElementById( "competencia-grafica-bar" )) 
        {
           var newCanvas = document.querySelector('#competencia-grafica-bar');
        }
        else
        {
           var newCanvas = document.querySelector('#competencia-grafica-pie');
        }

        //Imagen desde la etiqueta canvas
        var newCanvasImg = newCanvas.toDataURL("image/png", 1.0);


        // Metemos la Grafica
        doc.addImage(newCanvasImg, 'PNG', 30, 56, 150, 75 );

        // Metemos la Tabla
        doc.autoTable({ html: '#carrers', margin: {top: 135} });


        //Guardar
         doc.save(namePDF);
}
// <--------------------------------------------------------------------------------------------------------------------------------------------->

// <---------------------------------- FUNCION PARA PDF DE COMPETENCIA PERFIL ----------------------------------------------------------------->
function carreraALLPDF()
{
     // Buscamos toda mi info
    var miCompetencia = $('#nombreCompetencia').text();
    var miCarrera = $('#nombreCarrera').text();
    var miFechaRegistro =$('#fechaRegistro').text();
    var inscritos =$('#inscritos').text();
    var descripcion =$('#descripcion').text();

    var namePDF = miCompetencia+"_"+miCarrera;

    //Crear lienzo PDF
    var doc = new jsPDF('portrait');


    //Añadiendo elementos al PDF
        doc.setFontSize(20);
        doc.setFontStyle("bold");
        doc.text(miCompetencia, 70, 20);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text(miCarrera, 22, 30);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Descripción:', 22, 36);

        doc.setFontSize(12);
        doc.setFontStyle("normal")
        doc.text(descripcion, 58, 36);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Fecha de Registro:', 22, 42);

        doc.setFontSize(12);
        doc.setFontStyle("normal")
        doc.text(miFechaRegistro.replace('Fecha de Registro:', ' '), 68, 42);

        doc.setFontSize(14);
        doc.setFontStyle("bold");
        doc.text('Competidores Inscritos:', 22, 48);

        doc.setFontSize(12);
        doc.setFontStyle("normal")
        doc.text(inscritos.replace('Competidores Inscritos:', ' '), 83, 48);


        // Vemos cual grafica enta en Pantalla
        if ( document.getElementById( "carrera-grafica-bar" )) 
        {
           var newCanvas = document.querySelector('#carrera-grafica-bar');
        }
        else
        {
           var newCanvas = document.querySelector('#carrera-grafica-pie');
        }

        //Imagen desde la etiqueta canvas
        var newCanvasImg = newCanvas.toDataURL("image/png", 1.0);


        // Metemos la Grafica
        doc.addImage(newCanvasImg, 'PNG', 30, 50, 150, 75 );

        // Metemos la Tabla
        doc.autoTable({ html: '#carrers', margin: {top: 129} });


        //Guardar
         doc.save(namePDF);
}
// <--------------------------------------------------------------------------------------------------------------------------------------------->


// # EN ESTE ARCHIVO JS VAN TODAS LAS FUNCIONES PARA GENERAR LOS REPORTES PDF 

//PDF a maxima calidad
function compStatPDF() 
{
// Buscamos toda mi info
        var miCompetidor = $('#miCompetidor').text();
        var miNumeroCompetidor = $('#miNumeroCompetidor').text();
        var miCompetencia = $('#miCompetencia').text();
        var miPuntajeGlobal = $('#miPuntajeGlobal').text();
        var miPeriodoCompetencia  = $('#miPeriodoCompetencia').text();
        var namePDF = miCompetidor.replace('Nombre:', ' ').trim();


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

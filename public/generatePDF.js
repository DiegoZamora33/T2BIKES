//PDF a maxima calidad
function downloadPDF() 
{
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
  //Añadiendo elementos al PDF
	doc.setFontSize(15);
	doc.text("Perfil de competidor: {{ $competidor->nombre }} {{ $competidor->apellidoPaterno }} {{ $competidor->apellidoMaterno }}", 15, 20);
  doc.text("Numero: {{ $competidor->numeroCompetidor }}", 15, 25);
  doc.setFontStyle("bold");
  doc.text("Estadisticas sobre la competencia: {{ $miCompetencia->nombreCompetencia }}", 15, 35);
  doc.setFontStyle("normal");
  doc.setFontSize(10);
  doc.text("Puntaje global: {{ $miCompetencia->puntajeGlobal}}", 15, 45);
  doc.text("Periodo: {{ $miCompetencia->periodo}}", 15, 50);

  doc.autoTable({ html: '#carrers', margin: {top: 60} });

	doc.addImage(newCanvasImg, 'PNG', 25, 85, 160, 80 );
  //Guardar
	doc.save('{{ $competidor->nombre }}.pdf');
 }
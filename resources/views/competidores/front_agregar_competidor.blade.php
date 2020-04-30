<div class="row">

<div class="text-left col-md-2">
  <a onclick="competidores()" type="button" href="#" class="bg-primary border border-primary rounded p-1 superBoton text-left text-success">
  <i class="align-middle fas fa-arrow-left text-white" style="font-size: 24px;"></i>
    <label class="mt-2 text-white d-md-inline" style="cursor: pointer; font-size: 15px;">Atras</label>
  </a>
</div>

<h3 class="col-md-8 mt-lg-auto mt-md-3 mt-sm-4 mt-4">Registrar Competidor</h3>

</div>


<br>
<form>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Nombre</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Apellido Paterno</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="">
    </div>
    <div class="form-group col-md-4">
      <label for="inputAddress">Apellido Materno</label>
      <input type="text" class="form-control" id="inputAddress" placeholder="">
    </div>
  </div>
  <div class="form-row">
      <div class="form-group col-md-4 mx-auto">
        <label for="inputCity">Numero de Competidor</label>
        <input type="text" class="form-control" id="inputCity" placeholder="">
      </div>

    <div class="form-group col-md-4">
      <label for="inputCity">Competencia</label>
      <select class="form-control">
          <option>Sin Asignar</option>
          <option>Tour Morelia 2020</option>
          <option>Racing Mountain</option>
          <option>Los Azufres 40k</option>
      </select>
    </div>

    <div class="form-group col-md-4">
      <label for="inputCity">Entrenador</label>
      <select class="form-control">
          <option>Sin Asignar</option>
          <option>Raul Barajas Fierros</option>
          <option>Rafael Silva Campos</option>
          <option>Julieta Venegas</option>
      </select>
    </div>


  </div>

  <div class="container d-flex justify-content-center">
    <div class="col-md-4">
      <label for="inputCity">Tiempo de Entrenamiento</label>
      <div class="d-flex w-50 mx-auto">
        <input type="number" class="form-control" id="inputCity" min="0" max="18" placeholder="0">
        <label class="mt-auto ml-3">Meses</label>
      </div>
    </div>
  </div>
<br>


  <button type="submit" class="btn btn-primary">Registrar</button>
</form>

<script src="\t2bikes\js\jquery-3.4.1.min.js"></script>
<button type="submit" id="btnAjax">Competidores</button>
<div class="Contenido">

</div>
<script>
    const url = 'http://localhost:8000'; 
    $('#btnAjax').click(function (e) { 
        e.preventDefault();
        
        console.log(url+"/ajax/competidores");
        $.ajax({
            type: "get",
            url: url+"/ajax/competidores",
            data: {},
            dataType: "html",
            success: function (response) {
                console.log(response);
                $('.Contenido').html(response);
            }
        });
    });
</script>
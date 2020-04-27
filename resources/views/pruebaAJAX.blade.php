<script src=" {{ asset('t2bikes\js\jquery-3.4.1.min.js') }}"></script>
<button type="submit" id="btnAjax">Competidores</button>
<div class="Contenido">

</div>
<script>
    const url = 'http://localhost/T2BIKES/public'; 
    
    $('#btnAjax').click(function (e) { 
        e.preventDefault();
        
        console.log(url+"/home/competidores");
        $.ajax({
            type: "get",
            url: url+"/home/competidores",
            data: {},
            dataType: "html",
            success: function (response) {
                console.log(response);
                $('.Contenido').html(response);
            }
        });
    });
</script>
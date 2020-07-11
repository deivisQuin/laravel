$(document).ready(function() {
    $(document).on("click", ".pagination a",function(e){
        e.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        let url = "listar";

        $.ajax({
            data: {page : page},
            type: "GET",
            dataType: "json",
            url: url,
            success:function(response){
                $("#idDivListadoUser").html(response);
            }
        })        
    })
})
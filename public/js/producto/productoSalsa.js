//Retirar e check del producto Sin salsa para indicar que si desea salsas
$('.checkElegirSalsa').on('change', function() {
    let salsaElegidaId = this.id;
    aSalsaElegida = salsaElegidaId.split("_");
    
    if (aSalsaElegida[2] != "0") {
        $("#" + aSalsaElegida[0] + "_" + aSalsaElegida[1] + "_0").prop("checked", false) 
    } else {
        $(".claseCheck_" + aSalsaElegida[0] + "_" + aSalsaElegida[1] + "").each(function() {
            let claseCheckSalsaElegidaId = this.id;
            
            if ($("#" + claseCheckSalsaElegidaId).is(':checked')) {
                $("#" + claseCheckSalsaElegidaId).prop('checked', false);
            }
        })
    }
})
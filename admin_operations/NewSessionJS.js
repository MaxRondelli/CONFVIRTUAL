$(document).ready(function() {
    $("#conferenza_id").on("change", () => {
        $('#date_disponibili').empty();
        $('#id_programma').empty();
        var value = $('#conferenza_id').val();

        $.ajax({
            url: "../admin_operations/NewSessionAPI.php",
            type: "POST",
            data: { value: value },
            success: function(result) {
                var resultParsed = JSON.parse(result);
                var idProgramma = "";
                var result = "";
                
                for (var i = 0; i < resultParsed.length; i++) {
                    result = resultParsed[i]['Data'];
                    idProgramma = resultParsed[i]['IdProgramma'];
                }
                
                $("#date_disponibili").append(`<option value= "${result}">${result}</option>`);         
                // $('#id_programma').append(`<option value= "${idProgramma}">${idProgramma}</option>`);               
                $('#id_programma').val(idProgramma);
            }
        });
    });
});
$(document).ready(function() {
    $('#sessione_id').on("change", () => {
        $('#chat_area_id').empty();
        var value = $('#sessione_id').val();

        $.ajax({
            url: "../Chat/ViewChatAPI.php",
            type: "POST",
            data: {value: value},
            success: function(result) {
                var resultParsed = JSON.parse(result);
                var messaggio = "";

                for(var i=0; i < resultParsed.length; i++){
                    messaggio += "Messaggio: " + resultParsed[i]['Testo'] + " (Da: " +  resultParsed[i]['UsernameUtente'] + " - Data: " + 
                    resultParsed[i]['DataInserimento'] + ")" + "\n";
                }
                $('#chat_area_id').val(messaggio);
            }
        });
    });
});
function testCall(id){
    var path = Routing.generate('search');
    var bird_id = {"Bird_Id": id};

    $.ajax({
        type: "POST",
        data: bird_id,
        url: path,
        success: function(data){
            if(data){
                console.log(data)
                //var arrayOfObject = [{ name: "John", lang: "JS" }, { name: "alex", lang: "die" }]
                $.each(data, function( k, v ) {
                    console.log( "Key: " + k + ", Value: " + v.nom );
                });
            }
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

$(document).ready(function(){

    $("#dynamicSearch").keyup(function(){
        var path = Routing.generate('search');
        var birdQuery = $(this).val();

        $.ajax({
            type: "POST",
            data: {"Bird_Query" : birdQuery},
            url: path,
            success: function(data){
                $("#listResult").children().remove();
                $.each(data, function( k, v ) {
                    var searchBird = Routing.generate('search_bird', { id: v.id });
                    $('#listResult').append('<li><a href="'+searchBird+'">' + v.nom + '</a></li>')
                });
                if($("#dynamicSearch").val() === ''){
                    $("#listResult").children().remove();
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });

})
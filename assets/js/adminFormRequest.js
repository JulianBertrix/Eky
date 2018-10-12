function getFormulaire(data){
    var typeDechets = data.typeDechets;
    
    $("#form").append($("<div>").addClass("card-header").append($("<h3>").addClass("mb-0").text("Admin")))
              .append($("<div>").addClass("card-body")
                .append($("<form>").addClass("form").attr("role", "form").attr("autocomplete", "off").attr("id", "adminForm").attr("method", "POST")
                    .append($("<div>").addClass("form-group")
                        .append($("<label>").text("Code utilisateur"))
                        .append($("<input>").addClass("form-control").attr("type", "text").attr("name", "code").attr("id", "code").attr("require", "").attr("placeholder", "Veuillez entrer le code de l'utilisateur")))
                    .append($("<div>").addClass("form-group")
                        .append($("<label>").text("Type du déchet"))
                        .append($("<select>").addClass("form-control").attr("type", "text").attr("id", "type").attr("require", "")
                            .append($("<option>").text("Choisissez le type du déchet"))))));
    
    for (var i in typeDechets){
        var type = typeDechets[i];
        $("#type").append($("<option>").attr("id", type.id).val(type.id).text(type.type));
    }
    
    $("#adminForm").append($("<div>").addClass("form-group")
                        .append($("<label>").text("Quantité (en gramme)"))
                        .append($("<input>").addClass("form-control").attr("id", "qte").attr("type", "number").attr("require", "").attr("placeholder", "Veuillez entrer une quantité (en g)")))
                   .append($("<button>").addClass("btn btn-success btn-lg float-right").attr("onclick", "createDechet()").text("Valider"));
}

window.createDechet = function(){
    console.log($("#code").val());
    $.ajax({
        url: "http://eky.bwb/api/formulaire/dechet/add",
        type: "POST",

        data: {
            user: $("#code").val(),
            type: $("#type").val(),
            qte: $("#qte").val()
        },

        success: function (data) {
            alert("ok");
            getFormulaire(data);
        },
        error: function () {
        }
    });
};



$(function () {

    //upload de Imagens
    $("#upload_link").on('click', function (e) {
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });

    //Atribui a ação ao botão excluir
    $("#exclui").on('click', function (e) {
        e.preventDefault();
        var link = $(this).attr('data-acao');  // pega a acao do botão        
        $("#btnExclui").attr('href', link);
    });

});



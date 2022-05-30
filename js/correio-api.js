'use strict'

$('#calcular').click(function() {
    let formSerialized = $('#formDestino').serialize();
    $.post('calcular.php', formSerialized, function(resultado) {
        resultado = JSON.parse(resultado);
        let valorFrete = resultado.preco;
        let prazoEntrega = resultado.prazo;
        $('#resultado').html(`O valor do frete é <b>R$ ${valorFrete}</b> e o prazo de entrega é <b>${prazoEntrega} dias úteis</b>.`);
    });
});
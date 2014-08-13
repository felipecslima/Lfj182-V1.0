$(function() {
    //####### COSTOMIZAÇÃO DE CSS #########
    $('input[type=checkbox]').addClass('checkbox');
    $('input[type=radio]').addClass('radio');



    //####### AUXILIAR #########
    $('.jSubmit').click(function() {
        $(this).parents('form').attr('action', $(this).attr('href'));
        $(this).parents('form').submit();
        return false;
    });
    $('.jCheckAll').each(function() {
        var checks = $(this).parents('table').find('tr td input[type=checkbox]');
        var $this = $(this);
        $(this).click(function() {
            if ($(this).is(':checked')) {
                checks.attr('checked', true);
                //$(this).parents('tr').after('<tr class="jSelecionarTodos"><th colspan="'+$(this).parents('tr').find('th').size()+'">Selecionar Todos os '+checks.size()+' registros </th></tr>');
            } else {
                checks.attr('checked', false);
                $(this).parents('table').find('.jSelecionarTodos').remove();
            }
        });
        checks.click(function() {
            $(this).parents('table').find('.jSelecionarTodos').remove();
            $this.attr('checked', '');
        });
    });
    
    $('.jExcluirLinha').click(function() {
        var $this = $(this);

        var r = confirm("Você deseja realmente deletar esta publicação?");
        if (r) {
            $.post($(this).attr('href'), {ajax: true}, function() {
                $this.parents('tr').fadeOut('fast');
            }, 'json');
        }
        return false;
    });
});
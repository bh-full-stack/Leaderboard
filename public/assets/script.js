window.onload = function()
{
    $("#sort-by-menu, #sort-dir-menu").on('change',
        function()
        {
            $(this).parent().submit();
        });
};
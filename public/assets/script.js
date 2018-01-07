window.onload = function()
{
    $("#sort-by-menu, #sort-direction-menu").on('click',
        function()
        {
            $(this).parent().submit();
        });
};
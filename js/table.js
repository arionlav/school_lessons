$(function(){
    $('table#resultTable tbody tr:odd').css('background-color', '#fff');
    $('table#resultTable tbody tr:even').css('background-color', '#fffbf5');

    $('table#resultTable tbody tr').on('mouseover', function (e) {
        $(this).css({
            'background-color': '#fef1dd',
            'color': '#000',
            '-webkit-transition': 'all 0.15s ease-out',
            '-moz-transition': 'all 0.15s ease-out',
            'transition': 'all 0.15s ease-out'});
    });

    $('table#resultTable tr').on('mouseout', function (e) {
        $(this).css('background-color', '').css('color', '');
        $('table#resultTable tbody tr:odd').css('background-color', '#fff');
        $('table#resultTable tbody tr:even').css('background-color', '#fffbf5');
    })
})
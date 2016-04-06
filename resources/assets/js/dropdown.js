$('.special.cards .card .image').dimmer({
    on: 'hover'
});
$('.ui.dropdown').dropdown({
    allowAdditions: false,
    onChange: function (value, text, $selectedItem) {
        // Dim the existing content
        $('.ui.dimmer').dimmer('show');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/filter',
            data: {
                labels: value
            },
            success: function (markup) {
                $('#annotation-content').html(markup);
                // Undim the content
                $('.ui.dimmer').dimmer('hide');
                $('.special.cards .card .image').dimmer({
                    on: 'hover'
                });
            }
        });
        $('.ui.dropdown').dropdown('hide');
    }
});

// Clear the dropdown
$('.clear.button').on('click', function () {
    $('.ui.dropdown').dropdown('clear');
});

// Show the modal
$(document.body).on('click', '.ui.labeled.expand.button', function () {
    var card_id = $(this).closest('.card').attr('id');
    $('#modal' + card_id).modal('show');
});

// View similarly labeled content
$(document.body).on('click', '.ui.labeled.similar.button', function () {
    var content = $(this).parent().siblings('.content').find('.ui.labels');
    var label_list = [];
    content.children('.label').each(function () {
        var $this = $(this);
        label_list.push($this.text());
    });
    $('.ui.dropdown').dropdown('set exactly', label_list);
});

// Show content with clicked label
$(document.body).on('click', '.ui.label', function () {
    $('.ui.dropdown').dropdown('set exactly', $(this).text());
});
function test() {
    var name = '',
        obj = {},
        button = {};

    $('.js-editName').click(function(e) {
        /*
        Click into Input-Element
        */
        if (e.target.tagName == 'INPUT') {
            return null;
        }
        /*
        If editMode is enabled for an object, give him his name back and disable body clickevent
        */
        if (!$.isEmptyObject(obj)) {
            disabledEditMode();
        }

        obj = $(this)
        name = obj.html();


        var markup = '<input type="text" class="js-editNameInput" name="editNameInput" value="' + name + '">';
        button = obj.parent().find('button');
        button.attr('name', 'edit');
        button.html('&#9998');
        obj.html(markup).delay(10).promise().done(function() {
            bodyListenerOn();
            $('.js-editNameInput').focus();
        });
    });

    function bodyListenerOn() {
        $('body').on('click', function(e) {
            if (e.target.tagName != 'BUTTON' && e.target.tagName != 'INPUT') {
                disabledEditMode();
            }
        });
    }
    function bodyListenerOff() {
        $('body').off('click');
        name = '';
        obj = {},
        button = {};
    }
    function disabledEditMode() {
        obj.html(name);
        button.attr('name', 'delete');
        button.html('&#10008');
        bodyListenerOff();
    }
}

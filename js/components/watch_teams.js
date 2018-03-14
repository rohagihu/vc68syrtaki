function watch_teams() {

    for (let i = 0; i < 15; i++) {
        teams.watch('team'+i, function (id, oldval, newval) {
            console.log('o.' + id + ' changed from ' + oldval + ' to ' + newval);
            $('[name="team'+i+'"]').val(newval);
            return newval;
        });
    }

    $('.teams input').on('keyup', function() {
        let str = $(this).val(),
            name = $(this).attr('name');

        teams[name] = str;

    });
}
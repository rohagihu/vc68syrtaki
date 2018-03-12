function shuffle() {

        function shuffleTeams(o) {
            for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
            return o;
        };

    $('.js-shuffle').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();

        let teams = $('.teams ol input').serializeArray();
        shuffleTeams(teams);
        for (let i = 0; i < teams.length; i++) {
            $($('.teams input')[i]).val(teams[i].value);
        }
    });
}

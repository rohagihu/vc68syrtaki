// @params teams - global var, ref: base.js

function shuffle() {

        function shuffleTeams(o) {
            for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
            return o;
        };

    $('.js-shuffle').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();

        let teamsArr = $('.teams ol input').serializeArray();
        shuffleTeams(teamsArr);
        for (let i = 0; i < teamsArr.length; i++) {
            teams['team'+i] = teamsArr[i].value;
        }
    });
}

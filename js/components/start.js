function start() {
    $('.js-start').click(function(event) {
        event.preventDefault();
        event.stopPropagation();
        var finalTeams = $('.js-finalTeams input[type="text"]').serializeArray();
        finalTeams = JSON.stringify(finalTeams);
        console.log(finalTeams);
    });
}
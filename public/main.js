const base_url = $('base')[0].href;
const movielist = $('#movielist');
const moviecard_template = $('#moviecard-template').html();
const button_reload = $('#reload');

const cast_vote = function(button, vote) {
	const card = button.parents('.moviecard');
	card.find('button').attr('disabled', true);
	$.post({
		url: base_url+'vote.php',
		data: {
			id: card.data('id'),
			vote
		},
		success: function(d) {
			d = JSON.parse(d);
			if (d.data && !d.error) {
				let entry = d.data[0];
				card.find('.upvote > .votes').text(entry.upvotes);
				card.find('.downvote > .votes').text(entry.downvotes);
			}
		},
		complete: function() {
			card.find('button').attr('disabled', false);
		}
	})
};

const load_movies = function() {
	button_reload.attr('disabled', true);
	const spinner = movielist.find('.spinner');
	spinner.show();
	$('#movielist .moviecard').remove();
	$.get({
		url: base_url+'load.php',
		success: function(d) {
			spinner.hide();
			d = JSON.parse(d);
			if (d.data && !d.error) {
				for (let i=0;i<d.data.length;i++) {
					let entry = d.data[i];
					let newcard = $(moviecard_template).clone(true);
					newcard.data('id', entry.id);
					newcard.find('.card-title').text(entry.title);
					newcard.find('.upvote > .votes').text(entry.upvotes);
					newcard.find('.downvote > .votes').text(entry.downvotes);
					$(movielist).append(newcard);
				}
			}
		},
		complete: function() {
			button_reload.attr('disabled', false);
		}
	});
}

movielist.on('click', 'button.upvote', function() {
	cast_vote($(this), 1);
});
movielist.on('click', 'button.downvote', function() {
	cast_vote($(this), 0);
});
button_reload.on('click', function() {
	load_movies();
});

load_movies();

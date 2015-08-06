$(document).ready(function() {
var rank_id;
var type_id;

function student_search() {
	var search_str = $('#student-search').val();
	if(search_str !== '') {
		$.ajax({
			type: 'POST',
			url: 'inc/search.php',
			data: {query: search_str},
			cache: false,
			success: function(html) {
				$('#student-list').html(html);
			}
		});
	}
	return false;
}

function find_techniques_for_rank(rank_id) {
	$.ajax({
		type: 'POST',
		url: 'inc/requirements.php',
		data: {query: rank_id, query2: type_id},
		cache: false,
		success: function(html) {
			$('.lists').html(html);
		}
	});
}

function rank_advancement() {
	var ranks = $('.ranks');
	var types = $('.types');
	var lists = $('.lists');
	var listItems = $('.requirements ul li');
	var ranksLI = $('.ranks ul li');
	var typesLI = $('.types ul li');
	var listsLI = $('.lists ol li');
	var ranksWidth = ranks.width();
	var typesWidth = types.width();
	var listsWidth = lists.width();
	var colHeight;
	if(lists.height() > 20) {
		colHeight = lists.height();
	} else {
		colHeight = '400px';
	}
	var colHeight = lists.height();

	// set height of columns
	$('div[class*="col-"]').css('min-height', colHeight);

	// show ranks column
	ranks.css({
		'left': -ranksWidth + 'px',
		'opacity': 0,
		'display': 'block'
	}).animate({
		'left': 0,
		'opacity': 1
	}, 500);
	// hide the other columns
	types.css({
		'left': -typesWidth + 'px',
		'opacity': 0
	});
	lists.css({
		'left': -listsWidth - ranksWidth + 'px',
		'opacity': 0
	});
    
	// click functions for list items
	listItems.click(function() {
		var gp = $(this).parent().parent();
		listsLI = $('.lists-item');

		if(gp.hasClass('ranks')) {
			rank_id = $(this).attr('id');
			ranksLI.siblings($(this)).removeClass('req-highlight');
			types.animate({
				'display': 'block',
				'left': 0 + 'px',
				'opacity': 1
			}, 500);
			$(this).addClass('req-highlight');
			find_techniques_for_rank(rank_id, type_id);
		}
		if(gp.hasClass('types')) {
			$('.lists ul').hide();
			type_id = $(this).attr('id');
			typesLI.siblings($(this)).removeClass('req-highlight');
			lists.animate({
				'left': 0 + 'px',
				'opacity': 1,
				'display': 'block'
			}, 500, function() {
				$('.lists ul').fadeIn();
			});
			$(this).addClass('req-highlight');
			find_techniques_for_rank(rank_id, type_id);
		}
	});
}

function load_lesson(str) {
	str = str.replace(/ /g, '_').toLowerCase();
	$('.display').load('lessons/' + str + '.html');
	/*$.ajax({
		type: 'GET',
		url: 'lessons/' + str + '.html',
		dataType: 'html',
		success: function(html) {
			console.log(html);
			$('.display').html(html);
		}
	});*/
}

$.ajaxSetup({cache: false});
rank_advancement();

$('.lists').on('click', 'li.lists-item', function() {
	var str = $(this).attr('id');
	load_lesson(str);
});

//Searching and Filtering
var selectedRadio = $('input[type="radio"][name="program"]:checked');

$('#student-search').on('keyup', function(e) {
	clearTimeout($.data(this, 'timer'));
	var search_str = $(this).val();
	if(search_str == '') {
		$('#student-list').html('<p>Search to display students.</p>');
	} else {
		$('#student-list').fadeIn();
		$(this).data('timer', setTimeout(student_search, 100));
	}
	return false;
});

$('input[name="program"]').change(function() {
    selectedRadio = $(this).val();
    $('p.student-list-program').each(function() {
        if($(this).text().indexOf(selectedRadio) == -1) {
            var student = $(this).parent().parent().parent();
            console.log(student);
            student.hide();
        }
    });
});
    
console.log($('p.student-list-program').text());

});
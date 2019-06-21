	//Call custom requests function

		if (typeof loadCustomScripts === 'function') {
			loadCustomScripts();
		}

$(document).ready(function(){


	/*

	GTM

	*/

		$("[data-event='GAEvent']").click(function() {
			var evCat = $(this).attr('data-category') ? $(this).attr('data-category') : '',
				evAct = $(this).attr('data-action') ? $(this).attr('data-action') : '',
				evLab = $(this).attr('data-label') ? $(this).attr('data-label') : '',
				evVal = $(this).attr('data-value') ? $(this).attr('data-value') : '';

				try {

					window.dataLayer = window.dataLayer || [];
					dataLayer.push({
						'event': 'GAEvent',
						'eventCategory': evCat,
						'eventAction': evAct,
						'eventLabel': evLab,
						'eventValue': evVal,
					});
					//console.log(evCat);


				} catch (e) {
					//console.log(e);
				}
		});


	/*

	Blog

	*/
		//Listing
		if($('#blog_form_search')) {
			var page = 1;
			$('.blog_get_results').click(function(e) {
				e.preventDefault();
				$('.blog_loading').show();

				$.ajax({
					type: "GET",
					url: "/blog/"+(page_blog_results_category!=''?page_blog_results_category+"/":"")+"?page="+page+"&ajax=1&search="+page_blog_results_search
				})
				.done(function(data) {
					$('.blog_loading').hide();
					$(data).appendTo($('#results'));
					page=page+1;
					if($('.blog_no_more_results').length) {
						$('.blog_get_results').hide();
					}
				});
			});
		}

		//Search
		if($('#blog_form_search')) {
			$('#blog_form_search').submit(function(e) {
				e.preventDefault();
				location.href='/blog/?search='+$(this).find('input[type="text"]').val();
			});
		}

	/*

	General

	*/

		//Validate Form
		//code.....

		//Check click of button
		//code...

	/*

	Home

	*/

		//Validate Form
		//code.....


});

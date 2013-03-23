(function ($) {
	$(function () {
		var form = $("form#indeed-job-search-form");
		form.on("submit", function (e) {
			e.preventDefault();
			$(this).slideUp();
			// Builds a nice query string from POST variables

			var container = $("div.job-search-results");
			if (container.length !== 0) {
				// if the container is already there, clear it
				container.remove();
			}
			// create and cache container
			form.after('<div class="job-search-results" />');
			container = $("div.job-search-results");
			container.append("<p class='loading'></p>");

			// fetch jobs
			var args = {
				url: ajaxurl,
				type: 'post',
				async: true,
				cache: false,
				dataType: 'json',
				data:{
					action  :'get_jobs',
					nonce: nonce,
					post_var:$('input[name!=indeed-nonce]', this).serialize()
				},
				success: function(json){
					displayJobs(json.results, container);
					container.after(json.pagination);
					$("p.loading").remove();
				},
				error: function(xhr, textStatus ,e){
					/** Make sure to remove any previous error messages or data if we have any */
					container.empty();

					/** If we have a response as to why our request didn't work, let's output it or give a default error message */
					if ( xhr.responseText )
						container.append('<p class="plugin-error">' + xhr.responseText + '</p>');
					else
						container.append('<p class="plugin-error">Unknown error</p>');

					/** Remove the loading icon and replace the button with default text */
					$('p.loading').remove();

				}
			};
			// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
			$.ajax(args);

		});

		$(document).on("click", ".pagination a", function (e) {

					var link = $(this);
					if (!link.closest("li").hasClass('disabled')) {


						var results = $(this).data('page');
						container = $("div.job-search-results");
						container.html("<p class='loading'></p>");
						var pagination = $(".pagination");
						if (pagination !== 0) {
							pagination.remove();
						}
						var data = {
							action :'get_jobs',
							get_var:results
						};
						// the_ajax_script.ajaxurl is a variable that will contain the url to the ajax processing file
						$.get(ajaxurl, data, function (response) {
							var obj = $.parseJSON(response);

							displayJobs(obj.results, container);
							container.after(obj.pagination);
							$("p.loading").remove();
						});

					}
					return false;
				}
		);
	});

	function displayJobs(jobs, container) {
		$.each(jobs, function (i, item) {
			i++;
			var job = $('<div class="well well-large job job-' + i + '" />').appendTo(container);
			job.append('<p class="job-title"><a href="' + item.url + '">' + item.jobtitle + '</a></p>');
			job.append('<p>' + item.company + '</p>');
			job.append('<p>' + item.formattedLocation + '</p>');
			job.append('<p>' + item.source + '</p>');
			job.append('<p>' + item.date + '</p>');
			job.append('<p>' + item.snippet + '</p>');

		});
	}

}(jQuery));


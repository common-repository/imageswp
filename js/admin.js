jQuery(function($){
	$(document).ready(function(){
		$(imageswpAdminData.modalContent).insertBefore(".upload-php .wp-header-end");
	});
	$(document).on("click", ".imageswp-gen", function(e){
		e.preventDefault();

		var wrap = $(this).closest(".imageswp-wrap");
		var promptEl = wrap.find("[name='prompt']");
		var resultsEl = wrap.find(".imageswp-results");

		if(promptEl.val().trim() == ""){
			return false;
		}
		if(wrap.hasClass("doing-api")){
			return false;
		}

		wrap.addClass("doing-api");
		resultsEl.html("");

		$.ajax({
			url: imageswpAdminData.apiUrl,
			type: "POST",
			data: JSON.stringify({
				key: imageswpAdminData.apiKey,
				"prompt": promptEl.val().trim(),
				model: 1,
				samples: 1,
				width: 768,
				height: 768
			}),
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			cache: false,
			timeout: 1000 * 60 * 5
		}).done(function(res){
			if(!res.status || !res.images){
				resultsEl.html("Error");
			}else{
				resultsEl.html('<div class="imageswp-fieldset"><img class="imageswp-image" src="' + res.images[0] + '"></div><div class="imageswp-fieldset"><a class="button button-secondary imageswp-import" href="#">' + imageswpAdminData.i18n.importImg + '</a></div><div class="imageswp-fieldset imageswp-ajax-loader-wp"><div class="imageswp-loader"></div></div>');
			}
		}).always(function(){
			wrap.removeClass("doing-api");
		});
	});

	$(document).on("click", ".imageswp-import", function(e){
		e.preventDefault();

		var wrap = $(this).closest(".imageswp-wrap");

		wrap.addClass("doing-ajax");

		$.ajax({
			url: imageswpAdminData.ajaxUrl,
			type: "POST",
			data: {
				img: wrap.find(".imageswp-image").attr("src"),
				[imageswpAdminData.nonceName] : imageswpAdminData.nonce
			},
			cache: false,
		}).done(function(res){
			if(!res.success){
				alert(res.data);
			}else{
				tb_remove();
				if(wp.media.frame.content.get() !== null && wp.media.frame.content.get().collection != null) {
					wp.media.frame.content.get().collection.props.set({ignore: (+ new Date())});
					wp.media.frame.content.get().options.selection.reset();
				} else {
					wp.media.frame.library.props.set({ignore: (+ new Date())});
				}
			}
		}).always(function(){
			wrap.removeClass("doing-ajax");
		});
	});
});
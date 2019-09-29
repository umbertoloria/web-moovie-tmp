function form_submit(form, evento) {
	evento.preventDefault();
	form = $(form);
	if (!form.is(".unable")) {
		form.addClass("unable");
		// TOD: start loading
		$.ajax({
			type: "POST",
			url: $(form).attr('data-action'),
			data: new FormData(form[0]),
			dataType: "html",
			processData: false,
			contentType: false,
			success: function (out) {
				let type = out;
				let data = "";
				if (out.search(";") >= 0) {
					type = out.substr(0, out.search(";"));
					data = out.substr(out.search(";") + 1);
				}
				form.find("section label span.error").remove();
				form.find("span.warning").remove();
				if (type === 'redirect') {
					setTimeout(function () {
						location.href = data;
					}, 500);
					// TOD: aspettare o no?
				} else if (type === 'validation') {
					// TOD: stop loading
					data = $.parseJSON(data);
					$.each(data, function (index, value) {
						let label = form.find("section label [name=" + index + "]").parent();
						label.append("<span class='error fail'>" + value + "</span>");
						//form.find("section label [name=" + index + "]").closest("span.error").html(value).addClass("fail");
					});
				} else if (type === 'warning') {
					// TOD: stop loading
					form.append("<span class='warning'>" + data + "</span>");
					// TOD: show warning
				} else if (type === 'danger') {
					location.href = data;
				} else {
					// TOD: nessun altro codice, allora evacuazione
				}
				if (type !== 'redirect' && type !== 'danger') {
					form.removeClass("unable");
				}
			},
			error: function () {
				form.removeClass("unable");
				// TOD: stop loading
				// TOD: messaggio di errore
			}
		});
	}
}

$(function () {
	setTimeout(function () {
//		location.reload();
	}, 3000);
});
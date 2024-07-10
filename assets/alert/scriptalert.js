// // console.log('nyambung bi');
// // UPDATE BRO
// var flashdata = [$('.flash-data').data('icon'), $('.flash-data').data('judul'), $('.flash-data').data('message'), $('.flash-data').data('image')];
// // console.log(flashdata);
// if (flashdata[0]) {
// 	Swal.fire({
// 		title: flashdata[1],
// 		html: flashdata[2],
// 		icon: flashdata[0],
// 		buttonsStyling: !1,
// 		confirmButtonText: 'Ok',
// 		customClass: { confirmButton: 'btn shadow-sm' }
// 	});
// }
// if (flashdata[3]) {
// 	Swal.fire({
// 		title: flashdata[1],
// 		html: flashdata[2],
// 		imageUrl: flashdata[3],
// 		imageWidth: 100,
// 		imageHeight: 100,
// 		customClass: { confirmButton: 'btn shadow-sm' }
// 	})
// }
// $('.confirm_alert').on('click', function (e) {
// 	// console.log('ok');
// 	e.preventDefault();
// 	const href = $(this).attr('href');
// 	const title = $(this).data('judul');
// 	const message = $(this).data('message');
// 	const image = $(this).data('image');
// 	const icon = $(this).data('icon');

// 	if (image) {
// 		Swal.fire({
// 			title: title,
// 			html: message,
// 			imageUrl: image,
// 			imageWidth: 100,
// 			imageHeight: 100
// 		})
// 	} else {
// 		Swal.fire({
// 			title: title,
// 			html: message,
// 			icon: icon
// 		});
// 	}
// });
// $('.question_alert').on('click', function (e) {
// 	// console.log('ok');
// 	e.preventDefault();
// 	const href = $(this).attr('href');
// 	const title = $(this).data('judul');
// 	const message = $(this).data('message');
// 	const image = $(this).data('image');
// 	const icon = $(this).data('icon');

// 	if (image) {
// 		Swal.fire({
// 			title: title,
// 			html: message,
// 			imageUrl: image,
// 			imageWidth: 100,
// 			imageHeight: 100,
// 			showCancelButton: true,
// 			buttons: ["batal", "ya"],
// 			confirmButtonColor: '#3085d6',
// 			cancelButtonColor: '#d33',
// 			confirmButtonText: "Ya",
// 			cancelButtonText: "Batal",
// 		}).then((result) => {
// 			if (result.isConfirmed) {
// 				document.location.href = href;
// 			}
// 		})
// 	} else {
// 		Swal.fire({
// 			title: title,
// 			html: message,
// 			icon: icon,
// 			showCancelButton: true,
// 			confirmButtonColor: '#3085d6',
// 			cancelButtonColor: '#969696',
// 			confirmButtonText: "Ya",
// 			cancelButtonText: "Batal",
// 			reverseButtons: true
// 		}).then((result) => {
// 			if (result.isConfirmed) {
// 				document.location.href = href;
// 			}
// 		})
// 	}
// });


// function take_alert(title, message, icon) {
// 	Swal.fire({
// 		title: title,
// 		html: message,
// 		icon: icon,
// 		buttonsStyling: !1,
// 		confirmButtonText: 'Ok',
// 		customClass: { confirmButton: css_button }
// 	});
// }


// console.log('nyambung bi');
// UPDATE BRO
var flashdata = [$('.flash-data').data('icon'), $('.flash-data').data('judul'), $('.flash-data').data('message'), $('.flash-data').data('image')];
// console.log(flashdata);
if (flashdata[0]) {
	Swal.fire({
		title: flashdata[1],
		html: flashdata[2],
		icon: flashdata[0],
		buttonsStyling: !1,
		confirmButtonText: 'Ok',
		customClass: { confirmButton: css_button }
	});
}
if (flashdata[3]) {
	Swal.fire({
		title: flashdata[1],
		html: flashdata[2],
		imageUrl: flashdata[3],
		imageWidth: 100,
		imageHeight: 100,
		customClass: { confirmButton: css_button }
	})
}
$('.confirm_alert').on('click', function (e) {
	// console.log('ok');
	e.preventDefault();
	const href = $(this).attr('href');
	const title = $(this).data('judul');
	const message = $(this).data('message');
	const image = $(this).data('image');
	const icon = $(this).data('icon');

	if (image) {
		Swal.fire({
			title: title,
			html: message,
			imageUrl: image,
			imageWidth: 100,
			imageHeight: 100
		})
	} else {
		Swal.fire({
			title: title,
			html: message,
			icon: icon
		});
	}
});
$('.take_alert').on('click', function (e) {
	// console.log('ok');
	e.preventDefault();
	const title = $(this).data('judul');
	const message = $(this).data('message');
	const image = $(this).data('image');
	const icon = $(this).data('icon');

	Swal.fire({
		title: title,
		html: message,
		icon: icon,
		buttonsStyling: !1,
		confirmButtonText: 'Ok',
		customClass: { confirmButton: css_button }
	});
});

$('.question_alert').on('click', function (e) {
	// console.log('ok');
	e.preventDefault();
	const href = $(this).attr('href');
	const title = $(this).data('judul');
	const message = $(this).data('message');
	const image = $(this).data('image');
	const icon = $(this).data('icon');
	const post = $(this).data('post');
	const value = $(this).data('value');
	const url_ajax = $(this).data('url_ajax');
	// console.log(url_ajax);
	if (image) {
		Swal.fire({
			title: title,
			html: message,
			imageUrl: image,
			imageWidth: 100,
			imageHeight: 100,
			showCancelButton: true,
			buttons: ["Stop", "Do it!"],
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonhtml: 'Ya'
		}).then((result) => {

			if (url_ajax != null) {
				$.ajax({
					url: url_ajax,
					data: { post: post },
					method: 'POST',
					cache: false,
					dataType: 'json',
					beforeSend: function () {
						$('#loading_scene').modal('show');
					},
					success: function (data) {
						$('#loading_scene').modal('hide');
						// console.log(data);
						if (data.status == 200 || data.status == true) {
							if (data.alert) {
								Swal.fire({
									title: data.alert.title,
									html: data.alert.message,
									icon: data.alert.icon,
									buttonsStyling: !1,
									confirmButtonText: 'Ok',
									customClass: { confirmButton: css_button }
								});
							}
							if (data.reload) {
								location.reload();
							}
							if (data.redirect) {
								location.href = data.redirect;
							}
						} else {
							Swal.fire({
								title: 'PERINGATAN',
								html: data.alert.message,
								icon: 'warning',
								buttonsStyling: !1,
								confirmButtonText: 'Ok',
								customClass: { confirmButton: css_button }
							});
						}
					}
				})
			} else {
				if (result.isConfirmed) {
					document.location.href = href;
				}
			}
		})
	} else {
		Swal.fire({
			title: title,
			html: message,
			icon: icon,
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#969696',
			confirmButtonhtml: 'Ya',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				if (url_ajax != null) {
					$.ajax({
						url: url_ajax,
						data: { post: post, value: value },
						method: 'POST',
						cache: false,
						dataType: 'json',
						beforeSend: function () {
							$('#loading_scene').modal('show');
						},
						success: function (data) {
							$('#loading_scene').modal('hide');
							if (data.status == 200 || data.status == true) {
								if (data.alert) {
									Swal.fire({
										title: data.alert.title,
										html: data.alert.message,
										icon: data.alert.icon,
										buttonsStyling: !1,
										confirmButtonText: 'Ok',
										customClass: { confirmButton: css_button }
									});
								}
								if (data.reload) {
									location.reload();
								}
								if (data.redirect) {
									location.href = data.redirect;
								}
							} else {
								Swal.fire({
									title: 'PERINGATAN',
									html: data.alert.message,
									icon: 'warning',
									buttonsStyling: !1,
									confirmButtonText: 'Ok',
									customClass: { confirmButton: css_button }
								});
							}
						}
					})
				} else {
					if (result.isConfirmed) {
						document.location.href = href;
					}
				}
			}
		})
	}
});


function take_alert(title, message, icon) {
	Swal.fire({
		title: title,
		html: message,
		icon: icon,
		buttonsStyling: !1,
		confirmButtonText: 'Ok',
		customClass: { confirmButton: css_button }
	});
}
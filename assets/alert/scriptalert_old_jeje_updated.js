// console.log('nyambung bi');
var flashdata = [$('.flash-data').data('icon'), $('.flash-data').data('judul'), $('.flash-data').data('message'),$('.flash-data').data('image')];
// console.log(flashdata);
if (flashdata[0]) {
	Swal.fire({
		title : flashdata[1],
		text : flashdata[2],
		icon : flashdata[0]
	});
}
if (flashdata[3]) {
	Swal.fire({
		title: flashdata[1],
		text: flashdata[2],
		imageUrl: flashdata[3],
		imageWidth: 100,
		imageHeight: 100
	})
}
  // Fungsi untuk menangani klik pada bintang
  function handleStarClick(event) {
    // Dapatkan bintang yang diklik
    const clickedStar = event.target;
    // Dapatkan elemen rating star yang berisi bintang yang diklik
    const ratingStarElement = clickedStar.closest('.rating-star');
    // Dapatkan semua bintang di dalam elemen rating star
    const stars = ratingStarElement.querySelectorAll('.star');
    // Dapatkan indeks bintang yang diklik
    const starIndex = Array.from(stars).indexOf(clickedStar);
    
    // Perbarui kelas bintang berdasarkan indeks bintang yang diklik
    stars.forEach((star, index) => {
        if (index <= starIndex) {
            // Tambahkan kelas 'selected' ke bintang-bintang hingga bintang yang diklik
            star.classList.add('selected');
        } else {
            // Hapus kelas 'selected' dari bintang-bintang setelah bintang yang diklik
            star.classList.remove('selected');
        }
    });
}

// Tambahkan event listener ke semua bintang dalam elemen rating star
document.querySelectorAll('.rating-star .star').forEach(star => {
    star.addEventListener('click', handleStarClick);
});


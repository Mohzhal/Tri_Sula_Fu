window.addEventListener("scroll", function() {
    var scrollPosition = window.scrollY;
    var parallaxContent = document.getElementById("parallaxContent");
    var productSection = document.getElementById("product");
    var productOffsetTop = productSection.offsetTop;

    if (scrollPosition < productOffsetTop) {
        parallaxContent.style.transform = "translate(-50%, " + scrollPosition / 0.5 + "px)";
    } else {
        parallaxContent.style.transform = "translate(-50%, " + (productOffsetTop / 0.5) + "px)";
    }
});


// Mengubah gambar saat input diklik
var toggle = document.getElementById('toggle');
toggle.addEventListener('change', function() {
    var mainImage = document.getElementById('mainImage');
    var home = document.getElementById('Home');
    if (this.checked) {
        home.classList.add('night'); // Menambahkan kelas 'night' ke elemen 'Home'
        mainImage.style.opacity = '0'; // Set opacity to 0
        setTimeout(function() {
            mainImage.src = "/img/night.png"; // Change image source
            mainImage.style.opacity = '1'; // Fade in the new image
        }, 200); // Wait for the fade out transition to complete
    } else {
        home.classList.remove('night'); // Menghapus kelas 'night' dari elemen 'Home'
        mainImage.style.opacity = '0'; // Set opacity to 0
        setTimeout(function() {
            mainImage.src = "/img/pertama.jpg"; // Change image source
            mainImage.style.opacity = '1'; // Fade in the new image
        }, 200); // Wait for the fade out transition to complete
    }
});

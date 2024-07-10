document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('toggle');
    const html = document.documentElement;

    checkbox.addEventListener('change', () => {
        html.classList.toggle('dark', checkbox.checked);
    });
});


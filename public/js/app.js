// DRG Hotel — app.js

document.addEventListener('DOMContentLoaded', function () {

    // Auto-dismiss alerts after 4 seconds
    document.querySelectorAll('.alert').forEach(function (el) {
        setTimeout(function () {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(function () { el.remove(); }, 500);
        }, 4000);
    });

    // Highlight active sidebar link
    var currentPath = window.location.pathname;
    document.querySelectorAll('.sidebar-nav a').forEach(function (link) {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });

    // Set check-out min = check-in + 1 day
    var checkIn  = document.querySelector('input[name="check_in"]');
    var checkOut = document.querySelector('input[name="check_out"]');
    if (checkIn && checkOut) {
        checkIn.addEventListener('change', function () {
            var next = new Date(checkIn.value);
            next.setDate(next.getDate() + 1);
            checkOut.min = next.toISOString().split('T')[0];
            if (checkOut.value && checkOut.value <= checkIn.value) {
                checkOut.value = next.toISOString().split('T')[0];
            }
        });
    }

});

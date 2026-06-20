<div id="calendar"></div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '/api/availability',   // route ke controller
        eventColor: '#dc3545' // merah untuk full booked
    });
    calendar.render();
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH /var/www/resources/views/resepsionis/admin.blade.php ENDPATH**/ ?>
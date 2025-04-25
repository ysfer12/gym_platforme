// resources/js/schedule.js
document.addEventListener('DOMContentLoaded', function() {
    // Toggle submenu visibility
    const scheduleMenu = document.querySelector('[href="{{ route("trainer.schedule.index") }}"]');
    const scheduleSubmenu = document.querySelector('.pl-10.space-y-1');
    
    if (scheduleMenu && scheduleSubmenu) {
        scheduleMenu.addEventListener('click', function(e) {
            // Only toggle if not already on a schedule page
            if (!window.location.href.includes('trainer/schedule')) {
                e.preventDefault();
                scheduleSubmenu.classList.toggle('hidden');
            }
        });
    }
    
    // Time input validation
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    
    if (startTimeInput && endTimeInput) {
        endTimeInput.addEventListener('change', function() {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;
            
            if (startTime && endTime && startTime >= endTime) {
                alert('End time must be after start time');
                endTimeInput.value = '';
            }
        });
        
        startTimeInput.addEventListener('change', function() {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;
            
            if (startTime && endTime && startTime >= endTime) {
                endTimeInput.value = '';
            }
        });
    }
});
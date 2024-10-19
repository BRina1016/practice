document.getElementById('dateInput').addEventListener('change', function() {
        document.getElementById('display-date').textContent = this.value;
    });

    document.getElementById('reservation_hour').addEventListener('change', updateDisplayTime);
    document.getElementById('reservation_minute').addEventListener('change', updateDisplayTime);

    function updateDisplayTime() {
        var hour = document.getElementById('reservation_hour').value;
        var minute = document.getElementById('reservation_minute').value;
        document.getElementById('display-time').textContent = hour + ':' + minute;
    }

    document.getElementById('number_of_people').addEventListener('change', function() {
        document.getElementById('display-number').textContent = this.value + '人';
    });
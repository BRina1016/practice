document.addEventListener('DOMContentLoaded', function () {
    const reservationForm = document.getElementById("reservationForm");
    const dateInput = document.getElementById("dateInput");
    const reservationHour = document.getElementById("reservation_hour");
    const reservationMinute = document.getElementById("reservation_minute");
    const numberOfPeople = document.getElementById("number_of_people");

    const dateError = document.createElement("p");
    dateError.classList.add("error-message");
    dateError.style.color = "red";

    const timeError = document.createElement("p");
    timeError.classList.add("error-message");
    timeError.style.color = "red";

    const numberError = document.createElement("p");
    numberError.classList.add("error-message");
    numberError.style.color = "red";

    reservationForm.addEventListener("submit", function (event) {
        let isValid = true;

        // 日付のバリデーション
        if (dateInput.value === "" || dateInput.value === null || dateInput.value === undefined) {
            dateError.textContent = "日付を選択してください。";
            if (!dateInput.nextElementSibling || dateInput.nextElementSibling !== dateError) {
                dateInput.insertAdjacentElement("afterend", dateError);
            }
            isValid = false;
        } else {
            if (dateInput.nextElementSibling === dateError) {
                dateInput.nextElementSibling.remove();
            }
        }

        // 時間のバリデーション
        const hour = reservationHour.value;
        const minute = reservationMinute.value;
        if ((hour === "00" && minute === "00") || hour === "" || minute === "") {
            timeError.textContent = "時間を選択してください。";
            if (!reservationMinute.nextElementSibling) {
                reservationMinute.insertAdjacentElement("afterend", timeError);
            }
            isValid = false;
        } else {
            if (reservationMinute.nextElementSibling === timeError) {
                reservationMinute.nextElementSibling.remove();
            }
        }

        // 人数のバリデーション
        if (!numberOfPeople.value) {
            numberError.textContent = "人数を選択してください。";
            if (!numberOfPeople.nextElementSibling) {
                numberOfPeople.insertAdjacentElement("afterend", numberError);
            }
            isValid = false;
        } else {
            if (numberOfPeople.nextElementSibling === numberError) {
                numberOfPeople.nextElementSibling.remove();
            }
        }

        // バリデーション失敗時は送信を中止
        if (!isValid) {
            event.preventDefault();
        }
    });

    // 選択値のプレビュー表示
    dateInput.addEventListener('change', function () {
        document.getElementById('display-date').textContent = this.value;
    });

    reservationHour.addEventListener('change', updateDisplayTime);
    reservationMinute.addEventListener('change', updateDisplayTime);

    function updateDisplayTime() {
        const hour = reservationHour.value;
        const minute = reservationMinute.value;
        if (hour && minute) {
            document.getElementById('display-time').textContent = hour + ':' + minute;
        }
    }

    numberOfPeople.addEventListener('change', function () {
        document.getElementById('display-number').textContent = this.value + '人';
    });
});

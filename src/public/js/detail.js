document.addEventListener('DOMContentLoaded', function () {
    // 予約機能のスクリプト
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

    // レビュー機能のスクリプト
    const reviewModal = document.getElementById('reviewModal');
    const reviewButton = document.getElementById('reviewButton');
    const closeReviewModal = document.getElementById('closeReviewModal');
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');
    const reviewsContainer = document.getElementById('reviewsContainer');
    const storeMetaTag = document.querySelector('meta[name="store-id"]');

    if (!storeMetaTag || !storeMetaTag.content) {
        console.error('Error: <meta name="store-id"> is missing or content is empty.');
        alert('店舗情報が見つかりません。');
        return;
    }

    const storeId = storeMetaTag.content;

    // ページロード時にレビューを取得して表示
    fetch(`/reviews/${storeId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('レビューの取得に失敗しました');
            }
            return response.json();
        })
        .then(data => {
            data.forEach(review => {
                reviewsContainer.innerHTML += `
                    <div class="review">
                        <p class="review_ster">&#9733; ${review.rating}</p>
                        <p>${review.comment}</p>
                    </div>`;
            });
        })
        .catch(error => {
            console.error('エラー:', error);
            alert('レビューの読み込み中にエラーが発生しました。');
        });

    reviewButton.addEventListener('click', function () {
        reviewModal.style.display = 'block';
    });

    closeReviewModal.addEventListener('click', function () {
        reviewModal.style.display = 'none';
    });

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const ratingValue = this.getAttribute('data-value');
            ratingInput.value = ratingValue;

            stars.forEach(star => {
                if (star.getAttribute('data-value') <= ratingValue) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        });
    });

    document.getElementById('saveReviewButton').addEventListener('click', function () {
        const rating = document.getElementById('rating').value;
        const comment = document.getElementById('comment').value;

        fetch('/reviews', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                rating: rating,
                comment: comment,
                store_id: storeId
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('保存に失敗しました');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                reviewsContainer.innerHTML += `
                    <div class="review">
                        <p class="review_ster">&#9733; ${data.review.rating}</p>
                        <p>${data.review.comment}</p>
                    </div>`;
                document.getElementById('reviewForm').reset();
                reviewModal.style.display = 'none';
            } else {
                alert('レビューの保存に失敗しました');
            }
        })
        .catch(error => {
            console.error('エラー:', error);
            alert('エラーが発生しました。');
        });
    });
});

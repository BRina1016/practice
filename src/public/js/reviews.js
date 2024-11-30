document.addEventListener('DOMContentLoaded', function () {
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
                store_id: document.querySelector('meta[name="store-id"]').content
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const reviewsContainer = document.getElementById('reviewsContainer');
                reviewsContainer.innerHTML += `<div class="review mt-2"><strong>${data.review.rating}⭐</strong><p>${data.review.comment}</p></div>`;
                document.getElementById('reviewForm').reset();
                const reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
                reviewModal.hide();
            } else {
                alert('レビューの保存に失敗しました');
            }
        })
        .catch(error => console.error('エラー:', error));
    });
});

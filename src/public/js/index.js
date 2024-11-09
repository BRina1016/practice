let typingTimer;
const doneTypingInterval = 500;

function submitForm() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(() => {
        const searchForm = document.getElementById('searchForm');
        if (searchForm) {
            searchForm.submit();
        }
    }, doneTypingInterval);
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.heart-icon').forEach(icon => {
        icon.addEventListener('click', function() {
            const shopElement = this.closest('.shop');
            const storeId = shopElement.dataset.storeId;
            const favoriteUrl = shopElement.dataset.favoriteUrl;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(favoriteUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ store_id: storeId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Added to favorites') {
                    this.classList.add('favorited');
                } else if (data.message === 'Removed from favorites') {
                    this.classList.remove('favorited');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const heartIcons = document.querySelectorAll('.heart-icon');

    heartIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            const storeId = this.getAttribute('data-store-id');
            const url = '/favorites';
            const isFavorited = this.classList.contains('favorited');
            const method = isFavorited ? 'DELETE' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ store_id: storeId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    this.classList.toggle('favorited');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

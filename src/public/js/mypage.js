document.addEventListener('DOMContentLoaded', function () {
    const heartIcons = document.querySelectorAll('.heart-icon');

    heartIcons.forEach(icon => {
        icon.addEventListener('click', function () {
            const storeId = this.getAttribute('data-store-id');
            const url = '/mypage/favorites';
            const method = 'DELETE';

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
                    const shopElement = this.closest('.shop');
                    if (shopElement) {
                        shopElement.remove();
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

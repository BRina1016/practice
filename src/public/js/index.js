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
    const searchForm = document.getElementById('searchForm');

    if (searchForm) {
        const areaSelect = document.querySelector('.search-area-select');
        const genreSelect = document.querySelector('.search-genre-select');
        const keywordInput = document.querySelector('.search-keyword-input');

        if (areaSelect) areaSelect.addEventListener('change', submitForm);
        if (genreSelect) genreSelect.addEventListener('change', submitForm);
        if (keywordInput) keywordInput.addEventListener('input', submitForm);
    }
});
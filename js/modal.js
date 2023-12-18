// Wait for the DOM to load
document.addEventListener('DOMContentLoaded', function () {
    const itemDetailModal = document.querySelector('#item-detail-modal');
    const itemDetailButtons = document.querySelectorAll('.item-detail-button');

    itemDetailButtons.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            itemDetailModal.style.display = 'flex';
            e.preventDefault();
        });
    });

    // klik icon close modal
    document.querySelector('.modal .close-icon').addEventListener('click', (e) => {
        itemDetailModal.style.display = 'none';
        e.preventDefault();
    });

    // klik diluar modal
    window.onclick = (e) => {
        if (e.target === itemDetailModal) {
            itemDetailModal.style.display = 'none';
        }
    }
});

const accountImage = document.querySelector('.account img');
if (accountImage) {
    accountImage.addEventListener('click', function () {
        const account = this.closest('.account');
        account.classList.toggle('active');
    });

    document.addEventListener('click', function (e) {
        const account = document.querySelector('.account');
        if (account && !account.contains(e.target)) {
            account.classList.remove('active');
        }
    });
}

const startButton = document.querySelector('#loginRedirect');
if (startButton) {
    startButton.addEventListener('click', function(e) {
        e.preventDefault();
        const modal = document.getElementById('loginModal');
        if (modal) modal.classList.remove('hidden');
    });
}

const modalClose = document.querySelector('.modal-close');
if (modalClose) {
    modalClose.addEventListener('click', function () {
        const modal = document.getElementById('loginModal');
        if (modal) modal.classList.add('hidden');
    });
}

const modal = document.getElementById('loginModal');
if (modal) {
    modal.addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
}

const btn = document.getElementById('showAllBtn');
const preview = document.getElementById('cars-preview')
const extended = document.getElementById('cars-extended');

btn.addEventListener('click', function(e){
    e.preventDefault
    if (extended.style.display === 'none') {
        preview.style.display = 'none';
        extended.style.display = 'grid';
        btn.textContent = 'Toon Minder'
    } else {
        preview.style.display = 'grid';
        extended.style.display = 'none';
        btn.textContent = 'Toon Alle'
    }
});
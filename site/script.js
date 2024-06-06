document.addEventListener('DOMContentLoaded', function() {
    const registerButton = document.querySelector('.register-button');
    const registrationPopup = document.querySelector('.registration-popup');
    const closeButton = document.querySelector('.close-button');
    const loginForm = document.getElementById('loginForm');

    registerButton.addEventListener('click', function() {
        registrationPopup.style.display = 'flex';
    });

    closeButton.addEventListener('click', function() {
        registrationPopup.style.display = 'none';
    });

    loginForm.addEventListener('submit', function(event) {
        event.preventDefault();
    
        const formData = new FormData(loginForm);
    
        fetch('login.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'Login successful!') {
                const header = document.querySelector('header');
                const userDisplay = document.createElement('div');
                userDisplay.classList.add('user-display');
                userDisplay.textContent = `${formData.get('username')}`;
                header.appendChild(userDisplay);
                registrationPopup.style.display = 'none';

                // Сохранение имени пользователя в localStorage
                localStorage.setItem('username', formData.get('username'));
            } else {
                alert(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Отображение имени пользователя при загрузке страницы
    const storedUsername = localStorage.getItem('username');
    if (storedUsername) {
        const header = document.querySelector('header');
        const userDisplay = document.createElement('div');
        userDisplay.classList.add('user-display');
        userDisplay.textContent = storedUsername;
        header.appendChild(userDisplay);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const themeToggleButton = document.getElementById('themeToggle');
    const elementsToToggle = [
        document.body,
        document.querySelector('header'),
        document.querySelector('footer'),
        document.querySelector('.newsletter'),
        ...document.querySelectorAll('.product'),
        document.querySelector('.popup-content'),
        document.querySelector('.cart-content'),
        document.querySelector('.advertisement-content')
    ];

    // Функция для переключения темы
    function toggleTheme() {
        elementsToToggle.forEach(el => el.classList.toggle('dark-mode'));
        const isDarkMode = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
    }

    // Проверка сохраненной темы при загрузке страницы
    if (localStorage.getItem('darkMode') === 'enabled') {
        elementsToToggle.forEach(el => el.classList.add('dark-mode'));
    }

    // Событие для переключения темы
    themeToggleButton.addEventListener('click', toggleTheme);
});
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.sneaker-images img');
    const popup = document.getElementById('sneakerInfoPopup');
    const closeButton = document.querySelector('.close-button');

    images.forEach(image => {
        image.addEventListener('click', function() {
            const sneakerId = this.getAttribute('data-id');
            fetch(`get_sneaker.php?id=${sneakerId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('sneakerId').textContent = data.sneaker_id;
                        document.getElementById('sneakerName').textContent = data.name;
                        document.getElementById('sneakerBrand').textContent = data.brand;
                        document.getElementById('sneakerModel').textContent = data.model;
                        document.getElementById('sneakerSize').textContent = data.size;
                        document.getElementById('sneakerColor').textContent = data.color;
                        document.getElementById('sneakerReleaseDate').textContent = data.release_date;
                        document.getElementById('sneakerRetailPrice').textContent = `$${data.retail_price}`;
                        document.getElementById('sneakerDescription').textContent = data.description;
                        document.getElementById('sneakerImage').src = data.image_url;
                        popup.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });

    closeButton.addEventListener('click', function() {
        popup.style.display = 'none';
    });
    window.addEventListener('click', function(event) {
        if (event.target === popup) {
            popup.style.display = 'none';
        }
    });
    
});
document.addEventListener('DOMContentLoaded', function() {
    const closeButton = document.querySelector('.sneaker-info-popup .close-button'); // Находим кнопку закрытия

    closeButton.addEventListener('click', function() { // Добавляем обработчик события клика
        const popup = document.getElementById('sneakerInfoPopup'); // Находим блок описания кроссовка
        popup.style.display = 'none'; // Закрываем блок описания кроссовка при клике на кнопку закрытия
    });
});
document.getElementById('registerButton').addEventListener('click', function () {
    window.location.href = 'login.html';
});
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const registerButton = document.querySelector('.register-button');
    const userDisplay = document.querySelector('.user-display');
    const themeToggleButton = document.getElementById('themeToggle');

    // Function to display the username
    function displayUsername(username) {
        userDisplay.textContent = `${username}`;
    }

    // Event listener for the login form submission
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(loginForm);

            fetch('login.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'Login successful!') {
                    const username = formData.get('username');
                    localStorage.setItem('username', username);
                    displayUsername(username);
                    window.location.href = 'index.html';
                } else {
                    alert(data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }

    // Display the username on page load if it exists in localStorage
    const storedUsername = localStorage.getItem('username');
    if (storedUsername) {
        displayUsername(storedUsername);
    }

    // Redirect to login page when register button is clicked
    registerButton.addEventListener('click', function() {
        window.location.href = 'login.html';
    });
})

document.addEventListener('DOMContentLoaded', function() {
    const infoButtons = document.querySelectorAll('.info-button');

    infoButtons.forEach(button => {
        button.addEventListener('click', function() {
            const auctionId = this.getAttribute('data-id');
            window.location.href = `auction_info.html?auction_id=${auctionId}`;
        });
    });

    const sellerLinks = document.querySelectorAll('.seller-link');

    sellerLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const sellerId = this.getAttribute('data-seller-id');
            window.location.href = `seller_info.html?seller_id=${sellerId}`;
        });
    });
});

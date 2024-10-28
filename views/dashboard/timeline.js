let currentIndex = 0;
const totalCards = document.querySelectorAll('.card-item').length;
const dots = document.querySelectorAll('.dot');

function showCard(index) {
    const wrapper = document.querySelector('.cards-wrapper');

    if (index < 0) {
        index = totalCards - 1;
    } else if (index >= totalCards) {
        index = 0;
    }

    wrapper.style.transform = `translateX(-${index * 100}%)`;


    dots.forEach((dot, idx) => {
        dot.classList.toggle('active', idx === index);
    });

    currentIndex = index;
    }

    function nextCard() {
        showCard(currentIndex + 1);
    }

    setInterval(nextCard, 3000);
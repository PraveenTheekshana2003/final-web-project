const toggle = document.getElementById('darkModeToggle');
const savedColorScheme = localStorage.getItem('color-scheme');

if(savedColorScheme === 'dark') {
    toggle.checked = true;
    document.documentElement.style.colorScheme = 'dark';
} else {
    document.documentElement.style.colorScheme = 'light';
}

toggle.addEventListener('change', function() {
    if (this.checked) {
        document.documentElement.style.colorScheme = 'dark';
        localStorage.setItem('color-scheme','dark');
    } else {
        document.documentElement.style.colorScheme = 'light';
        localStorage.setItem('color-scheme','light');
    }
});


const carousels = document.querySelectorAll('.book-carousel');

carousels.forEach((carousel) => {
    const track = carousel.querySelector('.track');
    const next = carousel.querySelector('.next');
    const prev = carousel.querySelector('.prev');
    const cards = track.querySelectorAll('.book-card');
    let index = 0;
    const cardWidth = cards[0].offsetWidth + 20;

    next.addEventListener('click', () => {
        if(index < cards.length - 1) index++;
        track.style.transform = `translateX(-${index * cardWidth}px)`;
    });

    prev.addEventListener('click', () => {
        if(index > 0) index--;
        track.style.transform = `translateX(-${index * cardWidth}px)`;
    });
    
    document.addEventListener('keydown', (e) => {
        if(carousel.getBoundingClientRect().top < window.innerHeight && carousel.getBoundingClientRect().bottom > 0) {
            if(e.key === 'ArrowRight') {
                if(index < cards.length - 1) index++;
                track.style.transform = `translateX(-${index * cardWidth}px)`;
            } else if(e.key === 'ArrowLeft') {
                if(index > 0) index--;
                track.style.transform = `translateX(-${index * cardWidth}px)`;
            }
        }
    });
});


// Scroll Animation

document.addEventListener('DOMContentLoaded', function () {
    let options = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    let observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, options);

    document.querySelectorAll('.animated').forEach(element => {
        observer.observe(element);
    });
});

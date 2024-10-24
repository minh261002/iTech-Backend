window.addEventListener('scroll', function () {
    const header = document.querySelector('#menu-header-wrapper');
    header.classList.toggle("is-sticky", this.window.scrollY > 55);
});
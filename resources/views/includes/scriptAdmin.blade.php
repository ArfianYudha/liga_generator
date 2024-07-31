<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer>
    const button = document.getElementById('user-menu-button');
    const menu = document.querySelector('[aria-labelledby="user-menu-button"]');

    button.addEventListener('click', () => {
        const expanded = button.getAttribute('aria-expanded') === 'true';
        button.setAttribute('aria-expanded', !expanded);
        menu.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!button.contains(event.target)) {
            button.setAttribute('aria-expanded', 'false');
            menu.classList.add('hidden');
        }
    });
</script>

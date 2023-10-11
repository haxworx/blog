
let em = document.querySelector('#email');
if (em) {
    em.addEventListener('mouseover', () => {
        em.textContent = 'netstar@gmail.com';
    });

    em.addEventListener('mouseout', () => {
        em.textContent = 'echo bmV0c3RhckBnbWFpbC5jb20K | base64 -d';
    });
}


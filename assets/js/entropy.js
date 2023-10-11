
let p = document.querySelector('#scripture');
if (p) {
    let btn = document.querySelector('#btn_scripture');

    btn.addEventListener('click', (event) => {
        getScripture(event, p);
    });

    getScripture(null, p);
}

function getScripture(event, target)
{
    if (target) {
        fetch('/scripture', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then((json) => {
            target.textContent = json.text;
        })
       .catch((error) => {
            console.log(error);
        });
    }
}


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

let btn = document.querySelector('#btn_entropy');
if (btn) {
    let msg = document.querySelector('#message_entropy');
    let len = document.querySelector('#length_entropy');

    btn.addEventListener('click', (event) => {
        let text = msg.value;
        let length = parseInt(len.value);
        if (text.length && (length >= 10 && length <= 30)) {
            fetch('/entropy', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'text=' + text + '&length=' + length,
            })
            .then(response => response.json())
            .then((o) => {
                let text = document.querySelector('#text');
                text.innerText = o.message;
            })
            .catch((error) => {
                console.log(error);
            });
        }
        console.log(text, length);
    });
}

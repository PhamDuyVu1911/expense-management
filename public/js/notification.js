const main = document.querySelector('#notificationAction');
const overlay = document.querySelector('#overlay');
const btnClose = main.querySelector('#notificationAction__close');
const btnSubmit = main.querySelector('#notificationAction__submit');

function handleNotification(id, strContent, path) {
    main.style.display = 'block';
    overlay.style.display = 'block';
    btnSubmit.action = `${path}`;
    btnSubmit.querySelector('input[name=id]').value = id;
    main.querySelector('p').innerHTML = strContent;
}

btnSubmit.onclick = function () {
    this.submit();
};

overlay.onclick = function () {
    main.style.display = 'none';
    overlay.style.display = 'none';
};

btnClose.onclick = function () {
    main.style.display = 'none';
    overlay.style.display = 'none';
};

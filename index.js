function CheckPassword() {
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('re_password');
    const msg = document.getElementById('password-error');
    const isEqual = password.value === confirmPassword.value;
    if (!isEqual) {
        msg.classList.remove('hidden');
        msg.classList.add('visible');
    } else {
        msg.classList.add('hidden');
        msg.classList.remove('visible');
    }

    return password.value === confirmPassword.value;
}

function flipPage() {
    const page = document.querySelector('.flip-inner');
    page.classList.toggle('flip-page');

}
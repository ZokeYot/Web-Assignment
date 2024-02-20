
function updateTextInput(val) {
    document.getElementById('textInput').value = val;
}

function updateRangeInput(val) {
    document.getElementById('duration').value = val;
}

function updatePreview() {
    const fileInput = document.getElementById('file');
    const preview = document.getElementById('preview');

    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                preview.style.backgroundImage = `url('${event.target.result}')`;
            }
            reader.readAsDataURL(file);
        };

    })
}

function manageActivity(isAdmin) {
    if (isAdmin === "yes") {
        window.location.href = '../admin-manage-activity/admin-manage-activity.php'
    } else {
        window.location.href = '../manage-activity/manage-activity.php'
    }
}


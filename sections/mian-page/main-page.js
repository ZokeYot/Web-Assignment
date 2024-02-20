const container = document.getElementById('gallery');
const backButton = document.getElementById('backButton');
const nextButton = document.getElementById('nextButton');

container.addEventListener('wheel', (event) => {
    event.preventDefault();
    console.log(container.scrollLeft);
    container.style.scrollBehavior = 'smooth';
    console.log(container.scrollLeft)
    if (event.deltaY > 0) {
        container.scrollLeft += 500
    }
    else {
        container.scrollLeft -= 500
    }
})

nextButton.addEventListener('click', () => {
    container.style.scrollBehavior = 'smooth';
    container.scrollLeft += 1000

})

backButton.addEventListener('click', () => {
    container.style.scrollBehavior = 'smooth';
    container.scrollLeft -= 1000
})

setInterval(function () {
    container.style.scrollBehavior = 'smooth';
    container.scrollLeft += 1000

}, 2000)

setInterval(function () {
    container.style.scrollBehavior = 'smooth';
    container.scrollLeft = 0;
}, 8000)

function manageActivity(isAdmin) {
    if (isAdmin === "yes") {
        window.location.href = '../admin-manage-activity/admin-manage-activity.php'
    } else {
        window.location.href = '../manage-activity/manage-activity.php'
    }
}

function showDetail(activity_id) {
    window.location.href = "./main-page.php?id=" + activity_id;
}

function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0
    );
}

function blurBackground() {
    const events = document.querySelectorAll('.event-container');

    if (isInViewport(document.querySelector('.event-detail'))) {
        events.forEach(event => {
            event.classList.add('blur');
        })

    }
}

function removeBlur() {
    const detail = document.querySelector('.event-detail');
    const participant = document.querySelector('.participant-list');
    const events = document.querySelectorAll('.event-container');
    const container = document.querySelector('.container');
    if (isInViewport(detail)) {
        document.addEventListener('click', (event) => {

            const target = event.target;
            console.log(target != detail)
            if (target != detail) {
                detail.classList.add('gone')
                participant.classList.add('gone')
                container.classList.add('gone')
                events.forEach(event => {
                    event.classList.remove('blur');
                })
            }
        })
    }
}

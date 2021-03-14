let listTitle = document.querySelectorAll('.list-title');

// the way this delay and event listener works will probably be changed in the future

// variable to know when the last event has ran/called
// right this is only used for list title
let lastEv = 0;
// amount of delay (in ms) between events
let eventDelay = 500;
// loop through all lists
listTitle.forEach(element => {
    // call matchHeight function so it matches height when page is loaded
    matchHeight(element);
    // register event whenever a key is finished pressing
    element.onkeydown = function () {
        // only run once every (eventDelay) ms
        if (Date.now() - lastEv > eventDelay) {
            // set lastEv to currrent time
            lastEv = Date.now();
            // call matchHeight
            matchHeight(element);
        }

        // if enter key press (this is always checked)
        if (event.keyCode == 13) {
            // prevent new line
            event.preventDefault();
            // onfocus keyboard from textarea
            element.blur();
        }
    }

    element.onblur = function () {
        saveListName(element.getAttribute('data-list-id'), element.value);
    }

});

function matchHeight(element) {
    // reset height
    element.style.height = 0;
    // set the new 'correct' height
    element.style.height = (25 + element.scrollHeight) + 'px';
}

function saveListName(id, name) {
    data = new FormData();
    data.set('id', id);
    data.set('listName', name);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/board/updateList/" + id, true);
    xhr.send(data);
}

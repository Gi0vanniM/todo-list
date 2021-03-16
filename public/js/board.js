// define some HTML elements
let listTitle = document.querySelectorAll('.list-title');

let sortDurationAsc = document.querySelectorAll('.sortDurationAsc');
let sortDurationDesc = document.querySelectorAll('.sortDurationDesc');
let sortDurationRes = document.querySelectorAll('.sortDurationRes');

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

// event listeners for sort buttons
// doesn't really look dry
// loop through all sortDurationAsc buttons
sortDurationAsc.forEach(element => {
    // trigger on click
    element.onclick = () => {
        // call sortList function asc
        sortList(element.getAttribute('data-list-id'), 'asc');
    }
});
// loop through all sortDurationDesc buttons
sortDurationDesc.forEach(element => {
    // trigger on click
    element.onclick = () => {
        // call sortList function desc
        sortList(element.getAttribute('data-list-id'), 'desc');
    }
});
// loop through all sortDurationRes buttons
sortDurationRes.forEach(element => {
    // trigger on click
    element.onclick = () => {
        // call sortList function normal
        sortList(element.getAttribute('data-list-id'), 'normal');
    }
});


function matchHeight(element) {
    // reset height
    element.style.height = 0;
    // set the new 'correct' height
    element.style.height = (25 + element.scrollHeight) + 'px';
}

/**
 * save the new list name
 * @param {numer} id id of list
 * @param {string} name new name of list
 */
function saveListName(id, name) {
    // create form data
    data = new FormData();
    data.set('id', id);
    data.set('listName', name);
    // send form data via post to url
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/board/updateList/" + id, true);
    xhr.send(data);
}

/**
 * 
 * @param {number} listId
 * @param {'asc' | 'desc' | 'normal'} dir 
 */
function sortList(listId, dir = 'asc') {
    let list = document.querySelector('#list-' + listId + '').querySelector('ul.list-items');
    let tasks = list.querySelectorAll('li');

    if (dir === 'asc') {
        [...tasks]
            .sort((a, b) => parseInt(a.getAttribute('data-duration')) > parseInt(b.getAttribute('data-duration')) ? 1 : -1)
            .forEach(element => list.appendChild(element));
    } else if (dir === 'desc') {
        [...tasks]
            .sort((a, b) => parseInt(a.getAttribute('data-duration')) < parseInt(b.getAttribute('data-duration')) ? 1 : -1)
            .forEach(element => list.appendChild(element));
    } else {
        [...tasks]
            .sort((a, b) => parseInt(a.getAttribute('data-task-id')) > parseInt(b.getAttribute('data-task-id')) ? 1 : -1)
            .forEach(element => list.appendChild(element));
    }

}

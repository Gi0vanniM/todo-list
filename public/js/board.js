let listTitle = document.querySelectorAll('.list-title');

let lastEv = 0;
let eventDelay = 500;
// loop through all lists
listTitle.forEach(element => {
    // call matchHeight function so it matches height when page is loaded
    matchHeight(element);
    // register event whenever a key is finished pressing
    element.onkeydown = function () {
        // only run once every (eventDelay) ms
        if (Date.now() - lastEv > eventDelay) {
            lastEv = Date.now();

            // call matchHeight
            matchHeight(element);
        }

        // if enter key press (this is always checked)
        if (event.keyCode == 13) {
            event.preventDefault();
        }
    }
});

function matchHeight(element) {
    // reset height
    element.style.height = 0;
    // 
    element.style.height = (25 + element.scrollHeight) + 'px';
}

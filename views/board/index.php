<?php

?>

<script src="//<?= APP_URL ?>/js/board.js" defer></script>

<div class="list-container px-2 mt-3">

    <!-- <template class="list-template"> -->

    <div class="list">
        <div class="list-header">
            <textarea class="list-title m-0">Todo-list applicatie: todo list</textarea>

            <div class="list-header-extra">
                <button class="list-option">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </div>

        </div>
        <ul class="list-items m-0">
            <!-- <li></li> -->
            <li>Jeff</li>
        </ul>
        <button class="btn add-card-btn">Add a card</button>
    </div>

    <!-- </template> -->

    <button class="btn add-list-btn" type="button" id="dropdownAddList" data-toggle="dropdown" 
    aria-haspopup="true" aria-expanded="false" data-offset="0, -10">Add a list</button>

    <form action="//<?= APP_URL ?>/board/addList" method="post" class="dropdown-menu addList bg-greyish p-2 m-0" aria-labelledby="dropdownAddList">
        <div class="form-group m-0">
            <input type="text" id="newListName" name="newListName" class="w-100" placeholder="Enter list title">
            <button type="submit" class="btn btn-success py-1 px-2 mt-2">Add list</button>
        </div>
    </form>


</div>
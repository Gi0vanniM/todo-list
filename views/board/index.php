<?php

?>
<!-- .list*10>.list-header>textarea.list-title{test}^ul.list-items>li{test}*100 -->

<script src="//<?= APP_URL ?>/js/board.js" defer></script>

<div class="list-container px-2 mt-3">

    <?php foreach ($lists as $list) { ?>
        <div class="list">
            <div class="list-header">
                <textarea class="list-title m-0" data-list-id="<?= $list->id ?>"><?= $list->list_name ?></textarea>

                <div class="list-header-extra">
                    <div class="dropdown">
                        <button class="list-option" id="dropdownListOptions<?= $list->id ?>" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownListOptions<?= $list->id ?>">
                            <li>
                                <h6 class="dropdown-header">List actions</h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="//<?= APP_URL ?>/board/deleteList/<?= $list->id ?>" method="post">
                                    <button name="id" value="<?= $list->id ?>" class="dropdown-item text-danger">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <ul class="list-items m-0">
                <!-- <li></li> -->
            </ul>

            <div class="dropdown">
                <button class="btn add-card-btn w-100" type="button" id="dropdownAddTask<?= $list->id ?>" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,-40">Add a card</button>

                <form action="//<?= APP_URL ?>/board/addTask/<?= $list->id ?>" method="post" class="dropdown-menu addTask bg-greyish p-2 m-0" aria-labelledby="dropdownAddTask<?= $list->id ?>">
                    <div class="form-group m-0">
                        <input type="text" id="newTaskName" name="newTaskName" class="w-100" placeholder="Enter task description">

                        <div>
                            <input type="number" name="taskDuration" id="taskDuration" class="w-50" min="0" placeholder="Duration">
                            <label for="taskDuration">minutes</label>
                        </div>

                        <div>
                            <label for="taskStatus">Status:</label>
                            <select name="taskStatus" id="taskStatus" class="w-75">
                                <?php foreach ($statuses as $status) { ?>
                                    <option value="<?= $status->id ?>"><?= $status->status ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <button type="submit" name="addTask" class="btn btn-success py-1 px-2 mt-2">Add task</button>
                    </div>
                </form>
            </div>

        </div>
    <?php } ?>


    <!-- List template -->
    <template class="list-template">

        <div class="list">
            <div class="list-header">
                <textarea class="list-title m-0" data-list-id="#">*title*</textarea>

                <div class="list-header-extra">
                    <div class="dropdown">
                        <button class="list-option" id="dropdownListOptions#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownListOptions#">
                            <li>
                                <h6 class="dropdown-header">List actions</h6>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="//<?= APP_URL ?>/board/deleteList/#" method="post">
                                    <button name="id" value="#" class="dropdown-item text-danger">Delete</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <ul class="list-items m-0">
                <!-- <li></li> -->
            </ul>

            <div class="dropdown">
                <button class="btn add-card-btn w-100" type="button" id="dropdownAddTask#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,-40">Add a card</button>

                <form action="//<?= APP_URL ?>/board/addTask/<?= $list->id ?>" method="post" class="dropdown-menu addTask bg-greyish p-2 m-0" aria-labelledby="dropdownAddTask#">
                    <div class="form-group m-0">
                        <input type="text" id="taskDescription" name="taskDescription" class="w-100" placeholder="Enter task description">
                        <input type="number" name="duration" id="taskDuration">
                        <button type="submit" name="addTask" class="btn btn-success py-1 px-2 mt-2">Add task</button>
                    </div>
                </form>
            </div>
        </div>

    </template>



    <div class="dropdown">
        <button class="btn add-list-btn w-100" type="button" id="dropdownAddList" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0, -38">Add a list</button>

        <form action="//<?= APP_URL ?>/board/addList" method="post" class="dropdown-menu addList bg-greyish p-2 m-0" aria-labelledby="dropdownAddList">
            <div class="form-group m-0">
                <input type="text" id="newListName" name="newListName" class="w-100" placeholder="Enter list title">
                <button type="submit" name="addList" class="btn btn-success py-1 px-2 mt-2">Add list</button>
            </div>
        </form>
    </div>

    <div style="width: 0px;">&nbsp;</div>
</div>
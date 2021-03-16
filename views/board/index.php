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
            <!-- TASKS -->
            <ul class="list-items m-0">
                <!-- <li></li> -->
                <?php foreach ($tasks as $task) {
                    if ($task->list_id == $list->id) { ?>
                        <li type="button" id="task-<?= $task->id ?>" data-bs-toggle="modal" data-bs-target="#taskModal<?= $task->id ?>" data-list-id="<?= $task->list_id ?>" data-duration="<?= $task->duration ?>" data-status="<?= $task->status_id ?>">
                            <p>
                                <?= $task->description ?>
                            </p>
                            <small class="text-muted"><?= $statusesNames[$task->status_id] ?></small>
                            <small class="text-muted"><?= $task->duration ?> minutes</small>
                        </li>
                        <!-- TASK MODAL -->
                        <div class="modal" id="taskModal<?= $task->id ?>" tabindex="-1" aria-labelledby="taskModalLabel<?= $task->id ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">Editing task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="updateTask<?= $task->id ?>" action="//<?= APP_URL ?>/board/updateTask/<?= $task->id ?>" method="post" class="modal-body">
                                        <input type="hidden" name="listId" value="<?= $list->id ?>">
                                        <input type="hidden" name="taskId" value="<?= $task->id ?>">
                                        <textarea name="taskModalDescription" id="taskModalDescription"><?= $task->description ?></textarea>

                                        <div>
                                            <label for="taskModalDuration">Duration:</label>
                                            <input type="number" name="taskModalDuration" id="taskDuration" class="w-50" min="0" max="9999" placeholder="Duration" value="<?= $task->duration ?>" required>
                                            <label for="taskModalDuration">minutes</label>
                                        </div>

                                        <div>
                                            <label for="taskModalStatus">Status:</label>
                                            <select name="taskModalStatus" id="taskModalStatus" class="w-75" required>
                                                <option value="">Select a status</option>
                                                <?php foreach ($statuses as $status) { ?>
                                                    <option value="<?= $status->id ?>" <?php if ($task->status_id === $status->id) { ?> selected <?php } ?>>
                                                        <?= $status->status ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </form>
                                    <div class="modal-footer">
                                        <button type="submit" form="updateTask<?= $task->id ?>" name="updateTask" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form action="//<?= APP_URL ?>/board/deleteTask/<?= $task->id ?>" method="post">
                                            <input type="hidden" name="listId" value="<?= $list->id ?>">
                                            <button type="submit" name="taskId" value="<?= $task->id ?>" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?php }
                } ?>
            </ul>

            <!-- ADD TASK -->
            <div class="dropdown">
                <button class="btn add-card-btn w-100" type="button" id="dropdownAddTask<?= $list->id ?>" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,-40">Add a task</button>

                <form action="//<?= APP_URL ?>/board/addTask/<?= $list->id ?>" method="post" class="dropdown-menu addTask bg-greyish p-2 m-0" aria-labelledby="dropdownAddTask<?= $list->id ?>">
                    <div class="form-group m-0">
                        <input type="text" id="taskDescription" name="taskDescription" class="w-100" placeholder="Enter task description" required>

                        <input type="hidden" name="listId" value="<?= $list->id ?>">

                        <div>
                            <input type="number" name="taskDuration" id="taskDuration" class="w-50" min="0" max="9999" placeholder="Duration" required>
                            <label for="taskDuration">minutes</label>
                        </div>

                        <div>
                            <label for="taskStatus">Status:</label>
                            <select name="taskStatus" id="taskStatus" class="w-75" required>
                                <option value="">Select a status</option>
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
                <input type="text" id="newListName" name="newListName" class="w-100" placeholder="Enter list title" required>
                <button type="submit" name="addList" class="btn btn-success py-1 px-2 mt-2">Add list</button>
            </div>
        </form>
    </div>

    <div style="width: 0px;">&nbsp;</div>
</div>
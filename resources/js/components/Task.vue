<template>
    <div
        @dblclick="statusUpdate"
        :class="[Boolean(task.status) ? 'status' : '', 'task']"
    >
        <h3>
            {{ task.title }}
            <span>
                <i @click="editTask()" class="fas fa-edit"></i>
                <i @click="deleteTask()" class="fas fa-times"></i>
            </span>
        </h3>
        <p>{{ task.created_at }}</p>
    </div>
</template>

<script>
import {mapActions, mapMutations} from "vuex";
import type from "../store/type";

export default {
    name: 'Task',
    props: {
        task: Object,
    },
    methods: {
        ...mapActions({
            deleteTaskAction: type.DeleteTodoAction,
            statusUpdateTodoMethod: type.StatusUpdateTodoAction,
        }),
        ...mapMutations({
            selectCurrentTaskMethod: type.CurrentTodoSetter,
        }),
        statusUpdate() {
            this.statusUpdateTodoMethod(this.task.tuid);
        },
        editTask(){
            this.selectCurrentTaskMethod(this.task);
        },
        async deleteTask(tuid) {
            if (confirm('Are you sure?')) {
                this.deleteTaskAction(this.task.tuid);
            }
        }
    }
}
</script>

<style scope>
.fas {
    color: red;
}

.task {
    background: #f4f4f4;
    margin: 5px;
    padding: 10px 20px;
    cursor: pointer;
}

.task.status {
    border-left: 5px solid green;
}

.task h3 {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.fa-edit{
    color:black;
    padding-right: 2px;
}
</style>

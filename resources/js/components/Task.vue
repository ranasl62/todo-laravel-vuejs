<template>
    <div
        @dblclick="$emit('toggle-status', task.tuid)"
        :class="[Boolean(task.status) ? 'status' : '', 'task']"
    >
        <h3>
            {{ task.title }}
            <i @click="deleteTask()" class="fas fa-times"></i>
        </h3>
        <p>{{ task.created_at }}</p>
    </div>
</template>

<script>
import {mapActions} from "vuex";
import type from "../store/type";

export default {
    name: 'Task',
    props: {
        task: Object,
    },
    methods: {
        ...mapActions({
            deleteTaskAction: type.DeleteTodoAction,
        }),
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
</style>

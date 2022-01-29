<template>
    <div>
        <Task :key="task.id" v-for="task in tasks.data"
              @toggle-add-task="$emit('toggle-add-task')"
              :task="task"
        />
        <div class="pagination" v-if="tasks.data.length">
            <Button :color="'primary'" :text="'<<'"
                    @btn-click="loadPage(tasks.prev_page_url)"
                    :class-names="['primary', Boolean(tasks.prev_page_url)?'':'disabled']"></Button>

            <Button :color="'primary'" :text="'>>'"
                    @btn-click="loadPage(tasks.next_page_url)"
                    :class-names="['primary', Boolean(tasks.next_page_url)?'':'disabled']"></Button>
        </div>
    </div>
</template>

<script>
import Task from './Task'
import Button from "./Button";
import {mapActions, mapGetters} from "vuex";
import type from "../store/type";

export default {
    name: 'Tasks',
    components: {
        Button,
        Task,
    },
    emits: ['toggle-add-task'],
    computed: {
        ...mapGetters({
            tasks: type.TodoListGetter,
        })
    },
    methods: {
        ...mapActions({
            fetchTodoListMethod: type.FetchTodoList,
        }),

        loadPage(url) {
            this.fetchTodoListMethod(url);
        },
    },
    mounted() {
        this.fetchTodoListMethod();
    },
}
</script>

<style>
.float-right{
    float: right;
}
.pagination{
    justify-content: flex-end;
}
</style>

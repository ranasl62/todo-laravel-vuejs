<template>
    <div class="container">
        <Header
            @toggle-add-task="toggleAddTask"
            title="Task Tracker"
            :showAddTask="showAddTask"
        />
        <AddTask v-show="showAddTask" @add-task="addTask"/>
        <Tasks
            @toggle-status="toggleStatus"
            @delete-task="deleteTask"
            :tasks="getTodoListData"
        />
        <Footer/>
    </div>
</template>

<script>
import Header from '../components/Header';
import Tasks from '../components/Tasks';
import Footer from '../components/Footer';
import AddTask from '../components/AddTask';
import {mapActions, mapGetters, mapMutations} from "vuex";
import type from "./../store/type";

export default {
    name: 'Home',
    props: {
        showAddTask: Boolean,
    },
    components: {
        Tasks,
        AddTask,
        Header,
        Footer
    },
    data() {
        return {
            showAddTask: false,
            tasks: {},
        }
    },
    methods: {
        ...mapActions({
            fetchTodoListMethod: type.FetchTodoList,
            currentTodoMethod: type.CurrentTodoAction,
            addTodoMethod: type.AddTodoAction,
            statusUpdateTodoMethod: type.StatusUpdateTodoAction
        }),
        toggleAddTask() {
            this.showAddTask = !this.showAddTask
        },
        async addTask(task) {
            this.addTodoMethod(task);
        },
        async deleteTask(tuid) {
            if (confirm('Are you sure?')) {
                const res = await fetch(`/api/v1/todo/${tuid}`, {
                    method: 'DELETE',
                })
                res.status === 200
                    ? (this.tasks = this.tasks.filter((task) => task.tuid !== tuid))
                    : alert('Error deleting task')
            }
        },
        async toggleStatus(tuid) {
           this.statusUpdateTodoMethod(tuid);
        },
    },
    mounted() {
        this.fetchTodoListMethod();
    },
    computed: {
        ...mapGetters({
            getTodoListData: type.TodoListGetter,
            getTodoData: type.TodoGetter,
            getCurrentTodoData: type.CurrentTodoGetter,
        })
    },
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&display=swap');

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Poppins', sans-serif;
}

.container {
    max-width: 500px;
    margin: 30px auto;
    overflow: auto;
    min-height: 300px;
    border: 1px solid steelblue;
    padding: 30px;
    border-radius: 5px;
}

.btn {
    display: inline-block;
    background: #000;
    color: #fff;
    border: none;
    padding: 10px 20px;
    margin: 5px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    font-size: 15px;
    font-family: inherit;
}

.btn:focus {
    outline: none;
}

.btn:active {
    transform: scale(0.98);
}

.btn-block {
    display: block;
    width: 100%;
}
</style>

<template>
    <div class="container">
        <div :class="getMessageData.isSuccess?'messageSuccess':'messageFailed'" v-show="getMessageData && getMessageData.message">
            <p class="message">
                {{ getMessageData.message }}
                <i @click="deleteMessage()" class="fas fa-times delete"></i>
            </p>
        </div>
        <Header
            @toggle-add-task="toggleAddTask"
            title="Task Tracker"
            :showAddTask="Boolean(getCurrentTodoData)||showAddTask"
        />
        <AddTask v-show="getCurrentTodoData||showAddTask"/>
        <Tasks
        />
        <Footer/>
    </div>
</template>

<script>
import Header from '../components/Header';
import Tasks from '../components/Tasks';
import Footer from '../components/Footer';
import AddTask from '../components/AddTask';
import {mapGetters, mapMutations} from "vuex";
import type from "../store/type";

export default {
    name: 'Home',
    props: {},
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
        ...mapMutations({
            selectCurrentTaskMethod: type.CurrentTodoSetter,
            setMessageMethod: type.MessageSetter,
        }),

        toggleAddTask() {
            this.showAddTask = !this.showAddTask;
            this.selectCurrentTaskMethod(null);
        },
        deleteMessage() {
            this.setMessageMethod({});
        }
    },
    computed: {
        ...mapGetters({
            getCurrentTodoData: type.CurrentTodoGetter,
            getMessageData: type.MessageGetter,
        }),
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

.btn:hover {
    color: black;
    background-color: white;
    border: 1px solid black;
}

.btn-block {
    display: block;
    width: 100%;
}

.messageSuccess {
    background: #68eecc8f;
}
.messageFailed {
    background: #e2321166;
}
.delete{
    float: right;
    color: red;
    padding: 4px;
}
.message {
    padding: 5px;
}
</style>

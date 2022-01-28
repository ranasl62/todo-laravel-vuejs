import Vue from 'vue';
import Vuex from 'vuex';
import type from './type';
import addTask from "./todo/add-task";
import fetchTasks from "./todo/fetch-tasks";
import fetchTask from "./todo/fetch-task";

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        todoList: [],
        currentTask: {},
        message: '',
    },
    getters: {
        [type.TodoListGetter]: (state) => {
            return state.todoList;
        },

        [type.TodoGetter]: (state) => {
            return state.currentTask;
        },

        [type.MessageGetter]: (state) => {
            return state.message;
        },
    },
    mutations: {
        [type.TodoListSetter]: (state, payload) => {
            state.todoList = payload;
        },

        [type.MessageSetter]: (state, payload) => {
            state.message = payload;
        },

        [type.TodoGetter]: (state, payload) => {
            state.currentTodoList = payload;
        },
        [type.TodoSetter]: (state, payload) => {
            state.todoList.data = [payload, ...state.todoList.data];
        },
        [type.CurrentTodoSetter]: (state, payload) => {
            state.currentTask = payload;
        },
    },
    actions: {
        [type.AddTodoAction]: (context, payload) => {
            addTask(context, payload);
        },
        [type.FetchTodoList]: (context) => {
            fetchTasks(context);
        },
        [type.CurrentTodoAction]: (context, payload) => {
            fetchTask(context, payload);
        },
        [type.StatusUpdateTodoAction]: (context, payload) => {
            fetchTask(context, payload);
        },
        // [type.AddTodo]: (context, {payload}) => {
        //     updateTask(context, payload);
        // },
    },
})


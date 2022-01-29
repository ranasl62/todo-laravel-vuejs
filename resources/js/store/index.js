import Vue from 'vue';
import Vuex from 'vuex';
import type from './type';
import addTask from "./todo/add-task";
import fetchTasks from "./todo/fetch-tasks";
import fetchTask from "./todo/fetch-task";
import updateStatusTasks from "./todo/update-status-task";
import deleteTask from "./todo/delete-task";
import updateTask from "./todo/update-task";

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
        [type.UpdateTodoSetter]: (state, payload) => {
            state.todoList.data = state.todoList.data.map(task => payload.tuid === task.tuid ? payload : task);
        },
        [type.DeleteTodoSetter]: (state, tuid) => {
            state.todoList.data = state.todoList.data.filter(task => tuid !== task.tuid);
        },
        [type.UpdateTodoSetter]: (state, payload) => {
            state.todoList.data = state.todoList.data.map(task => payload.tuid === task.tuid ? payload : task);
        },
    },
    actions: {
        [type.AddTodoAction]: (context, payload) => {
            addTask(context, payload);
        },
        [type.FetchTodoList]: (context, payload) => {
            fetchTasks(context, payload);
        },
        [type.CurrentTodoAction]: (context, tuid) => {
            fetchTask(context, tuid);
        },
        [type.StatusUpdateTodoAction]: (context, url) => {
            updateStatusTasks(context, url);
        },
        [type.DeleteTodoAction]: (context, tuid) => {
            deleteTask(context, tuid);
        },
        [type.UpdateTodoAction]: (context, payload) => {
            updateTask(context, payload);
        },
    },
})


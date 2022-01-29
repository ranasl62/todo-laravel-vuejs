import httpClient from "../../lib/httpClient";
import type from "../type";

const fetchTasks = (context, url) => {
    try {
        httpClient(url || '/api/v1/todo', 'GET').then(async response => {
            const res = await response.json();
            context.commit(type.TodoListSetter, res.data);
            context.commit(type.MessageSetter, {message: res.message, isSuccess: true});

        });
    } catch (e) {
        context.commit(type.MessageSetter, {
            message: "Unable to fetch tasks! Please try again later",
            isSuccess: false
        });
    }
}
export default fetchTasks;


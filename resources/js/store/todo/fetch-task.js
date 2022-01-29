import httpClient from "../../lib/httpClient";
import type from "../type";

const fetchTasks = (context, id) => {
    try {
        httpClient('/api/v1/todo/' + id, 'GET').then(async response => {
            const res = await response.json();
            context.commit(type.CurrentTodoSetter, res.data);
        });
    } catch (e) {
        context.commit(type.MessageSetter, {
            message: "Unable to fetch tasks! Please try again later",
            isSuccess: false
        });
    }
}
export default fetchTasks;


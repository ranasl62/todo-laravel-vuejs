import httpClient from "../../lib/httpClient";
import type from "../type";

const fetchTasks = (context, url) => {
    httpClient(url || '/api/v1/todo', 'GET').then(async response => {
        const res = await response.json();
        context.commit(type.TodoListSetter, res.data);
    });
}
export default fetchTasks;


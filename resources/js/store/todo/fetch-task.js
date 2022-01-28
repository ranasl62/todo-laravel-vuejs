import httpClient from "../../lib/httpClient";
import type from "../type";

const fetchTasks = (context, id) => {
    httpClient('/api/v1/todo/' + id, 'GET').then(async response => {
        const res = await response.json();
        context.commit(type.CurrentTodoSetter, res.data);
    });
}
export default fetchTasks;


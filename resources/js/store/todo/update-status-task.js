import httpClient from "../../lib/httpClient";
import type from "../type";

const updateStatusTasks = (context, tuid) => {
    httpClient('/api/v1/todo/status/' + tuid, 'PUT').then(async response => {
        const res = await response.json();
        context.commit(type.CurrentTodoSetter, res.data);
    });
}
export default updateStatusTasks;


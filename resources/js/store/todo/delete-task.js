import httpClient from "../../lib/httpClient";
import type from "../type";

const deleteTasks = (context, tuid) => {
    try {
        httpClient('/api/v1/todo/' + tuid, 'DELETE').then(async response => {
            const res = await response.json();
            context.commit(type.DeleteTodoSetter, tuid);
        });
    } catch (e) {
        context.commit(type.DeleteTodoSetter, null);
    }
}
export default deleteTasks;


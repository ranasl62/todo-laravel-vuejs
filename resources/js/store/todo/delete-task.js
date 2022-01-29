import httpClient from "../../lib/httpClient";
import type from "../type";

const deleteTasks = (context, tuid) => {
    try {
        httpClient('/api/v1/todo/' + tuid, 'DELETE').then(async response => {
            const res = await response.json();
            context.commit(type.DeleteTodoSetter, tuid);
            context.commit(type.MessageSetter, {message: res.message[0], isSuccess: true});
        });
    } catch (e) {
        context.commit(type.MessageSetter, {message:"Unable to delete task! Please try again later",isSuccess: false});
    }
}
export default deleteTasks;


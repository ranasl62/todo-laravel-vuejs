import httpClient from "../../lib/httpClient";
import type from "../type";

const updateStatusTasks = (context, {tuid, body}) => {
    try {
        httpClient('/api/v1/todo/' + tuid, 'PUT', body).then(async response => {
            const res = await response.json();
            context.commit(type.UpdateTodoSetter, res.data);
            context.commit(type.MessageSetter, {message: res.message[0], isSuccess: true});
        });
    } catch (e) {
        context.commit(type.MessageSetter, {
            message: "Unable to update task status! Please try again later",
            isSuccess: false
        });
    }
}
export default updateStatusTasks;


import httpClient from "../../lib/httpClient";
import type from "../type";

const addTask = (context, payload) => {
    try {
        httpClient('/api/v1/todo', 'POST', payload).then(async response => {
            const res = await response.json();
            context.commit(type.TodoSetter, res.data);
            context.commit(type.MessageSetter, {message: res.message, isSuccess: true});
        });
    } catch (e) {
        context.commit(type.MessageSetter, {message: "Unable to add task! Please try again later", isSuccess: false});
    }
}
export default addTask;


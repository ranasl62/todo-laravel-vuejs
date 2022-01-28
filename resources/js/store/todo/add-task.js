import httpClient from "../../lib/httpClient";
import type from "../type";

const addTask = (context, payload) => {
    httpClient('/api/v1/todo', 'POST', payload).then(async response => {
        const res = await response.json();
        console.log(res,payload);
        context.commit(type.TodoSetter, res.data);
    });
}
export default addTask;


<template>
    <form @submit.prevent="onSubmit" class="add-form" v-if="Boolean(getCurrentTodoData && getCurrentTodoData.title)">
        <div class="form-control">
            <label>Task</label>
            <input type="text" :value="getCurrentTodoData.title" name="title" placeholder="Add Task"/>
        </div>

        <div class="form-control form-control-check">
            <label>Status</label>
            <input type="checkbox" :value="Boolean(getCurrentTodoData.status)"
                   :checked="Boolean(getCurrentTodoData.status)" name="status"/>
        </div>

        <input type="submit" :value="getCurrentTodoData? 'Update Task' : 'Save Task'" class="btn btn-block"/>
    </form>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import type from "../store/type";

export default {
    name: 'AddTask',
    methods: {
        onSubmit(e) {
            const title = e.target.elements.title._value
            const status = e.target.elements.status._value
            if (!title) {
                alert('Please add a task')
                return
            }
            if (this.getCurrentTodoData) {
                this.updateTodoMethod({
                    tuid: this.getCurrentTodoData.tuid,
                    body: {
                        ...this.getCurrentTodoData,
                        title,
                        status,
                    }
                });
            } else {
                this.addTodoMethod({
                    title,
                    status,
                });

            }

        },
        ...mapActions({
            addTodoMethod: type.AddTodoAction,
            updateTodoMethod: type.UpdateTodoAction,
        }),
    },
    computed: {
        ...mapGetters({
            getCurrentTodoData: type.CurrentTodoGetter,
        }),
    },
}
</script>

<style scoped>
.add-form {
    margin-bottom: 40px;
}

.form-control {
    margin: 20px 0;
}

.form-control label {
    display: block;
}

.form-control input {
    width: 100%;
    height: 40px;
    margin: 5px;
    padding: 3px 7px;
    font-size: 17px;
}

.form-control-check {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.form-control-check label {
    flex: 1;
}

.form-control-check input {
    flex: 2;
    height: 20px;
}
</style>

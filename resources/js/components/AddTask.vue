<template>
    <form @submit.prevent="onSubmit" class="add-form">
        <div class="form-control">
            <label>Task</label>
            <input type="text" v-model="title" name="title" placeholder="Add Task"/>
        </div>

        <div class="form-control form-control-check">
            <label>Status</label>
            <input type="checkbox" v-model="status" name="status"/>
        </div>

        <input type="submit" :value="getCurrentTodoData? 'Update Task' : 'Save Task'" class="btn btn-block"/>
    </form>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import type from "../store/type";

export default {
    name: 'AddTask',
    data() {
        return {
            title: '',
            status: false,
            tuid: '',
        }
    },
    methods: {
        ...mapMutations({
            selectCurrentTaskMethod: type.CurrentTodoSetter,
        }),

        onSubmit(e) {
            if (!this.title) {
                alert('Please add a task')
                return
            }
            if (this.getCurrentTodoData) {
                this.updateTodoMethod({
                    tuid: this.tuid,
                    body: {
                        tuid: this.tuid,
                        title: this.title,
                        status: this.status,
                    }
                });
            } else {
                this.addTodoMethod({
                    title: this.title,
                    status: this.status,
                });
            }

            this.status = false;
            this.title = '';
            this.tuid = '';
            this.selectCurrentTaskMethod(null);

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
    watch: {
        getCurrentTodoData(p, c) {
            if (!c) {
                this.title = p.title;
                this.status = p.status;
                this.tuid = p.tuid;
            }
            if (c && c.tuid !== this.tuid) {
                this.title = c.title;
                this.status = c.status;
                this.tuid = c.tuid;
            }
        }
    }
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

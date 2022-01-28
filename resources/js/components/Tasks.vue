<template>
    <div>
        <Task :key="task.id" v-for="task in tasks.data"
              @toggle-status="$emit('toggle-status', task.tuid)"
              @delete-task="$emit('delete-task', task.tuid)"
              :task="task"
        />
    </div>
</template>

<script>
import Task from './Task'

export default {
    name: 'Tasks',
    props: {
        tasks: Object,
    },
    components: {
        Task,
    },
    mounted() {
        console.log(this.tasks);
    },
    emits: ['delete-task', 'toggle-status'],
}
</script>

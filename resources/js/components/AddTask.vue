<template>
  <form @submit="onSubmit" class="add-form">
    <div class="form-control">
      <label>Task</label>
      <input type="text" v-model="title" name="text" placeholder="Add Task" />
    </div>

    <div class="form-control form-control-check">
      <label>Status</label>
      <input type="checkbox" v-model="status" name="status" />
    </div>

    <input type="submit" value="Save Task" class="btn btn-block" />
  </form>
</template>

<script>
export default {
  name: 'AddTask',
  data() {
    return {
      title: '',
      status: false,
    }
  },
  methods: {
    onSubmit(e) {
      e.preventDefault()

      if (!this.title) {
        alert('Please add a task')
        return
      }

      const newTask = {
        title: this.title,
        status: this.status,
      }

      this.$emit('add-task', newTask)

      this.text = ''
      this.status = false
    },
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

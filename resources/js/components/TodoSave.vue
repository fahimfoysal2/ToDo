<template>
    <!--save a To do item -->
    <div class="card mb-4">
        <div class="card-body">
            <form @submit.prevent="saveTodo">
                <div>
                    <input type="text" class="form-control pr-3 pb-3" placeholder="New To Do"
                           v-model="newToDoData">
                    <button type="submit" class="btn btn-dark mt-3">Save ToDo</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "TodoSave",
    data() {
        return {
            newToDoData: '',
            toDoId     : null,
        }
    },
    methods: {
        saveTodo() {
            let newTodo = {id: this.toDoId, data: this.newToDoData};

            if (this.newToDoData !== "") {
                if (this.toDoId) {
                    // update
                    axios.put("/todo/" + this.toDoId, newTodo);
                    this.toDos = this.toDos.filter(todo => {
                        if (this.toDoId === todo.id) {
                            todo.data = this.newToDoData;
                        }
                        return todo;
                    });
                } else {
                    // create
                    axios.post("/todo", newTodo)
                        .then(response => newTodo.id = response.data);

                    this.toParent(newTodo);
                }
            } else {
                alert("Empty Data");
            }
        },
        toParent(todo){
            this.$emit('savedTodo', todo);
        }
    }
}
</script>

<style scoped>

</style>

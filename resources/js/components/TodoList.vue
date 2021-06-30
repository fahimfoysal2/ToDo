<template>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <!--Create new To do -->
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

                <!-- My To do List -->
                <div class="card">
                    <div class="card-header">My Todo List</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="toDo in  toDos" :todo_id="toDo.id">
                                <span>{{ toDo.data }}</span>

                                <span>
                                    <button class="btn btn-sm btn-warning" @click="updateTodo(toDo.id, toDo.data)">
                                        Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger" @click="deleteTodo(toDo.id)">Delete</button>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props: {
        fetchedTodos: {
            type: Array
        },
    },
    data() {
        return {
            toDos      : this.fetchedTodos,
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
                        if (this.toDoId == todo.id) {
                            todo.data = this.newToDoData;
                        }
                        return todo;
                    });
                } else {
                    // create
                    axios.post("/todo", newTodo)
                        .then(response => newTodo.id = response.data);
                    this.toDos.push(newTodo);
                    this.toDoId = null;
                }
            } else {
                alert("Empty Data");
            }
        },

        deleteTodo(id) {
            axios.delete("/todo/" + id);
            this.toDos = this.toDos.filter(todo => {
                return todo.id !== id
            });
        },

        updateTodo(id, data) {
            this.toDoId      = id;
            this.newToDoData = data;
        }
    },
}
</script>

<style scoped>
.list-group-item {
    display: flex;
    justify-content: space-between;
}
</style>

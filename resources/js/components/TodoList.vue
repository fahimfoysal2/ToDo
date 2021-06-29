<template>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <!--Create new To do -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form @submit.prevent="save_todo" class="form-inline">
                            <input type="text" class="form-control" placeholder="New To Do" v-model="newToDoData">
                            <button type="submit" class="btn btn-dark">Save ToDo</button>
                        </form>
                    </div>
                </div>

                <!-- My To do List -->
                <div class="card">
                    <div class="card-header">My Todo List</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="toDo in  toDos" :todo_id="toDo.id">
                                {{ toDo.data }}
                                <button class="btn btn-sm btn-warning" @click="update_todo(toDo.id, toDo.data)"
                                        data-toggle="modal" data-target="#exampleModalCenter">Edit
                                </button>
                                <button class="btn btn-sm btn-danger" @click="delete_todo(toDo.id)">Delete</button>
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
        save_todo() {
            let newTodo = {id: this.toDoId, data: this.newToDoData};

            if (this.newToDoData !== "") {
                if (this.toDoId) {
                    // update
                    axios.put("/todo/" + this.toDoId, newTodo);
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
        delete_todo(id) {
            axios.delete("/todo/" + id);
            this.toDos = this.toDos.filter(todo => {
                return todo.id !== id
            })
        },
        update_todo(id, data) {
            this.toDoId      = id;
            this.newToDoData = data;
        }
    },
}
</script>

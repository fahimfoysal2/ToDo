<template>
    <div>
        <todo-save @savedTodo="savedTodoData"></todo-save>
        <!-- My To do List -->
        <div class="card">
            <div class="card-header">My Todo List</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="toDo in  toDos" :todo_id="toDo.id">
                        <span>{{ toDo.data }}</span>

                        <span>
                        <button class="btn btn-sm btn-warning">
                            <a :href="'todo/'+toDo.id+'/edit'">Edit</a>
                        </button>
                        <button class="btn btn-sm btn-danger" @click="deleteTodo(toDo.id)">Delete</button>
                    </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>

import TodoSave from "./TodoSave";

export default {
    props     : {
        fetchedTodos: {
            type: Array
        },
    },
    components: {
        TodoSave
    },
    beforeCreate() {
        if (typeof (Storage) !== "undefined") {
            let user = localStorage.getItem('user');
            if (user == null || user === '') {
                // console.log(JSON.parse(user));
                console.log("User not Set");
                window.location.assign('/login');
            } else {
                console.log("Logged in");
            }
        }
    },
    data() {
        return {
            toDos      : this.fetchedTodos,
            newToDoData: '',
            toDoId     : null,
        }
    },
    methods: {
        deleteTodo(id) {
            axios.delete("/todo/" + id);
            this.toDos = this.toDos.filter(todo => {
                return todo.id !== id
            });
        },

        savedTodoData(todo) {
            this.toDos.push(todo);
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

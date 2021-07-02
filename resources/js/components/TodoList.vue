<template>
    <div>
        <div class="pb-2">
            <button @click="logOut" class="btn btn-danger">Logout</button>
        </div>

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
    mounted() {
        axios.defaults.headers.common["Authorization"] = `Bearer ` + this.token;
        axios.get("/api/todo/")
            .then(response => {
                console.log(response.data.todos);
                this.toDos = response.data.todos;
            })
        ;
    },
    data() {
        return {
            toDos      : [],
            newToDoData: '',
            toDoId     : null,
        }
    },
    methods: {
        deleteTodo(id) {
            axios.defaults.headers.common["Authorization"] = `Bearer ` + this.token;
            axios.delete("/api/todo/" + id);
            this.toDos = this.toDos.filter(todo => {
                return todo.id !== id
            });
        },

        savedTodoData(todo) {
            this.toDos.push(todo);
        },
        logOut() {
            axios.defaults.headers.common["Authorization"] = `Bearer ` + this.token;
            axios.post("/api/logout");
            localStorage.removeItem("user");
            window.location.assign('/login')
        },
    },
    computed: {
        token() {
            let user = JSON.parse(localStorage.getItem('user'));
            return user.token;
        }
    }
}
</script>

<style scoped>
.list-group-item {
    display: flex;
    justify-content: space-between;
}
</style>

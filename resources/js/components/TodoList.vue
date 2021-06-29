<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card mb-4">
                    <div class="card-body">
                        <form @submit.prevent="save_todo" class="form-inline">
                            <input type="text" class="form-control" placeholder="New To Do" v-model="newToDo">
                            <button type="submit" class="btn btn-dark">Add item</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">My Todo List</div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="toDo in  toDos" :id="toDo.id">
                                {{ toDo.data }}
                                <button class="btn btn-sm btn-warning" @click="edit_todo(toDo.id)">Edit</button>
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
    data() {
        return {
            toDos     : [
                {
                    id  : 0,
                    data: "First To DO"
                }
            ],
            newToDo   : '',
            lastTodoId: 0,
        }
    },
    methods: {
        save_todo() {
            this.toDos.push({id: ++this.lastTodoId, data: this.newToDo});
        },
        delete_todo(id) {
            this.toDos = this.toDos.filter(todo => {
                return todo.id !== id
            })
        },
        edit_todo(id) {
            console.log(id);
        }
    },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>

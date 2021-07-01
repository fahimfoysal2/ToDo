<template>
    <div>
        <!-- update a To do item -->
        <div class="card mb-4">
            <div class="card-body">
                <form @submit.prevent="updateTodo">
                    <div>
                        <input type="text" class="form-control pr-3 pb-3" placeholder="New To Do"
                               v-model="updatedTodo.data">
                        <button type="submit" class="btn btn-dark mt-3">Update ToDo</button>
                        <button type="button" class="btn btn-success mt-3 text">
                            <a href="/" class="text-light">Go Back</a>
                        </button>
                        <span :class="{'text-success':status}">{{updateMessage}}</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: "TodoEdit",
    props: {
        todo: {
            type: Object
        }
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
            updatedTodo: {
                id: this.todo.id,
                data: this.todo.data,
            },
            status: null,
        }
    },
    methods: {
        updateTodo() {
            // update
            axios.defaults.headers.common['Authorization'] = `Bearer ` + this.token;
            axios.put("/api/todo/" + this.todo.id, this.updatedTodo)
                .then(response => this.status = true)
                .catch(error => this.status = false);
        }
    },
    computed: {
        token() {
            let user = JSON.parse(localStorage.getItem('user'));
            return user.token;
        },

        updateMessage(){
            return this.status ? "Data Updated" : "";
        }
    }
}
</script>

<style scoped>

</style>

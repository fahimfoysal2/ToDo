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
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name : "TodoEdit",
    props: {
        todo: {
            type: Object
        }
    },
    data() {
        return {
            updatedTodo: {
                id  : this.todo.id,
                data: this.todo.data,
            }
        }
    },
    methods: {
        updateTodo() {
            // update
            axios.put("/todo/" + this.todo.id, this.updatedTodo);

            alert("Data Updated");
        }
    }
}
</script>

<style scoped>

</style>

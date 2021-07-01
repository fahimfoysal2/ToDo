<template>
    <div>
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form @submit.prevent="register">
                    <div>
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Full Name" v-model="user.name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" v-model="user.email">
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" v-model="user.password">
                        </div>

                        <button type="submit" class="btn btn-dark mt-3">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
            },
            auth: ''
        }
    },
    methods: {
        register() {
            axios.post('/api/register', this.user)
                .then(response => this.auth = response.data)
        }
    }
}
</script>

<style scoped>

</style>

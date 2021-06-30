<template>
    <div>
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form @submit.prevent="login">
                    <div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" v-model="user.email">
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" v-model="user.password">
                        </div>

                        <button type="submit" class="btn btn-dark mt-3">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        let auth;
        return {
            user: {
                email   : "",
                password: "",
            },
            auth
        }
    },
    methods: {
        login() {
            axios.post('/api/login', this.user)
                .then(response => this.auth = response.data)
        }
    }
}
</script>

<style scoped>

</style>

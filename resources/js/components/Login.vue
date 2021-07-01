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

                        <div class="mt-3">
                            <button type="submit" class="btn btn-dark mr-3">Login</button>
                            Or, <a href="/register">Create New Account</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Login",
    beforeCreate() {
        if (typeof (Storage) !== "undefined") {
            let user = localStorage.getItem('user');
            if (user == null || user === '') {
                // console.log(JSON.parse(user));
                console.log("User not Set");
            } else {
                console.log("Logged in");
                window.location.assign('/todo');
            }
        }
    },
    data() {
        return {
            user: {
                email   : "",
                password: "",
            },
        }
    },
    methods: {
        login() {
            axios.post('/api/login', this.user)
                .then(response => {

                    // TODO: check if user is authenticated or not then store data

                    const user = {
                        token: response.data.access_token,
                        userId: response.data.user.id,
                        username: response.data.user.name,
                    };

                    if (typeof (Storage) !== "undefined") {
                        localStorage.setItem('user', JSON.stringify(user));
                    }
                });

        }
    }
}
</script>

<style scoped>

</style>

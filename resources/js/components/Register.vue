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
                        <div class="mt-3">
                            <button type="submit" class="btn btn-dark mr-3">Register</button>
                            Already have an Account? <a href="/login">Login</a>
                        </div>
                    </div>
                </form>
                <div class="mt-3"
                     :class="{'alert-success':regResponse.success, 'alert-danger':!regResponse.success}">
                    {{ regResponse.message }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",
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
                name: "",
                email: "",
                password: "",
            },
            regResponse: {
                success: '',
                message: '',
            }
        }
    },
    methods: {
        register() {
            let regResponse;
            axios.post('/api/register', this.user)
                .then(response => {
                    console.log(response.data);

                    this.regResponse.success = true;
                    this.regResponse.message = "Registration Successful"

                    this.user = {};
                })
                .catch(error => {
                    this.regResponse.success = false;
                    this.regResponse.message = (error.response.data.message);
                })
            ;
        }
    }
}
</script>

<style scoped>

</style>

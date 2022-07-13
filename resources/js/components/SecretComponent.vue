<template>
    <div class="container">
        <!-- login form -->
        <div class="row mt-4">
            <div class="col-6 offset-3">
                <form action="#" @submit.prevent="handleLogin">
                    <h3>Sign in for secrets</h3>
                    <div class="form-row">
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            v-model="formData.email"
                            placeholder="Email Address"
                        />
                    </div>
                    <div class="form-row">
                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            v-model="formData.password"
                            placeholder="Password"
                        />
                    </div>
                    <div class="row mt-4" v-if="err.length">
                        <h4 class="text-danger">
                            there is no account with this email and password
                        </h4>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-primary">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- secrets list -->
        <div class="row mt-4" v-if="secrets.length">
            <div class="col-6 offset-3">
                <h3>My secrets</h3>
                <h3>{{ secrets[0].token }}</h3>
                <h1>a</h1>
                <!-- <em v-text="secrets.token"></em><br>
                    <strong v-text="secret.user"></strong> -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:SecretComponent,
    data() {
        return {
            secrets: {},
            err: {},
            formData: {
                email: "",
                password: "",
            },
        };
    },
    methods: {
        handleLogin() {
            // send axios request to the login route
            axios.get("/sanctum/csrf-cookie").then((response) => {
                axios
                    .post("api/auth/login", this.formData)
                    .then((response) => {
                        this.secrets = [response.data.response];
                        console.log( this.secrets[0].user);
                        localStorage.setItem("userData", this.secrets[0].user); // to store the token
                        localStorage.setItem("userToken", this.secrets[0].token); // to store the token
                         console.log( localStorage.getItem("userData").firstName); // to getthe token value
                        // this.$router.push('home'); // to redirect to the home page
                        window.location.href = 'https://localhost:8000/home'; // to redirect to the home page
                    })
                    .catch((error) => {
                        this.err = [response.data];
                        console.log(this.err);
                    });
            });
        },
    },
};
</script>

<style>
.form-row {
    margin-bottom: 8px;
}
</style>

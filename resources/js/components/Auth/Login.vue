<template>
    <v-container>
        <v-form @submit.prevent="login">
            <v-text-field
                name="email"
                v-model="form.email"
                label="E-mail"
                required
            >
            </v-text-field>

            <v-text-field
                name="password"
                v-model="form.password"
                label="Password"
                required
            ></v-text-field>

            <v-btn color="success" type="submit"> Login </v-btn>
        </v-form>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: null,
                password: null
            }
        };
    },
    methods: {
        login() {
            axios
                .post("/api/v1/auth/login", this.form)
                .then(response => {
                    console.log(response.data);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style></style>

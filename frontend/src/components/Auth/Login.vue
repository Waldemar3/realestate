<template>
    <div class="login-container">
        <form class="login-form" @submit.prevent="login">
            <h2>Авторизация</h2>
            <ui-input v-model="details.name" placeholder="Введите ваш логин" required />
            <ui-input type="password" v-model="details.password" placeholder="Введите ваш пароль" required />
            <ui-button type="submit">Войти</ui-button>
        </form>
    </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
    data() {
        return {
            details: {
                name: '',
                password: '',
            }
        };
    },
    methods: {
        ...mapActions("auth", ["sendLoginRequest"]),

        login() {
            this.sendLoginRequest(this.details).then(() => this.$router.push('/'));
        }
    }
};
</script>

<style scoped>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-form {
        width: 300px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 128, 0, 0.2);
    }

    button {
        width: 100%;
        margin-top: 10px;
    }
</style>
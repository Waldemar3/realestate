<template>
<div class="login-container">
    <form class="login-form" @submit.prevent="login">
    <h2>Авторизация</h2>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="email" placeholder="Введите ваш email" required>
    </div>
    <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" v-model="password" placeholder="Введите ваш пароль" required>
    </div>
    <button type="submit">Войти</button>
    </form>
</div>
</template>

<script>
export default {

};
</script>

<style>
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

    .form-group {
    margin-bottom: 20px;
    }

    label {
    display: block;
    margin-bottom: 5px;
    }

    input {
    width: 100%;
    padding: 10px;
    border: 1px solid teal;
    border-radius: 5px;
    }

    button {
    width: 100%;
    padding: 10px;
    background-color: #008000;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    }
</style>
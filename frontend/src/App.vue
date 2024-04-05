<template>
  <div class="app">
    <nav>
      <router-link to="/houses">Дома</router-link>
      <router-link to="/settlements">Поселки</router-link>
    </nav>
    <ui-button @click="logout">Logout</ui-button>

    <router-view></router-view>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  methods: {
    ...mapActions("auth", ["sendLogoutRequest"]),

    logout() {
      this.sendLogoutRequest().then(()=>this.$router.push({ name: 'Login' }));
    }
  }
}
</script>

<style>
  *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  nav{
    display: flex;
    padding: 20px;
    width: 100%;
    justify-content: space-around;
    font-size: 30px;
  }
  .app{
    padding: 10px;
  }
</style>
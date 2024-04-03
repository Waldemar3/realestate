<template>
  <div class="app">
    <nav>
      <router-link to="/houses">Дома</router-link>
      <router-link to="/settlements">Поселки</router-link>
    </nav>

    <router-view></router-view>
  </div>
</template>

<script>
export default {
  
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
</style>
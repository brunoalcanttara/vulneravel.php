<template>
  <div>
    <input v-model="userInput" placeholder="Digite algo...">
    <p>Você digitou: {{ userInput }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userInput: ''
    };
  }
}
</script>

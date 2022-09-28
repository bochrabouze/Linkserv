<template>
     <div id="app">
    <v-app>
      <v-select
        item-text="name"
        item-value="last"
        v-model="defaultSelected"
        :items="people"
      >
      </v-select>
    </v-app>
    </div>


</template>

<script>
    Vue.use(Vuetify);

    var vm = new Vue({
      el: "#app",
      data: {
        defaultSelected: {
          name: "John",
          last: "Doe"
        },
        people: [
          {
            name: "John",
            last: "Doe"
          }, 
          {
            name: "Harry",
            last: "Potter"
          },
          {
            name: "George",
            last: "Bush"
          }
        ]
      }
    });
</script>

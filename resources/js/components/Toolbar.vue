
<template>
  <v-card color="grey lighten-4" text height="200px" tile>
    <v-toolbar dense>
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->

      <v-toolbar-title>miForum</v-toolbar-title>

      <v-spacer></v-spacer>
      <div class="hidden-sm-and-down">
        <router-link to="/forum">
          <v-btn text>Forum</v-btn>
        </router-link>
        <router-link to="/category">
          <v-btn text>Category</v-btn>
        </router-link>
        <router-link to="/question">
          <v-btn text>Create Question</v-btn>
        </router-link>
        <router-link to="/sign-in">
          <v-btn text>Sign In</v-btn>
        </router-link>
      </div>
    </v-toolbar>
  </v-card>
</template>




<script>
export default {
  data() {
    return {};
  },
};
</script>

<style>
</style>

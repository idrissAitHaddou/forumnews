<template>
   <div class="bg-body">
        <NavBar/>
        <HomeView/>
        <router-view/>
   </div>
</template>
<script>
import NavBar from './components/shared/NavBar.vue'
import HomeView from './Pages/views/HomeView.vue'
export default {
    setup: () => ({
        title: 'How To Install Vue 3 in Laravel 8 From Scratch'
    }),
    components : {
        NavBar,
        HomeView
    }
}
</script>
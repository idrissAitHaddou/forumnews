<template>
        <NavBar/>
        <div class="w-9/12 mx-auto mt-3 p-2">
            <TendanceComponent/>
            <PostsComponent/>
        </div>
        <ul>
            <li v-for="post in posts " :key="post.id">{{post.id}}</li>
        </ul>
</template>
<script>
import TendanceComponent from '../components/home/TendanceComponent.vue'
import PostsComponent from '../components/home/PostsComponent.vue'
import NavBar from '../components/shared/NavBar.vue'
export default {
    setup: () => ({
        title: 'Home page',
        posts : []
    }),
    props: {
      posts: Object,
    },
    components : {
        TendanceComponent,
        PostsComponent,
        NavBar
    },
    mounted () {
        
    },
    methods : {

    }
}
</script>
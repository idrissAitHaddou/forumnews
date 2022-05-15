<template>
   
    <p class="ml-2 mt-5">Publications populaires</p>
    <div class="flex item-center justify-between p-2">
    
        <div class="w-72 h-96 bg-white border">
            <ul v-for="category in categories" :key="category.id" class="w-full text-sm text-left font-medium text-black">
                <a href="#" @click="search(category.id)"><li class="w-full px-4 py-2 border border-t-0 border-l-0 border-r-0 border-bgray">{{category.name}}</li></a>
            </ul>
       </div>
       <div class="w-3/5 flex flex-col">

            <div v-for="post in posts" :key="post.id" class="w-full bg-white p-4 mb-3 border">
            <a :href='toDetails+post.id'>
                     <div class="flex item-center">
                         <img class="rounded-full mr-2" src="../../../../images/logo.svg" width="28" height="28" alt="">
                        <span class="ml-2 text-xs font-bold">{{post.user.name}}</span>
                       <span class="ml-2 text-xs">il ya {{post.added}}</span>
                    </div>
                     <p>
                         {{post.title}}
                        <br>
                         <template v-if="post.path=='http://127.0.0.1:8000/storage'">
                           <span class="text-gray-500">{{post.body.substr(0,200)}}...</span>
                         </template>
                    </p>
                   
                    <template v-if="post.path!='http://127.0.0.1:8000/storage'">
                            <router-link to="/post-details">
                               <img class="w-full h-80" :src="post.path" alt="">
                            </router-link>
                    </template>
                    <template v-if="post.pathVideo!='http://127.0.0.1:8000/storage'">
                               <video :src="post.pathVideo" controls class="w-full h-80"></video>
                    </template>
                    <div class="flex">
                            <p class="text-sm mt-3 mr-6 text-gray-600">
                                Commnets {{post.comments.length}}
                            </p>
                            <aside class="flex items-center mt-3 space-x-5">
                                <a href="#" class="inline-flex items-center text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1.5" fill="blue" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path></svg>
                                    <span>{{post.likes.length}}</span>
                                </a>
                            </aside>
                    </div>
                    </a>
            </div>


       </div>

       
    </div>
</template>
<script>

export default {
    data(){
      return{
           posts : [],
           categories : [],
           toDetails : '/post-details/'
      }
    },
    created(){
        this.getPosts()
        this.getCategories()
    },
    methods : {

        getPosts(){
        axios.get('/api/posts')
        .then(res=>{
            this.posts = res.data
            console.log('----------------------- posts ----------------------')
            console.log(this.posts)

        })
        .catch(err => console.log(err))
        },
         getCategories(){
        axios.get('/api/categories')
        .then(res=>{
            this.categories = res.data
            console.log('----------------------- categories ----------------------')
            console.log(this.categories)
        })
        .catch(err => console.log(err))
        },
        search(id){
             axios.get('/api/search-posts/'+id)
            .then(res=>{
                this.posts = res.data
                console.log('----------------------- posts search ----------------------')
                console.log(res.data)

            })
            .catch(err => console.log(err))
        }

    }
}
</script>

<style>


</style>
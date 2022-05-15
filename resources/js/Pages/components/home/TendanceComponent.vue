<template>

    <p class="ml-2">Derrière les postes</p>
    <div class="flex item-center justify-between p-2">
        <div v-for="postT in postsT" :key="postT.id" class="relative w-1/4 h-48 rounded-lg mx-1 p-1">
        <a :href='toDetails+postT.id'>
                <template v-if="postT.path!='http://127.0.0.1:8000/storage'">
                     <img :src="postT.path" class="w-full h-full rounded-lg" alt="">
                </template>
                <template v-if="postT.pathVideo!='http://127.0.0.1:8000/storage'">
                    <video :src="postT.pathVideo" controls class="w-full h-full rounded-lg"></video>
                </template>
                <template v-if="postT.path=='http://127.0.0.1:8000/storage' && postT.pathVideo=='http://127.0.0.1:8000/storage'">
                     <div class="w-full h-full bg-gray-500 rounded-lg" alt=""></div>
                </template>
               <div class="absolute bottom-0 left-0 py-1 px-2">
                    <h1 class="text-xl text-[#FFD36E] font-black"> {{postT.title}}</h1>
                    <p class="text-[#FFD36E]">
                        {{postT.body.substr(0,10)}}...
                    </p>
               </div>
        </a></div>
        
       
    </div>
</template>
<script>
export default {
    data(){
      return{
           ctr : 0,
           postsT : [],
            toDetails : '/post-details/'
      }
    },
    mounted(){
        this.getPostsT()
    },
    methods : {

        getPostsT(){

            axios.get('/api/last-posts')
            .then(response=>{
                this.postsT = response.data
                console.log('---------------------- tend ------------------')
                console.log(this.postsT)

            })
            .catch(err => console.log(err))
        }
    }
}
</script>

<style>



</style>
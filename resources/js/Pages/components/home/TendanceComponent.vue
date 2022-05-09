<template>

    <p class="ml-2">Derrière les postes</p>
    <div class="flex item-center justify-between p-2">
        <div v-for="postT in postsT" :key="postT.id" id="tendance-article" class="relative w-1/4 h-48 rounded-lg mx-1 p-1">
               <div class="absolute bottom-0 left-0 p-1">
                    <h1 class="text-xl text-[#FFD36E] font-black"> {{postT.title}}</h1>
                    <p class="text-[#FFD36E]">
                        {{postT.body.substr(0,10)}}...
                    </p>
               </div>
        </div>
        
       
    </div>
</template>
<script>
export default {
    data(){
      return{
           ctr : 0,
           postsT : []
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
                console.log(this.postsT)

            })
            .catch(err => console.log(err))
        }
    }
}
</script>

<style>

#tendance-article{
    background-image: url('../../../../images/tendanceIMG.jpg');
    background-repeat: no-repeat;
    background-position:center;
    background-size: cover;
}

</style>
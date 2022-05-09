<template>

    <div class="w-3/5 flex flex-col mx-auto mt-6">
              <!-- posts -->
             <div v-for="ispost in post" :key="ispost.id" class="w-full bg-white p-4 mb-3 w-3/4 mx-auto">
                    <div class="flex item-center">
                        <img class="rounded-full mr-2" src="../../../images/logo.svg" width="28" height="28" alt="">
                        <span class="ml-2 text-xs font-bold">{{ispost.user.name}}</span>
                        <span class="ml-2 text-xs">{{ispost.added}}</span>
                    </div>
                    <p>
                        {{ispost.title}}
                    </p>
                       <img class="w-full h-80" src="../../../images/tendanceIMG.jpg" alt="">
                    <div class="flex">
                            <p class="text-sm mt-3 mr-6 text-gray-600">
                                Commnets {{ispost.comments.length}}
                            </p>
                            <aside class="flex items-center mt-3 space-x-5">
                                <a href="#" class="inline-flex items-center text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1.5" fill="blue" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path></svg>
                                    <span>{{ispost.likes.length}}</span>
                                </a>
                            </aside>
                    </div>
            </div>

            <div class="w-full bg-white p-4 mb-3 w-3/4 mx-auto">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Comment</label>
                <textarea v-model="newComment" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg outline-0 border border-gray-100 dark:placeholder-gray-400" placeholder="Leave a comment..."></textarea>
                <button @click="addComment()" type="button" class="py-2.5 mt-2 outline-0 focus:drop-shadow px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">comment</button>
            </div>
            <div class="w-full flex flex-col bg-white p-4 mb-3 w-3/4 mx-auto">
                <!-- start comments -->
                    <div v-for="iscomment in post[0].comments" :key="iscomment.id" class="p-4 bg-white mb-2 rounded-lg border border-gray-200 shadow-sm dark:border-gray-600">
                            <div class="justify-between items-center mb-3 sm:flex">
                                <time class="mb-1 text-xs font-normal text-gray-700 sm:order-last sm:mb-0">{{iscomment.added}}</time>
                                <div class="text-sm font-normal text-gray-700">{{iscomment.username}}</div>
                            </div>
                        <div class="p-3 text-xs italic font-normal text-gray-700 bg-gray-50 rounded-lg border border-gray-200 dark:border-gray-500">
                            {{iscomment.comment}}
                        </div>
                    </div>
                <!-- end comments -->
            </div>
        

    </div>
</template>


<script>
export default {
    name: "postDetaillsView",
    data(){
      return{
           id : 0,
           post : [],
           newComment : ''
      }
    },
    created(){
        this.id = this.$page.props.id
        this.getPost()
    },
    methods : {
        getPost(){
                axios.get('/api/post/'+this.id)
                .then(res=>{
                    this.post = res.data
                })
                .catch(err => console.log(err))
        },
        addComment(){
            axios.post('/api/add-comment' , {
                comment : this.newComment,
                post_id : this.id
            })
            .then(res=>{
                console.log(res.data)
            })
            .catch(err => console.log(err))
        }
    }

}
</script>

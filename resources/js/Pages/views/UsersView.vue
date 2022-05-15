<template>
<NavBar/>
    <div class="mt-14 shadow-md sm:rounded-lg w-3/5 flex flex-col mx-auto mt-6">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id" class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{user.email}}
                    </th>
                    <td class="px-6 py-4">
                        {{user.name}}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="#" @click="toggleModal(user.id)" class="font-medium text-red hover:underline">Delete</a>
                    </td>
                </tr>
            
            </tbody>
        </table>

    </div>
        <!-- start pagination  -->

        <!-- <div class="mt-8 w-full flex item-center justify-center">
                    <nav aria-label="Page w-96 navigation example">
                        <ul class="inline-flex -space-x-px">
                            <li>
                            <a href="#" class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">Previous</a>
                            </li>
                            <li>
                            <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
                            </li>
                            <li>
                            <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                            </li>
                            <li>
                            <a href="#" class="py-2 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700">Next</a>
                            </li>
                        </ul>
                    </nav>
            </div> -->

        <!-- end pagination -->

        <!-- Delete Product Modal -->
       <div id="delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full mx-auto max-w-md h-full md:h-auto">
                 Modal content 
                <div class="relative bg-white mx-auto rounded-lg shadow dark:bg-gray-700">
                     Modal header 
                   <div class="flex justify-end p-2">
                        <button @click="toggleModal(0)" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                        </button> 
                    </div>
                    <!-- Modal body -->
                  <div class="p-6 pt-0 text-center">
                        <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this customer?</h3>
                        <button @click="deleteUser()" data-modal-toggle="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button @click="toggleModal(0)" data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                    </div>
                </div>
            </div>
     </div>
</template>


<script>
import NavBar from '../components/shared/NavBar.vue'
export default {
    name: "usersView",
    data(){
      return{
           users : [],
           id_to_delete_user : 0
      }
    },
    components : {
   NavBar
    },
    created ( ){
        axios.get('/api/users')
        .then(res=>{
            this.users = res.data
            console.log(this.users)
        })
        .catch(err => console.log(err))
    },
    methods : {
        toggleModal(id){
            const modal = document.getElementById('delete-modal');
            modal.classList.toggle('hidden');
            if(id === 0){
                this.id_to_delete_user = 0
            }else{
                this.id_to_delete_user = id
            }
        },
        deleteUser(){
            this.users = this.users.filter(user => user.id != this.id_to_delete_user)
            axios.post('/api/deleteUser' , { id : this.id_to_delete_user })
            .then(res=>{
                this.id_to_delete_user = 0
                console.log('is deleted')
                })
            .catch(err => console.log(err))
            }
    }

}
</script>

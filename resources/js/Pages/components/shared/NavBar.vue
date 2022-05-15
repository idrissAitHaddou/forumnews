<template>

    <nav class="bg-main border-0 px-2 sm:px-4 py-2.5 dark:bg-gray-800">
  <div class="container flex flex-wrap justify-between items-center mx-auto">
  <a href="/" class="flex items-center">
      <img src="../../../../images/logo.svg" class="mr-3 h-6 sm:h-9" width="100" height="100" alt="Flowbite Logo" />
  </a>
  <div class="flex items-center md:order-2">
      <Link href="/create" v-if="$page.props.user && $page.props.user.role=='user'">
      <!-- v-if="$page.props.user.role=='user'" -->
        <button class="flex mr-6 text-sm text-gray-300 border border-sky-500 p-2 rounded-lg">
          Create Post
        </button>
      </Link>
      <a href="/users" v-if="$page.props.user && $page.props.user.role=='admin'">
        <button class="flex mr-6 text-sm text-gray-300 border border-sky-500 p-2 rounded-lg">
          Users
        </button>
      </a>
      <a href="/login" v-if="!$page.props.user">
         <button class="flex mr-6 text-sm text-gray-300 border border-sky-500 p-2 rounded-lg">
          Sign In
      </button>
      </a>
       <a href="/register" v-if="!$page.props.user">
         <button class="flex mr-3 text-sm text-gray-300 border border-sky-500 p-2 text-white rounded-lg">
          Sign Up
      </button>
       </a>
      <a href="/user/profile" v-if="$page.props.user">
         <button class="flex mr-3 text-sm text-gray-300 border border-sky-500 p-2 text-white rounded-lg">
           Profile
          </button>
       </a>
      <!-- <button class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" type="button" data-dropdown-toggle="dropdown">
        <span class="sr-only">Open user menu</span> -->
        <!-- <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
      </button> -->
      <!-- Dropdown menu -->
      <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
        <div class="py-3 px-4">
          <span class="block text-sm text-gray-900 dark:text-white">Bonnie Green</span>
          <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">name@flowbite.com</span>
        </div>
       <h1 class="text-3xl text-gray-300 font-bold">LJADID</h1>
      </div>
      <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
      <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
  </div>
  <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
      <h1 class="text-gray-300 text-3xl font-bold">LJADID</h1>
  </div>
  </div>
</nav>

</template>
<script>
import {Link} from '@inertiajs/inertia-vue3'
export default {
    setup: () => ({
        nav: 'this is navbar'
    }),
    components : {
      Link
    }
}
</script>
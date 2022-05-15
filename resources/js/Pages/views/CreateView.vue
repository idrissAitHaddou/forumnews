<template>
    <NavBarVue />
    <div class="w-3/5 flex flex-col mx-auto mt-6">
        <form @submit.prevent="addPost()" class="w-1/2 mx-auto mt-4" enctype="multipart/form-data">
            <div class="mb-6">
                <h3>{{ error }}</h3>
            </div>
            <div class="mb-6">
                <label
                    for="title"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Title</label
                >
                <input
                    v-model="form.title"
                    type="text"
                    id="title"
                    class="bg-gray-50 outline-main border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Title"
                    required
                />
                <span class="text-red-500">{{ errorTitle }}</span>
            </div>
            <div class="mb-6">
                <label
                    for="body"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    ><Datag>Body</Datag></label
                >
                <textarea
                    v-model="form.body"
                    id="body"
                    rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg outline-main"
                    placeholder="Leave a body..."
                    required
                ></textarea>
                <span class="text-red-500">{{ errorBody }}</span>
            </div>
            <div class="mb-6">
                <label
                    for="title"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Category</label
                >
                <select
                    v-model="form.category_id"
                    type="text"
                    id="title"
                    class="bg-gray-50 outline-main border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Title"
                    required
                >
                    <option
                        v-for="iscategory in categories"
                        :key="iscategory.id"
                        :value="iscategory.id"
                    >
                        {{ iscategory.name }}
                    </option>
                </select>
                <span class="text-red-500">{{ errorCategory }}</span>
            </div>
            <div class="mb-6">
                <label
                    for="image"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Upload Photo / video</label
                >
                <input
                    type="file"
                    @input="form.image = $event.target.files[0]"
                    name="image"
                    id="image"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                />
            </div>
            <button
                 type="submit"
                 class="bg-red-400 mb-24 text-white rounded-lg py-2 px-7"
            >
                 Create
            </button>
        </form>
    </div>
</template>

<script>
import NavBarVue from "../components/shared/NavBar.vue";

export default {
    name: "createView",
     data () {
        return {
            error: "",
            errorTitle: "",
            errorBody: "",
            errorCategory: "",
            categories: [],
            form: this.$inertia.form({
                title: null,
                category_id: null,
                body: null,
                user_id:this.$page.props.user.id,
                image: null,
            }),
        };
    },
    components: {
        NavBarVue,
    },
    created() {
            axios.get("/api/categories")
            .then((res) => {
                this.categories = res.data;
                console.log(this.categories);
            })
            .catch((err) => console.log(err));
    },
    methods: {
        addPost() {
          this.form.post('/api/add-post')
        }
    }

}


</script>

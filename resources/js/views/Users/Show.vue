<template>
    <div class="flex flex-col items-center mb-8">
        <div class="relative">
            <div class="w-100 h-64 overflow-hidden z-10">
                <img src="https://static.wixstatic.com/media/09a3d5_55fd1b81f9094845ae7e43ec23c869b6~mv2_d_3072_2048_s_2.jpg" class="object-cover w-full">
            </div>
            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                <div class="w-32">
                    <img class="object-cover w-32 h-32 border-4 boder-gray-200 rounded-full shadow-lg" src="https://cdn.pixabay.com/photo/2014/07/09/10/04/man-388104_960_720.jpg" alt="">
                </div>
                <p class="text-2xl text-gray-100 ml-4">{{user.data.attributes.name}}</p>
            </div>
        </div>

        <p v-if="postLoding">Loding posts...</p>

        <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"/>
        <p v-if="!postLoading && posts.data.length < 1" >No posts found. Get started</p>
    </div>
</template>
<script>

import Post from '../../components/Post'

export default {
    name: "Show",
    components: {
        Post
    },
    data: () => {
        return {
            user: null,
            userLoading: true,
            postLoading: true,
            posts: null
        };
    },
    mounted(){
        axios.defaults. baseURL = 'http://localhost/facebook-clone/public/'
        axios.get('/api/users/' + this.$route.params.userId)
            .then(res => {
                this.user = res.data;
            }).catch(error => {
                console.log('Unable to featch the user from the server.')
            }).finally(() => {
                this.userLoading = false;
            });
         axios.get('/api/users/' + this.$route.params.userId + '/posts')
            .then(res => {
                this.posts = res.data;
            })
            .catch(error => {
                console.log("Unable to featch posts");
            }).finally(() => {
                this.postLoading = false;
            });;
    },
}
</script>

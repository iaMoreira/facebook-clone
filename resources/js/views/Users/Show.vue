<template>
    <div class="flex flex-col items-center mb-8" v-if="user && posts">
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
            <div class="absolute flex items-center bottom-0 right-0 mb-4 mr-12 z-20">
                <button v-if="friendButtonText && friendButtonText !== 'Accept'"
                    class="py-1 px-3 bg-gray-400 rounded"
                    @click="$store.dispatch('sendFriendRequest',$route.params.userId)">
                    {{friendButtonText}}
                </button>
                <button v-if="friendButtonText && friendButtonText === 'Accept'"
                    class="mr-2 py-1 px-3 bg-blue-500 rounded"
                    @click="$store.dispatch('acceptFriendRequest',$route.params.userId)">
                    Accept
                </button>
                <button v-if="friendButtonText && friendButtonText === 'Accept'"
                    class="py-1 px-3 bg-gray-400 rounded"
                    @click="$store.dispatch('ignoreFriendRequest',$route.params.userId)">
                    Ignore
                </button>


            </div>
        </div>

        <p v-if="postLoading && posts != undefined ">Loding posts...</p>

        <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"/>
        <p v-if="!postLoading && posts.data.length < 1" >No posts found. Get started</p>
    </div>
</template>
<script>

import Post from '../../components/Post'
import {mapGetters} from 'vuex';
export default {
    name: "Show",
    components: {
        Post
    },
    data: () => {
        return {
            postLoading: true,
            posts: undefined
        };
    },
    mounted(){
        axios.defaults. baseURL = 'http://localhost/facebook-clone/public/';
        this.$store.dispatch('fetchUser', this.$route.params.userId);

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

    computed: {
        ...mapGetters({
            user: 'user',
            friendButtonText: 'friendButtonText'
        })
    }
}
</script>

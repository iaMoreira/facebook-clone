<template>
    <div class="flex flex-col items-center py-4" v-if="posts">
        <NewPost />
        <p v-if="loding">Loding posts...</p>

        <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post"/>
    </div>
</template>

<script>
    import NewPost from '../components/NewPost';
    import Post from '../components/Post';

    export default {
        name: "NewsFeed",

        components: {
            NewPost,
            Post,
        },
        data: () =>{
            return {
                posts: null,
                loding: true,
            }
        },

        mounted() {
            axios.get('api/posts')
            .then(res => {
                this.posts = res.data;
                this.loding = false;
            })
            .catch(error => {
                this.loding = false;
                console.log("Unable to featch posts");
            });
        }
    }
</script>

<style scoped>

</style>

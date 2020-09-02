<template>
    <div class="home">
        <h2>Welcome {{ email }}</h2>
    </div>
</template>

<script>
    export default {
        name: 'Home',
        props: ['email'],
        data(){
            return{

            }
        }
    }
</script>

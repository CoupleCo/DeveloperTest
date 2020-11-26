<template>
    <div>
        <header class="flex p-6 bg-purple-darker justify-between">
            <div class="">
                <a href="/app"><h2 class="text-white">Dev Test</h2></a>
            </div>
            <div class="flex">
                <router-link to="/" class="text-white ml-6" v-show="loggedIn">Dashboard</router-link>
                <a href="#" @click="logout" v-show="loggedIn" class="text-white ml-6">Logout</a>
            </div>
        </header>
        <main class="contain py-4">
            <slot></slot>
        </main>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loggedIn: false
            }
        },
        mounted() {
            let token = localStorage.getItem('token')
            this.loggedIn = !token ? false : true 
        },
        methods: {
            logout() {
                axios.post('/api/logout', {}, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}` 
                    }
                })
                .then(response => {
                    localStorage.clear()
                    this.$router.push('/login')
                })
                .catch(err => {
                    alert(err.message)
                    console.log('Err: ', err)
                })
            }
        }
    };
</script>

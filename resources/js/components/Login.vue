<template>
    <div class="container">
        <div class="justify-center">
            <div class="justify-center">
                <div class="bg-purple-darker input-contain-shadow p-8 w-1/3 rounded  container mx-auto justify-center items-center">
                    <h2 class="input-header w-5/6 font-extrabold p-4 mb-4 text-grey-light">Log In</h2>
                    <div class="group input bg-white border-0">
                        <input type="text" required="required" v-model="email">
                        <label class="text-grey label" for="text">E-mail</label>
                    </div>
                    <div class="input group bg-white border-0">
                        <input type="password" required="required" v-model="password">
                        <label class="text-grey label" for="password">Password</label>
                    </div>
                    <button @click="login" class="input input-button mb-8 w-full">Log In</button>
                    <router-link class="text-grey-light" to="/register">Register here</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                token: '',
                email: '',
                password: ''
            }
        },
        mounted() {
        },
        methods: {
            login() {
                let payload = {email: this.email, password: this.password}
                axios.post('/api/login', payload)
                .then(response => {
                    this.token = response.data.token
                    localStorage.setItem('token', this.token)
                    setTimeout(() => {
                        this.$router.push({ name: 'dashboard' })
                    }, 200)
                })
                .catch(err => {
                    this.password = ''
                    alert(err.message)
                    console.log('Err: ', err)
                })
            }
        }
    };
</script>

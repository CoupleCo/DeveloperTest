<template>
    <Layout>
        <div class="justify-center">
            <div class="justify-center">
                <form @submit.prevent="register" class="bg-purple-darker input-contain-shadow p-8 w-1/3 rounded  container mx-auto justify-center items-center">
                    <h2 class="input-header w-5/6 font-extrabold p-4 mb-4 text-grey-light">Register</h2>
                    <div class="group input bg-white border-0">
                        <input type="text" required="required" v-model="name">
                        <label class="text-grey label" for="text">Name</label>
                    </div>
                    <div class="group input bg-white border-0">
                        <input type="email" required="required" v-model="email">
                        <label class="text-grey label" for="text">E-mail</label>
                    </div>
                    <div class="input group bg-white border-0">
                        <input type="password" required="required" v-model="password">
                        <label class="text-grey label" for="password">Password</label>
                    </div>
                    <div class="input group bg-white border-0">
                        <input type="password" required="required" v-model="password_confirmation">
                        <label class="text-grey label" for="password">Retype Password</label>
                    </div>
                    <button type="submit" class="input input-button mb-8 w-full">Submit</button>
                </form>
            </div>
        </div>
    </Layout>
</template>

<script>
    import Layout from './Layout'

    export default {
        data() {
            return {
                token: '',
                email: '',
                password: '',
                password_confirmation: '',
                name: ''
            }
        },
        components: {
            Layout
        },
        methods: {
            register() {
                let payload = {
                    email: this.email,
                    password: this.password,
                    name: this.name,
                    password_confirmation: this.password_confirmation
                }
                axios.post('/api/register', payload)
                .then(response => {
                    this.token = response.data.token
                    localStorage.setItem('token', this.token)
                    setTimeout(() => {
                        this.$router.push({ name: 'dashboard' })
                    }, 200)
                })
                .catch(err => {
                    this.password = ''
                    this.password_confirmation = ''
                    alert(err.message)
                    console.log('Err: ', err)
                })
            }
        }
    };
</script>

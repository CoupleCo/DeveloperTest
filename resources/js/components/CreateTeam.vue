<template>
    <Layout>
        <div class="justify-center">
            <div class="justify-center">
                <form @submit.prevent="save" class="bg-purple-darker input-contain-shadow p-8 w-3/5 rounded  container mx-auto justify-center items-center">
                    <h2 class="input-header w-5/6 font-extrabold p-4 mb-4 text-grey-light">Create Team</h2>
                    <div class="group input bg-white border-0">
                        <input type="text" required="required" v-model="name">
                        <label class="text-grey label" for="text">Name</label>
                    </div>
                    <div class="input group bg-white border-0">
                        <textarea class="w-full h-full" required="required" v-model="description" rows="3"></textarea>
                        <label class="text-grey label" for="password">Description</label>
                    </div>
                    <button type="submit" class="input input-button mb-8 w-full">Save</button>
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
                name: '',
                description: ''
            }
        },
        components: {
            Layout
        },
        methods: {
            save() {
                let payload = {name: this.name, description: this.description}
                axios.post('/api/teams', payload, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}` 
                    }
                })
                .then(response => {
                    console.log('Team: ', response)
                    setTimeout(() => {
                        this.$router.push({ name: 'dashboard' })
                    }, 200)
                })
                .catch(err => {
                    alert(err.message)
                    console.log('Err: ', err)
                })
            }
        }
    };
</script>

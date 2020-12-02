<template>
    <Layout>
        <div class="justify-center">
            <div class="justify-center">
                <form @submit.prevent="sendInvite" class="container bg-purple-darker input-contain-shadow p-8 w-3/5 rounded mx-auto justify-center items-center">
                    <h3 class="input-header font-extrabold p-4 mb-4 text-grey-light">Invite a Member to join {{team.name}}</h3>
                    <div class="group input bg-white border-0">
                        <input type="email" required="required" v-model="email">
                        <label class="text-grey label" for="text">Email</label>
                    </div>
                    <button type="submit" class="input input-button mb-8 w-full">Send</button>
                </form>
            </div>
        </div>
    </Layout>
</template>

<script>
    import Layout from './Layout'
    import client from '../httpService'

    export default {
        data() {
            return {
                email: '',
                team: JSON.parse(localStorage.getItem('team'))
            }
        },
        components: {
            Layout
        },
        methods: {
            sendInvite() {
                let payload = {email: this.email, team_id: this.team.id}
                client.service.post('/api/invites', payload)
                .then(response => {
                    alert("Invitation email sent!")
                    setTimeout(() => {
                        this.$router.push(`/team/${this.team.id}`)
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

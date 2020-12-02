<template>
    <Layout>
        <div class="justify-center">
            <div class="justify-center">
                <div class="bg-purple-darker input-contain-shadow p-8 w-3/5 rounded  container mx-auto justify-center items-center">
                    <p class="text-white">{{message}} <span v-show="team" class="text-white">joined {{team.name}}</span></p>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
    import Layout from './Layout'

    export default {
        data() {
            return {
                message: 'Processing...',
                team: null
            }
        },
        components: {
            Layout
        },
        mounted() {
            setTimeout(() => {
                this.acceptInvite()
            }, 1000)
        },
        methods: {
            acceptInvite() {
                axios.get(`/api/invites/${this.$route.params.token}`, {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    console.log(response)
                    this.team = response.data.team
                    this.message = 'Successfully ';
                })
                .catch(err => {
                    alert(err.message)
                    console.log('Err: ', err)
                })
            },
        }
    };
</script>

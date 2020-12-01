<template>
    <Layout>
        <button @click="gotoCreateTeam" class="btn btn-pink md:w-1/3 xl:w-1/6 ml-auto">Create Team</button>
        <div v-if="teams.length > 0" class="my-6 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-4">

            <div class="contain contain-shadow bg-white rounded-lg" v-for="team in teams">
                <router-link :to="/team/ + team.id"><h4>{{team.name}}</h4></router-link>
                <p class="text-lg">
                    {{team.description}}
                </p>
                <span class="flex text-xs justify-end bottom-0">Created by: {{team.owner.name}}</span>
            </div>
        </div>
        <div v-else class="flex justify-center">
            <h3>No Teams Created</h3>
        </div>
    </Layout>
</template>

<script>
    import Layout from './Layout'

    export default {
        data() {
            return {
                teams: []
            }
        },
        mounted() {
            this.getTeams()
        },
        components: {
            Layout
        },
        methods: {
            getTeams() {
                axios.get('/api/teams', {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}` 
                    }
                })
                .then(response => {
                    this.teams = response.data.teams
                })
                .catch(err => {
                    alert(err.message)
                    console.log('Err: ', err)
                })
            },
            gotoCreateTeam() {
                this.$router.push('/create-team')
            }
        }
    };
</script>

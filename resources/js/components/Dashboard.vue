<template>
    <div class="">
        <button @click="gotoCreateTeam" class="btn btn-pink md:w-1/3 xl:w-1/6 ml-auto">Create Team</button>
        <div v-if="teams.length > 0">
            <div class="contain contain-shadow" v-for="team in teams">
                <h3>{{team.name}}</h3>
                <p>
                    {{team.description}}
                </p>
            </div>
        </div>
        <div v-else class="flex justify-center">
            <h3>No Teams Created</h3>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                teams: []
            }
        },
        mounted() {
            this.getTeams()
        },
        methods: {
            getTeams() {
                axios.get('/api/teams')
                .then(response => {
                    this.teams = response.data.teams
                    console.log("teams: ", this.teams)
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

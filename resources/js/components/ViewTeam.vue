<template>
    <Layout>
        <div class="">
            <div class="md:flex">
                <div class="contain md:w-2/5 w-full">
                    <h3>{{team.name}}</h3>
                    <p class="text-sm">{{team.description}}</p>
                    <hr class="my-4" />
                    <div class="md:flex items-center mb-4 md:justify-between">
                        <h4 class="md:w-1/2 mb-4 md:mb-0">Team Members</h4>
                        <button @click="showInviteForm" class="btn btn-grey-inverse">Invite</button>
                    </div>
                    <hr class="my-4" />
                    <ul>
                        <li class="my-1">{{team.owner.name}}</li>
                        <li v-for="user in team.members" class="my-1">{{user.name}}</li>
                    </ul>
                </div>
                <div class="contain md:w-3/5 w-full">
                    <h4>Pictures</h4>
                    <div class="md:grid md:grid-cols-3 gap-4">
                        <img src="https://images.pexels.com/photos/3153198/pexels-photo-3153198.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="shadow-md rounded-md md:rounded-lg md:my-0 my-4 w-full">
                        <img src="https://images.pexels.com/photos/1546105/pexels-photo-1546105.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="shadow-md rounded-md md:rounded-lg md:my-0 my-4 w-full">
                        <img src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="shadow-md rounded-md md:rounded-lg md:my-0 my-4 w-full">
                        <img src="https://images.pexels.com/photos/3184423/pexels-photo-3184423.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="shadow-md rounded-md md:rounded-lg md:my-0 my-4 w-full">
                        <img src="https://images.pexels.com/photos/3228812/pexels-photo-3228812.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="shadow-md rounded-md md:rounded-lg md:my-0 my-4 w-full">
                        <img src="https://images.pexels.com/photos/3810792/pexels-photo-3810792.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" class="shadow-md rounded-md md:rounded-lg md:my-0 my-4 w-full">
                    </div>
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
                team: {}
            }
        },
        components: {
            Layout
        },
        mounted() {
            this.getTeam()
        },
        methods: {
            getTeam() {
                axios.get(`/api/teams/${this.$route.params.id}`, {
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}` 
                    }
                })
                .then(response => {
                    console.log(response)
                    this.team = response.data.team
                })
                .catch(err => {
                    alert(err.message)
                    console.log('Err: ', err)
                })
            },

            showInviteForm() {
                this.$router.push(`/team/${this.team.id}/invite`)
            }
        }
    };
</script>

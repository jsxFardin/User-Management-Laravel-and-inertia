<script setup>
    import BreezeCard from "@/Components/Card.vue";
    import BreezeInput from "@/Components/Input.vue";
    import Button from "@/Components/Button.vue";
    import BreezeLabel from "@/Components/Label.vue";
    import { computed, reactive } from "@vue/runtime-core";
    import BreezeButton from "@/Components/Button.vue";

    let data = reactive({
        teamNames: props.formData.id ? props.teamNames : [props.teamNames],
    })
    const props = defineProps({
        formData: Object,
        teamNames: Object,
        roles: Object,
        agency: Object,
        position: Object
    })
    const getAgency = computed(() => storeData.getters.getAuthUser.agencies )

    const getTeam = (event, index) => {
        if (event != null) {
            const params = {
                params: {
                    'agency_id': event,
                }
            }
            props.formData.row[index].team_id = []
            axios.get(`ajax/team-details`, params)
            .then((response)=>{
                if(typeof response.data == 'object') {
                    data.teamNames[index] = response.data
                }
            })
            .catch((error)=>{
                toast.warning(error)
            })
        } else {
            props.formData.row[index].team_id = []
            data.teamNames[index] = []
        }
    }
    const addRow = () => {
        let agency = []
        for(let item of props.formData.row) {
            if(item.agency_id != "" && item.agency_id != null) {
                agency.push(item.agency_id)
            }
        }
        if(agency.length > 0) {
            props.agency.map(function (item) {
                if (agency.includes(item.value)) {
                    item.disabled = true
                } else {
                    item.disabled = false
                }
            })
            let obj = {
                agency_id: '',
                team_id: []
            }
            props.formData.row.push(obj)
            props.formData.errors = {}
        } else {
            props.formData.errors[`row.0.agency_id`] = 'Please select agency first.'
        }
        
    }
    const deleteRow = (index, agency_id) => {
        data.teamNames.splice(index, 1)
        props.formData.row.splice(index, 1)
        props.agency.map(function (item) {
            if(item.value == agency_id) {
                item.disabled = !item.disabled
            }
            
        })
    }

</script>

<template>
    <div class="form-row">
        <div class="form-group col-md-6">
            <BreezeLabel for="name" value="Name" />
            <BreezeInput id="name" type="text" class="form-control" v-model="props.formData.name" autofocus
                placeholder="Name" :autocomplete="props.formData.name" :error="props.formData.errors.name" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="username" value="User Name" />
            <BreezeInput id="username" type="text" class="form-control" v-model="props.formData.username"
                autofocus placeholder="username" :autocomplete="props.formData.username" :error="props.formData.errors.username" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="form-control" v-model="props.formData.email"
                autofocus placeholder="Email" :autocomplete="props.formData.email" :error="props.formData.errors.email" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="form-control" v-model="props.formData.password"
                placeholder="Password" autofocus :autocomplete="props.formData.password" :error="props.formData.errors.password" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="mobile" value="Phone" />
            <BreezeInput id="mobile" type="phone" class="form-control" v-model="props.formData.mobile"
                autofocus placeholder="Phone" :autocomplete="props.formData.mobile" :error="props.formData.errors.mobile" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="position_id" value="Position" />
            <multi-select v-model="props.formData.position_id" :options="position"
                :searchable="true" :placeholder="'Choose a position'"
            ></multi-select>
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="roles" value="Roles" />
            <multi-select v-model="props.formData.roles" :options="roles"
                :searchable="true" :placeholder="'Choose a role'"
            ></multi-select>
        </div>
    </div>

    <hr>
    <div class="form-row mb-4" v-if="getAgency.length > 0">
        <div class="col-md-12">
            <button class="btn btn-info btn-sm float-right" type="button" @click="addRow">
                <font-awesome-icon :icon="['fas', 'plus']" />Add
            </button>
        </div>

        <div class="row col-md-12" v-for="(input, index) in formData.row" :key="index">
            <div class="col-md-5">
                <div class="form-group" >
                    <BreezeLabel for="agency_id" value="Agency Name" />
                    <multi-select v-model="input.agency_id" :options="agency" :searchable="true"
                        placeholder="Choose a agency" @change="getTeam($event, index)"/>
                    <span v-if="props.formData.errors[`row.${index}.agency_id`]" class="text-danger"> 
                            {{ props.formData.errors[`row.${index}.agency_id`] }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" >
                    <BreezeLabel for="team_id" value="Team Name" />
                    <multi-select v-model="input.team_id" :options="data.teamNames[index]"
                        placeholder="Choose a team" :searchable="true" mode="tags" />
                    <span v-if="props.formData.errors[`row.${index}.team_id`]" class="text-danger"> 
                            {{ props.formData.errors[`row.${index}.team_id`] }}</span>
                </div>
            </div>
            <div class="m-auto col-md-1" >
                <div class="form-group mt-2" v-if="index != 0">
                    <button type="button" class="btn btn-danger btn-sm float-right" 
                        @click="deleteRow(index, input.agency_id)">
                        <font-awesome-icon :icon="['fas', 'trash']" /> Remove
                    </button>
                </div>
            </div>
        </div>
    </div>

    <BreezeButton
        class="btn btn-success float-right"
        :disabled="formData.processing"
        >Save</BreezeButton>
</template>

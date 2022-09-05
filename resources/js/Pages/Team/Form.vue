<script setup>

    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { reactive } from 'vue';
    import { Inertia } from "@inertiajs/inertia";
    import { watch } from '@vue/runtime-core';

    const propsData = defineProps({
        formData: Object,
        agencies: Object,
        campNames: {
            type: Array,
            default: null
        },
        blockNames: {
            type: Array,
            default: null
        },
        password: {
            type: Boolean,
            default: true
        },
    })

    let data = reactive({
        campNames: propsData.campNames ?? null,
        blockNames: propsData.blockNames ?? null,
        password: propsData.password,
        campCount: (propsData.campNames && propsData.campNames.length > 0) ? propsData.campNames.length : "",
        assigns: []
    })

    const getBlock = (event) => {
        if(event != null) {
            const params = {
                params: {
                    'agency_id': event,
                }
            }
            propsData.formData.assigns = []
            data.campNames = null
            data.blockNames = null

            axios.get(`ajax/block-details`, params)
                .then((response)=>{
                    const campItems = response.data.camps
                    // console.log(campItems, 'campItems')
                    if(Object.keys(campItems).length != 0){
                        for (let i = 0; i < Object.keys(campItems).length; i++) {
                            let objAppend = {
                                camp_id         : campItems[i]['value'],
                                block_id        : [],
                            }
                            propsData.formData.assigns.push(objAppend)
                        }
                    }

                    data.campNames  = campItems
                    data.blockNames = response.data.blocks
                    data.campCount  = campItems.length
                })
                .catch((error)=>{
                    console.error(error, 'error')
                    toast.warning(error)
                })
        }
    }
    const checkUserAndAgent = () => {
        if(propsData.formData.email != "") {
            const params = {
                params: {
                    'email': propsData.formData.email,
                    'mobile': propsData.formData.mobile,
                }
            }
            axios.get('ajax/user-details', params)
            .then((response)=>{
                let data = response.data
                if (data.user != null){
                    setAndUnsetFormData(data)
                }
                else {
                    setAndUnsetFormData([])
                }
            })
            .catch((error)=>{
                toast.warning(error)
            })
        }
    }
    const setAndUnsetFormData = (params) => {
        propsData.formData.role_id          = (params.user && params.user.role_id) ?? ''
        propsData.formData.user_id          = (params.user && params.user.id) ?? ''
        propsData.formData.mobile           = (params.user && params.user.mobile) ?? ''
        propsData.formData.contact_person   = (params.user && params.user.name) ?? ''
        propsData.formData.agency           = params.agency ?? []
        propsData.formData.team             = params.team ?? []
        data.password                       = (params.user && params.user.id) ? false : true
    }
    const deleteRow = (index) => {
        const _data = {
            camp_id  : data.campNames[index],
            block_id : data.blockNames[index],
        }
        data.assigns.push(_data)

        data.campNames.splice(index, 1)
        data.blockNames.splice(index, 1)
        propsData.formData.assigns.splice(index, 1)
    }
    const addRow = () => {
        if(data.assigns.length >= 1){
            for(let item of data.assigns) {
                propsData.formData.assigns.push({
                    camp_id  : "",
                    block_id : [],
                })
                data.campNames.push(item.camp_id)
                data.blockNames.push(item.block_id)
            }
        }
        data.assigns = []
    }

</script>

<template>
    <div class="form-row">
        <div class="form-group col-md-6">
            <BreezeLabel for="agency_id" value="Agency Name" />
            <multi-select v-model="formData.agency_id" :options="agencies"
                placeholder="Choose a agency" @change="getBlock($event)" :searchable="true"/>
            <span v-if="formData.errors.agency_id" class="text-danger">{{formData.errors.agency_id}}</span>
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="team_name" value="Team Name" />
            <BreezeInput id="team_name" type="text" class="form-control" v-model="formData.team_name"
                placeholder="Team Name" :autocomplete="formData.team_name" :error="formData.errors.team_name" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="form-control" v-model="formData.email"
                placeholder="Email" :autocomplete="formData.email" :error="formData.errors.email"
                @getUserData="checkUserAndAgent()"/>
        </div>
        <div class="form-group col-md-6" v-if="data.password">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="form-control" v-model="formData.password"
                placeholder="Password" :autocomplete="formData.password" :error="formData.errors.password" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="contact_person" value="Contact Person Name" />
            <BreezeInput id="contact_person" type="text" class="form-control" v-model="formData.contact_person"
                placeholder="Contact Person Name" :autocomplete="formData.contact_person" :error="formData.errors.contact_person" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="mobile" value="Mobile" />
            <BreezeInput id="mobile" type="text" class="form-control" v-model="formData.mobile"
                placeholder="Contact Person Mobile" :autocomplete="formData.mobile" :error="formData.errors.mobile" />
        </div>

        <div v-if="data.campNames" class="col-md-12">
            <hr>
            <div class="form-row mb-4">
                <div class="row col-md-12" v-for="(input, index) in formData.assigns" :key="index">

                    <div class="col-md-4">
                        <div class="form-group" >
                            <BreezeLabel for="camp_id" value="Camp" />
                            <BreezeInput
                                id="camp"
                                type="text"
                                class="form-control"
                                :value="data.campNames[index]['label']"
                                placeholder="camp Name"
                                readonly
                            />
                            <span v-if="formData.errors[`assigns.${index}.camp_id`]" class="text-danger">
                            {{ formData.errors[`assigns.${index}.camp_id`] }}</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group" >
                            <BreezeLabel for="block_id" value="Block" />
                            <multi-select v-model="input.block_id" :options="data.blockNames[index]"
                                placeholder="Choose a block" mode="tags" :searchable="true"/>
                            <span v-if="formData.errors[`assigns.${index}.block_id`]" class="text-danger">
                            {{ formData.errors[`assigns.${index}.block_id`] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-right">
            <BreezeButton
                class="btn btn-success"
                :disabled="formData.processing"
                >SAVE</BreezeButton>
        </div>
    </div>
</template>

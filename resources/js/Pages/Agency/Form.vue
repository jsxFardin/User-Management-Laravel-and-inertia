<script setup>

    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import BreezeTextarea from "@/Components/Textarea.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { computed, reactive } from 'vue';

    const props = defineProps({
        formData: Object,
        campNames: Object,
        blockNames: Object,
        password: {
            type: Boolean,
            default: true
        },
    })
    let data = reactive({
        campNames: props.campNames,
        blockNames: props.formData.id ? props.blockNames : [props.blockNames],
        password: props.password
    })

    const checkUserAndAgent = () => {
        const params = {
            params: {
                'email': props.formData.email,
                'mobile': props.formData.mobile,
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
    const setAndUnsetFormData = (params) => {
        props.formData.role_id          = (params.user && params.user.role_id) ?? ''
        props.formData.user_id          = (params.user && params.user.id) ?? ''
        props.formData.mobile           = (params.user && params.user.mobile) ?? ''
        props.formData.contact_person   = (params.user && params.user.name) ?? ''
        props.formData.agency           = params.agency ?? []
        props.formData.team             = params.team ?? []
        data.password                   = (params.user && params.user.id) ? false : true
    }
    const getBlock = (event, index) => {
        props.formData.assigns[index]['block_id'] = []
        
        // if(event != null){
        //     console.error(props.campNames.filter((item) => event == item.camp_id))
        //     data.blockNames[index] = props.campNames.filter((item) => event == item.camp_id);
        // }

        if(event){
            const params = {
                params: {
                    'camp_id': event,
                }
            }
            axios.get(`ajax/block-details`, params)
                .then((response)=>{
                    data.blockNames[index] = response.data
                })
                .catch((error)=>{
                    toast.warning(error)
                })
        }
    }
    const addRow = () => {
        let camp = []
        for(let item of props.formData.assigns) {
            if(item.camp_id != "" && item.camp_id != null) {
                camp.push(item.camp_id)
            }
        }
        if (camp.length > 0) {
            data.campNames.map(function (item) {
                if (camp.includes(item.value)) {
                    item.disabled = true
                } else {
                    item.disabled = false
                }
            })
            let obj = {
                camp_id         : "",
                block_id        : [],
            }
            props.formData.assigns.push(obj)
            props.formData.errors = {}
        } else {
            props.formData.errors[`assigns.0.camp_id`] = 'Please select camp first.'
        }
        
    }
    const deleteRow = (index, camp_id) => {
        data.blockNames.splice(index, 1)
        props.formData.assigns.splice(index, 1)
        data.campNames.map(function (item) {
            if(item.value == camp_id) {
                item.disabled = !item.disabled
            }
        })
    }
</script>

<template>
    <div class="form-row">
        <div class="form-group col-md-6">
            <BreezeLabel for="agency_name" value="Agency Name" />
            <BreezeInput id="agency_name" type="text" class="form-control" v-model="props.formData.agency_name"
                placeholder="Agency Name" :autocomplete="props.formData.agency_name" :error="props.formData.errors.agency_name"/>
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="email" value="Email" />
            <BreezeInput id="email" type="email" class="form-control" v-model="props.formData.email"
                placeholder="Email" :autocomplete="props.formData.email" :error="props.formData.errors.email"
                @getUserData="checkUserAndAgent()"/>
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="contact_person" value="Contact Person Name" />
            <BreezeInput id="contact_person" type="text" class="form-control" v-model="props.formData.contact_person"
                placeholder="Contact Person Name" :autocomplete="props.formData.contact_person"
                :error="props.formData.errors.contact_person" />
        </div>
        <div class="form-group col-md-6" v-if="data.password">
            <BreezeLabel for="password" value="Password" />
            <BreezeInput id="password" type="password" class="form-control" v-model="props.formData.password"
                placeholder="Password" :autocomplete="props.formData.password" :error="props.formData.errors.password" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="mobile" value="Mobile" />
            <BreezeInput id="mobile" type="text" class="form-control" v-model="props.formData.mobile"
                placeholder="Contact Person Mobile" :autocomplete="props.formData.mobile" :error="props.formData.errors.mobile" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="phone" value="Phone" />
            <BreezeInput id="phone" type="text" class="form-control" v-model="props.formData.phone"
                placeholder="Phone" :autocomplete="props.formData.phone" :error="props.formData.errors.phone" />
        </div>
        <div class="form-group col-md-6">
            <BreezeLabel for="address" value="Address" />
            <BreezeTextarea id="address" type="address" class="form-control" v-model="props.formData.address"
            placeholder="Agency Address" :autocomplete="props.formData.address" :error="props.formData.errors.address" />
        </div>

        <div class="col-md-12">
            <hr>
            <div class="form-row mb-4">
                <div class="col-md-12">
                    <button class="btn btn-info btn-sm float-right" type="button" @click="addRow">
                        <font-awesome-icon :icon="['fas', 'plus']" />Add
                    </button>
                </div>

                <div class="row col-md-12" v-for="(input, index) in formData.assigns" :key="index">
                    <div class="col-md-5">
                        <div class="form-group" >
                            <BreezeLabel for="camp_id" value="Camp" />
                            <multi-select v-model="input.camp_id" :options="data.campNames" :searchable="true"
                                placeholder="Choose a camp" @change="getBlock($event, index)"/>
                            <span v-if="props.formData.errors[`assigns.${index}.camp_id`]" class="text-danger"> 
                            {{ props.formData.errors[`assigns.${index}.camp_id`] }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" >
                            <BreezeLabel for="block_id" value="Block" />
                            <multi-select v-model="input.block_id" :options="data.blockNames[index]"
                                placeholder="Choose a block" mode="tags" :searchable="true"/>
                            <span v-if="props.formData.errors[`assigns.${index}.block_id`]" class="text-danger"> 
                            {{ props.formData.errors[`assigns.${index}.block_id`] }}</span>
                        </div>
                    </div>
                    
                    <div class="m-auto col-md-1" v-if="index != 0">
                        <div class="form-group mt-2" >
                            <button type="button" class="btn btn-danger btn-sm float-right" 
                                @click="deleteRow(index, input.camp_id)">
                                <font-awesome-icon :icon="['fas', 'trash']" /> Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-right">
            <BreezeButton
                class="btn btn-success"
                :disabled="props.formData.processing"
                >SAVE</BreezeButton>
        </div>
    </div>
</template>

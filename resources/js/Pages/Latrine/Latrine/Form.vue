<script setup>
    import BreezeLabel from "@/Components/Label.vue";
    import BreezeInput from "@/Components/Input.vue";
    import Button from "@/Components/Button.vue";
    import BreezeSelect from "@/Components/Select.vue";
    import BreezeCheckbox from "@/Components/Checkbox.vue";
    import BreezeTextarea from "@/Components/Textarea.vue";
    import BreezeButton from "@/Components/Button.vue";
    import { reactive } from "@vue/reactivity";

    const propsData = defineProps({
        formData: Object,
        camps: Object,
        blocks: Object,
        facilityTypes: Object,
        facilityUseds: Object,
        constructionStatus: Object,
        latrineStructure: Object,
        donor: Object,
        pits: Object,
        subBlocks: Object,
        sanitationZones: Object,
    })
    let data = reactive({
        campBlocks: propsData.blocks,
        subBlocks: propsData.subBlocks,
        pwsn: [ { value: 1, label: 'YES' }, { value: 0, label: 'NO' } ]
    })

    const getBlock = (event) => {
        if (event != null) {
            propsData.formData.block_id = ""
            propsData.formData.sub_block_id = ""
            data.campBlocks = propsData.blocks.filter((item) => event == item.camp_id)
        }
        if (event != null && data.campBlocks.length == 0) {
            const params = {
                params: {
                    'camp_id': event,
                }
            }
            propsData.formData.sub_block_id = ""
            axios.get(`ajax/block-details`, params)
                .then((response)=>{
                    data.campBlocks = response.data
                })
                .catch((error)=>{
                    toast.warning(error)
                })
        }
    };
    const getSubBlock = (event) => {
        if(event){
            const params = {
                params: {
                    'get_parent_id': event,
                }
            }
            propsData.formData.sub_block_id = ""
            axios.get(`ajax/block-details`, params)
                .then((response)=>{
                    data.subBlocks = response.data
                    forUniqueId(event, null, data.subBlocks)
                })
                .catch((error)=>{
                    toast.warning(error)
                })
        }
    }
    const getShortNames = (event) => {
        forUniqueId(propsData.formData.block_id, event, data.subBlocks)
    }
    const forUniqueId = (blockId = null, subBlockId = null, subBlocks) => {
        const camp      = propsData.camps.filter((item) => propsData.formData.camp_id == item.value)
        const block     = blockId ? propsData.blocks.filter((item) => blockId == item.value) : ''
        const sub_block = subBlockId ? subBlocks.filter((item)  => subBlockId == item.value) : ''

        propsData.formData.camp_sn = Object.keys(camp).length > 0 ? (camp[0].short_name != '' ? camp[0].short_name :'') : ''
        propsData.formData.block_sn  = Object.keys(block).length > 0 ? (block[0].short_name != '' ? block[0].short_name :'') : ''
        propsData.formData.subBlock_sn = Object.keys(sub_block).length > 0 ? (sub_block[0].short_name != '' ? sub_block[0].short_name :'') : ''
    }

</script>

<template>

    <div class="row">
        <div class="col mb-3">
            <BreezeLabel for="camp_id" value="Camps" />
            <multi-select
                v-model="formData.camp_id"
                :options="camps"
                placeholder="Choose a camp"
                @change="getBlock($event)"
                :searchable="true"
            />
            <span class="text-danger"> {{ formData.errors.camp_id }}</span>
        </div>
        <div class="col mb-3">
            <BreezeLabel for="block_id" value="Block" />
            <multi-select
                v-model="formData.block_id"
                :options="data.campBlocks"
                placeholder="Choose a Blocks"
                @change="getSubBlock($event)"
                :searchable="true"
            />
            <span class="text-danger"> {{ formData.errors.block_id }}</span>
        </div>
        <div class="col mb-3">
            <BreezeLabel for="sub_block_id" value="Sub-Block" />
            <multi-select
                v-model="formData.sub_block_id"
                :options="data.subBlocks"
                placeholder="Choose a Sub-Blocks"
                @change="getShortNames($event)"
                :searchable="true"
            />
            <span class="text-danger"> {{ formData.errors.sub_block_id }}</span>
        </div>

        <div class="col mb-3">
            <BreezeLabel
                for="construction_status_id"
                value="Construction Status"
            />
            <multi-select
                v-model="formData.construction_status_id"
                :options="constructionStatus"
                placeholder="Choose a Construction Status"
                :searchable="true"
            />
            <span class="text-danger">
                {{ formData.errors.construction_status_id }}</span
            >
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
            <BreezeLabel for="pit_type_id" value="PIT Type" />
            <multi-select
                v-model="formData.pit_type_id"
                :options="pits"
                placeholder="Choose a PIT Type"
                :searchable="true"
            />
            <span class="text-danger"> {{ formData.errors.pit_type_id }}</span>
        </div>
        <div class="col mb-3">
            <BreezeLabel for="constructor_id" value="Constructor" />
            <multi-select
                v-model="formData.constructor_id"
                :options="donor"
                placeholder="Choose a Constructor"
                :searchable="true"
            />
            <span class="text-danger"> {{ formData.errors.constructor_id }}</span>
        </div>

        <div class="col mb-3">
            <BreezeLabel for="facility_type_id" value="Facility Type" />
            <multi-select
                v-model="formData.facility_type_id"
                :options="facilityTypes"
                placeholder="Choose a Facility Type"
                :searchable="true"
            />
            <span class="text-danger">
                {{ formData.errors.facility_type_id }}</span
            >
        </div>
        <div class="col mb-3">
            <BreezeLabel for="facility_used_id" value="Facility Used" />
            <multi-select
                v-model="formData.facility_used_id"
                :options="facilityUseds"
                placeholder="Choose a Facility Used"
                :searchable="true"
            />
            <span class="text-danger">
                {{ formData.errors.facility_used_id }}</span
            >
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
            <BreezeLabel
                for="latrine_structure_id"
                value="Latrine Structure"
            />
            <multi-select
                v-model="formData.latrine_structure_id"
                :options="latrineStructure"
                placeholder="Choose a Structure"
                :searchable="true"
            />
            <span class="text-danger">
                {{ formData.errors.latrine_structure_id }}</span
            >
        </div>
        <div class="col mb-3">
            <BreezeLabel
                for="sanitation_zone_id"
                value="Sanitation Zone"
            />
            <multi-select
                v-model="formData.sanitation_zone_id"
                :options="sanitationZones"
                placeholder="Choose a Zone"
                :searchable="true"
            />
            <span class="text-danger">
                {{ formData.errors.sanitation_zone_id }}</span
            >
        </div>
        <div class="col mb-3">
            <BreezeLabel for="functional" value="Functional" />
            <BreezeInput
            id="functional"
            type="number"
            class="form-control"
            v-model="formData.functional"
            autofocus
            placeholder="Functional"
            :autocomplete="formData.functional"
            :error="formData.errors.functional"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="non_functional" value="Non functional" />
            <BreezeInput
            id="non_functional"
            type="number"
            class="form-control"
            v-model="formData.non_functional"
            autofocus
            placeholder="Non functional"
            :autocomplete="formData.non_functional"
            :error="formData.errors.non_functional"
            />
        </div>
    </div>

     <div class="row">
        <div class="col mb-3">
            <BreezeLabel for="longitude" value="Longitude" />
            <BreezeInput
            id="longitude"
            type="number"
            class="form-control"
            v-model="formData.longitude"
            autofocus
            placeholder="Longitude"
            :autocomplete="formData.longitude"
            :error="formData.errors.longitude"
            :step="0.0000001"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="latitude" value="Latitude" />
            <BreezeInput
                id="latitude"
                type="number"
                class="form-control"
                v-model="formData.latitude"
                autofocus
                placeholder="Latitude"
                :autocomplete="formData.latitude"
                :error="formData.errors.latitude"
                :step="0.0000001"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="male_number_user" value="Male number user" />
            <BreezeInput
                id="male_number_user"
                type="number"
                class="form-control"
                v-model="formData.male_number_user"
                autofocus
                placeholder="Male number user"
                :autocomplete="formData.male_number_user"
                :error="formData.errors.male_number_user"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel
                for="male_number_stickers"
                value="Male number stickers"
            />
            <BreezeInput
                id="male_number_stickers"
                type="number"
                class="form-control"
                v-model="formData.male_number_stickers"
                autofocus
                placeholder="Male number stickers"
                :autocomplete="formData.male_number_stickers"
                :error="formData.errors.male_number_stickers"
            />
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <BreezeLabel
                for="female_number_user"
                value="Female number user"
            />
            <BreezeInput
                id="female_number_user"
                type="number"
                class="form-control"
                v-model="formData.female_number_user"
                autofocus
                placeholder="Female number user"
                :autocomplete="formData.female_number_user"
                :error="formData.errors.female_number_user"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel
                for="female_number_stickers"
                value="Female number stickers"
            />
            <BreezeInput
                id="female_number_stickers"
                type="number"
                class="form-control"
                v-model="formData.female_number_stickers"
                autofocus
                placeholder="Male number stickers"
                :autocomplete="formData.female_number_stickers"
                :error="formData.errors.female_number_stickers"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="children_number" value="Children number" />
            <BreezeInput
                id="children_number"
                type="number"
                class="form-control"
                v-model="formData.children_number"
                autofocus
                placeholder="Children number"
                :autocomplete="formData.children_number"
                :error="formData.errors.children_number"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="common_shared" value="Common shared" />
            <BreezeInput
                id="common_shared"
                type="number"
                class="form-control"
                v-model="formData.common_shared"
                autofocus
                placeholder="Common shared"
                :autocomplete="formData.common_shared"
                :error="formData.errors.common_shared"
            />
        </div>
    </div>

    <div class="row">
         <div class="col mb-3">
            <BreezeLabel for="pwsn" value="PWSN " />
            <multi-select
                v-model="formData.pwsn"
                :options="data.pwsn"
                placeholder="Choose a PWSN"
                :searchable="true"
            />
            <span class="text-danger"> {{ formData.errors.pwsn }}</span>
        </div>
        <div class="col mb-3">
            <BreezeLabel for="chamber_door" value="Chamber of door" />
            <BreezeInput
                id="chamber_door"
                type="number"
                class="form-control"
                v-model="formData.chamber_door"
                autofocus
                placeholder="Chamber door"
                :autocomplete="formData.chamber_door"
                :error="formData.errors.chamber_door"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="total_chamber" value="Total chamber" />
            <BreezeInput
                id="total_chamber"
                type="number"
                class="form-control"
                v-model="formData.total_chamber"
                autofocus
                placeholder="Total chamber"
                :autocomplete="formData.total_chamber"
                :error="formData.errors.total_chamber"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="total_ring_number" value="Total ring number" />
            <BreezeInput
                id="total_ring_number"
                type="number"
                class="form-control"
                v-model="formData.total_ring_number"
                autofocus
                placeholder="Total ring number"
                :autocomplete="formData.total_ring_number"
                :error="formData.errors.total_ring_number"
                :step="0.01"
            />
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <BreezeLabel for="dia_of_ring" value="Dia of ring(Inch)" />
            <BreezeInput
                id="dia_of_ring"
                type="number"
                class="form-control"
                v-model="formData.dia_of_ring"
                autofocus
                placeholder="Dia of ring"
                :autocomplete="formData.dia_of_ring"
                :error="formData.errors.dia_of_ring"
                :step="0.01"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel
                for="septic_tank_dimension"
                value="Septic tank dimension"
            />
            <BreezeInput
                id="septic_tank_dimension"
                type="number"
                class="form-control"
                v-model="formData.septic_tank_dimension"
                autofocus
                placeholder="Septic tank dimension"
                :autocomplete="formData.septic_tank_dimension"
                :error="formData.errors.septic_tank_dimension"
                :step="0.01"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="total_volume" value="Total volume (m³)" />
            <BreezeInput
                id="total_volume"
                type="number"
                class="form-control"
                v-model="formData.total_volume"
                autofocus
                placeholder="Total volume"
                :autocomplete="formData.total_volume"
                :error="formData.errors.total_volume"
                :step="0.01"
            />
        </div>
        <div class="col mb-3">
            <BreezeLabel for="remarks" value="Remarks" />
            <BreezeTextarea
                id="remarks"
                type="text"
                class="form-control"
                v-model="formData.remarks"
                autofocus
                placeholder="Remarks"
                :autocomplete="formData.remarks"
                :error="formData.errors.remarks"
            />
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <BreezeCheckbox
                id="pwsn_hand_rail_outside"
                name="pwsn_hand_rail_outside"
                label="PWSN hand rail outside"
                label_class=" ml-2 "
                v-model:checked="formData.pwsn_hand_rail_outside"
            />
        </div>
        <div class="col mb-3">
            <BreezeCheckbox
                id="pwsn_hand_rail_inside"
                name="pwsn_hand_rail_inside"
                label_class="ml-2"
                label="PWSN hand rail inside"
                v-model:checked="formData.pwsn_hand_rail_inside"
            />
        </div>
        <div class="col mb-3">
            <BreezeCheckbox
                id="pwsn_ramp"
                name="pwsn_ramp"
                label_class="ml-2"
                label="PWSN ramp"
                v-model:checked="formData.pwsn_ramp"
            />
        </div>
        <div class="col mb-3">
            <BreezeCheckbox
                id="pwsn_stair"
                name="pwsn_stair"
                label_class="ml-2"
                label="PWSN stair"
                v-model:checked="formData.pwsn_stair"
            />
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <BreezeCheckbox
                id="pwsn_high_commode"
                name="pwsn_high_commode"
                label_class="ml-2"
                label="PWSN high commode"
                v-model:checked="formData.pwsn_high_commode"
            />
        </div>
        <div class="col mb-3">
            <BreezeCheckbox
                id="hwd"
                name="hwd"
                label_class="ml-2"
                label="HWD"
                v-model:checked="formData.hwd"
            />
        </div>
        <div class="col mb-3">
            <BreezeCheckbox
                id="hwd_water"
                name="hwd_water"
                label_class="ml-2"
                label="HWD water"
                v-model:checked="formData.hwd_water"
            />
        </div>
        <div class="col mb-3">
            <BreezeCheckbox
                id="hwd_soap"
                name="hwd_soap"
                label_class="ml-2"
                label="HWD soap"
                v-model:checked="formData.hwd_soap"
            />
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <BreezeCheckbox
                id="min_or_repair"
                name="min_or_repair"
                label_class="ml-2"
                label="Min or Repair"
                v-model:checked="formData.min_or_repair"
            />
        </div>
    </div>

    <div class="col-md-12 text-right">
        <BreezeButton
            type="submit"
            class="btn btn-success"
        >SAVE</BreezeButton>
    </div>
</template>

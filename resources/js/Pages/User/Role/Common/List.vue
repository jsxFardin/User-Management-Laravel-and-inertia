<script setup>
import BreezeCheckbox from '@/Components/Checkbox.vue';
import RoleList from './List.vue'
import RoleItem from './Item.vue'
import { ref } from '@vue/reactivity';
defineProps({
    item: Object,
    itemKey: Number
})

const checkAllItems = ref(false)

const checkAll = () => {
    checkAllItems.value = !checkAllItems.value
    // console.error(checkAllItems.value)
}

</script>
<template>
    <div class="card card-info">
        <div class="card-header pt-1 pl-2 pb-1 pr-2">
            <h4 class="card-title w-100">
                <a class="d-block w-100 float-left" data-toggle="collapse" :href="'#collapseOne'+itemKey">
                    <strong>{{ item.label }}</strong>
                    <button v-if="item.have_child == null" type="button" class="btn btn-danger btn-xs float-right" @click.prevent="checkAll">
                        <font-awesome-icon :icon="['fas', 'check-double']" class="mr-1"/> ALL
                    </button>
                </a>
            </h4>
        </div>
        <div :id="'collapseOne'+itemKey" class="collapse show" data-parent="#accordion">
            <div class="card-body pt-1 pl-3 pb-0 pr-3">
                <div class="row" v-if="item.have_child == null">
                    <RoleItem
                        v-for="(permission, p) in item.permissions"
                        :item="permission"
                        :key="p"
                        :check-all-items="checkAllItems"
                    />
                </div>
                <div class="row" v-else>
                    <div id="accordion" style="width: 100%">
                        <RoleList
                            v-for="(assign, a) in item.child"
                            :item="assign"
                            :key="a"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
let props = defineProps({
  assigns: Object,
});

</script>
<template>
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title text-bold">Assign Camps & Blocks</h3>
    </div>
    <div class="card-body">
      <table class="table caption-top">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Camp</th>
            <th scope="col">Blocks</th>
          </tr>
        </thead>
        <tbody v-if="assigns">
          <tr v-for="(item, key) in assigns" :key="'row-' + key">
            <th scope="row">{{ key + 1 }}</th>
            <td>{{ item.name }}</td>
            <td v-if="item.blocks && item.blocks.length > 0">
              <span
                class="badge badge-danger mr-2"
                v-for="(block, blockIndex) in item.blocks"
                :key="'block' + key + blockIndex"
              >
                {{ block.name }}
              </span>
            </td>
            <td v-else>No Blocks</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
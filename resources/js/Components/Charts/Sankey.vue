<script setup>
import DxSankey, { DxLink, DxNode, DxTooltip } from "devextreme-vue/sankey.js";
import { reactive } from "@vue/reactivity";

components: {
    DxSankey,
    DxTooltip,
    DxNode,
    DxLink
}

let sankeyData = reactive([
    {
        source: "Spain",
        target: "United States of America",
        weight: 2
    },
    {
        source: "Germany",
        target: "United States of America",
        weight: 8
    },
    {
        source: "France",
        target: "United States of America",
        weight: 4
    },
    { source: "Germany", target: "Great Britain", weight: 2 },
    { source: "France", target: "Great Britain", weight: 4 },
    {
        source: "United States of America",
        target: "Australia",
        weight: 6
    },
    {
        source: "United States of America",
        target: "New Zealand",
        weight: 5
    },
    {
        source: "United States of America",
        target: "Japan",
        weight: 3
    },
    { source: "Great Britain", target: "New Zealand", weight: 4 },
    { source: "Great Britain", target: "Japan", weight: 1 }
]);

const customizeLinkTooltip = (info) => {
    return {
        html: `<b>From:</b> ${info.source}<br/><b>To:</b> ${info.target}<br/><b>Weight:</b> ${info.weight}`
    };
}
</script>

<template>
    <DxSankey   DxSankey
        id="sankey"
        :data-source="sankeyData"
        source-field="source"
        target-field="target"
        weight-field="weight"
        title="Content Item Flow on Milestones"
        class="ma-2"
    >
        <DxTooltip
            :enabled="true"
            :customize-link-tooltip="customizeLinkTooltip"
        />
        <DxNode :width="8" :padding="30" />
        <DxLink color-mode="gradient" />
    </DxSankey>
</template>

<style scoped>
#sankey {
    height: 400px;
    width: 100%;
    display: block;
}
</style>

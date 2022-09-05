<script setup>
    import "leaflet/dist/leaflet.css";
    import L from "leaflet";
    import { ref, reactive } from "vue";
    import { computed, onBeforeUnmount, onMounted, watch } from "@vue/runtime-core";
    import { usePage } from "@inertiajs/inertia-vue3";
    import BreezeCheckbox from "@/Components/Checkbox.vue";

    const propsData = defineProps({
        zones: {
            type: Array,
            default: []
        },
        latrines: {
            type: Array,
            default: []
        }
    })

    const osm = ref(
        L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
            attribution: "Kaz Software",
        })
    );

    var circleOptions = ref({
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0
    });

    const data = reactive({
        sidebarVisible: false,
        shapeFileLayer:[
            {
                "id": "outlineLatrine",
                "name": "outlineLatrine",
                "label": "Outline Latrine",
                "chacked": false,
                "layer": "outlineLatrinesLayer"
            },
            {
                "id": "outlineCamp",
                "name": "outlineCamp",
                "label": "Outline Camp",
                "chacked": false,
                "layer": "outlineCampsAL1Layer"
            },
            {
                "id": "outlineBlock",
                "name": "outlineBlock",
                "label": "Outline Block",
                "chacked": false,
                "layer": "outlineBlocksAL2Layer"
            },
            {
                "id": "Camp4SanitationZone",
                "name": "Camp4SanitationZone",
                "label": "Camp 4 Sanitation Zone",
                "chacked": false,
                "layer": "outlineCamp4SanitationZoneLayer"
            },
            {
                "id": "TecknafSanitationZone",
                "name": "TecknafSanitationZone",
                "label": "Tecknaf Sanitation Zone",
                "chacked": false,
                "layer": "outlineTecknafSanitationZoneLayer"
            },
            {
                "id": "UkhiyaSanitationZone",
                "name": "UkhiyaSanitationZone",
                "label": "Ukhiya Sanitation Zone",
                "chacked": false,
                "layer": "outlineUkhiyaSanitationZoneLayer"
            },
            {
                "id": "Camp3BuiltSewerLines",
                "name": "Camp3BuiltSewerLines",
                "label": "Camp 3 As Built Sewer Lines New",
                "chacked": false,
                "layer": "outlineCamp3BuiltSewerLinesLayer"
            },
            {
                "id": "Camp4SewerLinesNewConstruction",
                "name": "Camp4SewerLinesNewConstruction",
                "label": "Camp 4 Sewer Lines New Construction",
                "chacked": false,
                "layer": "outlineCamp4SewerLinesNewConstructionLayer"
            },
            {
                "id": "Camp4SewerLinesOld",
                "name": "Camp4SewerLinesOld",
                "label": "Camp 4 Sewer Lines Old",
                "chacked": false,
                "layer": "outlineCamp4SewerLinesOldLayer"
            },
            {
                "id": "Camp3BuiltJunction",
                "name": "Camp3BuiltJunction",
                "label": "Camp 3 as Built Junction",
                "chacked": false,
                "layer": "outlineCamp3BuiltJunctionLayer"
            },
            {
                "id": "Camp4BuiltJunction",
                "name": "Camp4BuiltJunction",
                "label": "Camp 4 as Built Junction",
                "chacked": false,
                "layer": "outlineCamp4BuiltJunctionLayer"
            },
        ],
        campStyle: {
            "color": "#2d3436",
            "weight": 5,
        },
        blockStyle: {
            "color": "#0984e3",
            "weight": 3,
        },
        sanitationZoneStyle: {
            "color": "#6c5ce7",
            "weight": 1,
        },
        BuiltSewerLineStyle: {
            "color": "#636e72",
            "weight": 7,
        },
        NewSewerLineStyle: {
            "color": "#0984e3",
            "weight": 7,
        },
        OldSewerLineStyle: {
            "color": "#e84393",
            "weight": 7,
        },
        layerData: {
            "outlineLatrinesLayer": null,
            "outlineCampsAL1Layer": null,
            "outlineBlocksAL2Layer": null,
            "outlineCamp4SanitationZoneLayer": null,
            "outlineTecknafSanitationZoneLayer": null,
            "outlineUkhiyaSanitationZoneLayer": null,
            "outlineCamp3BuiltSewerLinesLayer": null,
            "outlineCamp4SewerLinesNewConstructionLayer": null,
            "outlineCamp4SewerLinesOldLayer": null,
            "outlineCamp3BuiltJunctionLayer": null,
            "outlineCamp4BuiltJunctionLayer": null,
        }
    })

    const map = computed(() => {
        return L.map("mapContainer", {
            minZoom: 8,
            maxZoom: 20,
            preferCanvas: true,
            layers: [osm.value],
        });
    });

    const baseURL = computed(() => usePage().props.value.ziggy.url);

    const loadAllShapeFiles = async () => {
        data.layerData.outlineLatrinesLayer = await L.geoJSON(propsData.latrines, {
                style: { weight: 4 },
                pointToLayer: function(feature, latlng) {
                    return new L.CircleMarker(latlng, {
                        radius: 8,
                        color: `#${feature.properties.colorCode}`
                    });
                },
                onEachFeature: async function(feature, layer) {
                    if (feature.properties) {
                        layer.bindPopup(`
                            <h4 class="text-center">${feature.properties.uid_no}</h4>
                            <p class="m-0"><strong>Last Desludge:</strong> ${feature.properties.last_desludge_date}</p>
                            <p class="m-0"><strong>Desludge Qty:</strong> ${feature.properties.last_volume_desludged}</p>
                            <p class="m-0"><strong>Next Date:</strong> ${feature.properties.next_desludge_date}</p>
                        `);
                    }
                }
            }).bringToFront()

            data.layerData.outlineCampsAL1Layer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/polygon/t220130_rrc_outline_camp_al1.geojson"), {
                style: data.campStyle,
            })

        data.layerData.outlineBlocksAL2Layer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/polygon/t220130_rrc_outline__block_al2.geojson"), {
                style: data.blockStyle,
            })

        data.layerData.outlineCamp4SanitationZoneLayer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/polygon/camp4_sanitation_zone.geojson"), {
            style: function(feature) {
                let filtered = propsData.zones.filter(function(el){
                    return el.name == feature.properties.NAME
                })

                if(filtered[0] && filtered[0]['color'] != "2ecc71"){
                    return {color: `#${filtered[0]['color']}`, weight: 4 }
                }
            },
        })

        data.layerData.outlineTecknafSanitationZoneLayer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/polygon/tecknaf_sanitation_zones.geojson"), {
            style: function(feature) {
                let filtered = propsData.zones.filter(function(el){
                    return el.name == feature.properties.NAME
                })

                if(filtered[0] && filtered[0]['color'] != "2ecc71"){
                    return {color: `#${filtered[0]['color']}`, weight: 4 }
                }
            },
        })

        data.layerData.outlineUkhiyaSanitationZoneLayer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/polygon/ukhiya_sanitation_zones.geojson"), {
            style: function(feature) {
                let filtered = propsData.zones.filter(function(el){
                    return el.name == feature.properties.NAME
                })

                if(filtered[0] && filtered[0]['color'] != "2ecc71"){
                    return {color: `#${filtered[0]['color']}`, weight: 4 }
                }
            },
        })

        data.layerData.outlineCamp3BuiltSewerLinesLayer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/polyline/camp_3_as_built_sewer_lines_new.geojson"), {
            style: data.BuiltSewerLineStyle,
        })

        data.layerData.outlineCamp4SewerLinesNewConstructionLayer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/polyline/camp_4_sewer_line_new_construction.geojson"), {
            style: data.NewSewerLineStyle,
        })

        data.layerData.outlineCamp4SewerLinesOldLayer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/polyline/camp_4_sewer_line_old.geojson"), {
            style: data.OldSewerLineStyle,
        })

        data.layerData.outlineCamp3BuiltJunctionLayer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/circle/camp_3_as_built_junction.geojson"), {
            style: data.OldSewerLineStyle,
            pointToLayer: function(feature, latlng) {
                return new L.CircleMarker(latlng, {
                    radius: 5,
                    color: '#000000'
                });
            },
        })

        data.layerData.outlineCamp4BuiltJunctionLayer = await L.geoJSON(await getGeoJsonFileData("/assets/geojson/circle/camp_4_as_built_junction.geojson"), {
            style: data.OldSewerLineStyle,
            pointToLayer: function(feature, latlng) {
                return new L.CircleMarker(latlng, {
                    radius: 5,
                    color: '#000000'
                });
            },
        })
    }

    const getGeoJsonFileData = async (file) => {
        const response = await fetch( baseURL.value + file );
        return await response.json();
    }

    const loadShapeFile = (layer) => {
        map.value.addLayer(data.layerData[layer])

        data.layerData["outlineCamp4SanitationZoneLayer"].bringToFront();
        data.layerData["outlineTecknafSanitationZoneLayer"].bringToFront();
        data.layerData["outlineUkhiyaSanitationZoneLayer"].bringToFront();
        data.layerData["outlineLatrinesLayer"].bringToFront();
    }

    onMounted(async () => {
        await loadAllShapeFiles();

        await map.value.setView([21.194307, 92.149490], 14);
        await L.control.scale().addTo(map.value);
    });

    onBeforeUnmount(() => {
        if (map.value) {
            map.value.remove();
        }
    });

    const toggleLayerSitebar = () => {
        data.sidebarVisible = !data.sidebarVisible;
    }

    const checkBoxEvent = (data) => {
        if(data.chacked){
            loadShapeFile(data.layer)
        } else {
            removeLayerGroup(data.layer)
        }

    }

    function removeLayerGroup(layer) {
        map.value.removeLayer( data.layerData[layer] );
    }
</script>

<template>
    <div id="rightLayerGroupSidebar" class="card" :class="data.sidebarVisible ? 'm-fadeIn' : 'm-fadeOut'">
        <div class="card-header">
            <h3 class="card-title">Select Shape File</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" @click="toggleLayerSitebar">
                    <font-awesome-icon :icon="['fas', 'xmark']"/>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div v-for="(file, index) in data.shapeFileLayer" :key="index" class="icheck-primary">
                <!-- {{ file }} -->
                <BreezeCheckbox
                    :id="file.id"
                    :name="file.name"
                    :label="file.label"
                    label_class="ml-2"
                    v-model:checked="file.chacked"
                    @change="checkBoxEvent(file)"
                />
            </div>
        </div>
    </div>

    <div id="mapContainer">
        <button id="layerGroupBnt" class="btn btn-lg" @click="toggleLayerSitebar">
            <font-awesome-icon :icon="['fas', 'layer-group']"/>
        </button>
    </div>
</template>

<style scoped>
    #mapContainer {
        width: 100%;
        height: 78vh;
        position: relative;
    }

    #mapContainer #layerGroupBnt {
        position: absolute;
        right: 0;
        bottom: 2rem;
        z-index: 998;
        font-size: 2rem;
        color: #316111;
    }

    #rightLayerGroupSidebar {
        position: absolute;
        height: 100%;
        right: -5px;
        top: 0;
        width: 300px;
        z-index: 999;
        animation-name: fadeInRight,hide;
        animation-duration: 1s;
        animation-delay: 0s,3s;
        animation-fill-mode: both;
    }

    #rightLayerGroupSidebar .card-body {
        font-size: 0.80rem;
        display: block;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .m-fadeOut {
        visibility: hidden;
        opacity: 0;
        transition: visibility 0s linear 100ms, opacity 300ms;
    }
    .m-fadeIn {
        visibility: visible;
        opacity: 1;
        transition: visibility 0s linear 100ms, opacity 300ms;
    }
</style>

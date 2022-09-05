<script setup>
    import { onMounted, watch } from "@vue/runtime-core";
    import { reactive } from "@vue/reactivity";
    import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
    import { Head } from "@inertiajs/inertia-vue3";
    import Breadcrumb from "@/Components/Breadcrumb.vue";
    // import Map from "@/Components/Map.vue";
    import Widget from "@/Components/Widget.vue";
    import BreezeFilter from "@/Pages/Dashboard/Filter.vue";
    import BreezeCard from "@/Components/Card.vue";
    import AFAPieChart from "@/Pages/Dashboard/Chart/AFAPieChart.vue";
    import SecondPieChart from "@/Pages/Dashboard/Chart/SecondPieChart.vue";
    import ThirdPieChart from "@/Pages/Dashboard/Chart/ThirdPieChart.vue";
    import FirstStackedChart from "@/Pages/Dashboard/Chart/FirstStackedChart.vue";
    // import SankeyDiagram from "@/Components/Charts/Sankey.vue";

    defineProps({
        camps: {
            type: Array,
            default: [],
        },
        totalCamps: {
            type: Number,
            default: 0,
        },
        blocks: {
            type: Array,
            default: [],
        },
        totalBlocks: {
            type: Number,
            default: 0,
        },
        sanitationZones: {
            type: Array,
            default: [],
        },
        totalSanitationZones: {
            type: Number,
            default: 0,
        },
        agencies: {
            type: Array,
            default: [],
        },
        totalAgencies: {
            type: Number,
            default: 0,
        },
        teams: {
            type: Array,
            default: [],
        },
        totalTeams: {
            type: Number,
            default: 0,
        },
        totalLatrines: {
            type: Number,
            default: 0,
        },
        totalUsers: {
            type: Number,
            default: 0,
        },
        years: {
            type: Array,
            default: [],
        },
        months: {
            type: Array,
            default: [],
        },
    });

    let data = reactive({
        TotalVolumeDesludged: [],
        LatrineScheduleDate: [],
        LatrineScheduleDataList: [],
        typeofLatrine: [],
        totalDesludgedTypeofLatrine: [],
        totalHoursUsed: [],
        seeForeignMaterials: [],
        totalLitterFuelUsed: [],
        requiredSanitationZone: [],
    })

    const fetchTotalVolumeDesludged = () => {
        axios.get(`ajax/total-volume-desludged`, setParams)
            .then((response) => {
                data.TotalVolumeDesludged = response.data;
            })
            .catch((error) => {
                toast.warning(error);
            });
    }
    const fetchTypeofLatrines = () => {
        axios.get(`ajax/typeof-latrine`, setParams)
            .then((response) => {
                data.typeofLatrine = response.data ?? [];
            })
            .catch((error) => {
                toast.warning(error);
            });
    }
    const fetchTotalDesludgedTypeofLatrine = () => {
        axios.get(`ajax/total-desludged-typeof-latrine`, setParams)
            .then((response) => {
                data.totalDesludgedTypeofLatrine = response.data ?? [];
            })
            .catch((error) => {
                toast.warning(error);
            });
    }
    const fetchTotalHoursUsed = () => {
        axios.get(`ajax/total-hours-used`, setParams)
            .then((response) => {
                data.totalHoursUsed = response.data ?? [];
            })
            .catch((error) => {
                toast.warning(error);
            });
    }
    const fetchSeeForeignMaterials = () => {
        axios.get(`ajax/see-foreign-materials`, setParams)
            .then((response) => {
                data.seeForeignMaterials = response.data ?? [];
            })
            .catch((error) => {
                toast.warning(error);
            });
    }
    const fetchTotalLitterFuelUsed = () => {
        axios.get(`ajax/total-litter-fuel-used`, setParams)
            .then((response) => {
                data.totalLitterFuelUsed = response.data ?? [];
            })
            .catch((error) => {
                toast.warning(error);
            });
    }
    const fetchLatrineDesludgeSchedule = () => {
        axios.get(`ajax/latrine-desludge-schedule`, setParams)
            .then((response) => {
                data.LatrineScheduleDate     = response.data.dateData ?? [];
                data.LatrineScheduleDataList = response.data.listData ?? [];
            })
            .catch((error) => {
                toast.warning(error);
            });
    }
    const fetchReqDesludgeSanitationZone = () => {
        axios.get(`ajax/required-sanitation-zone`, setParams)
            .then((response) => {
                // console.error(response.data);
                data.requiredSanitationZone = response.data ?? [];
            })
            .catch((error) => {
                toast.warning(error);
            });
    }

    let filterForm = reactive({
        sanitationZones: [],
        block: [],
        camp: [],
        year: [],
        month: [],
        toDate: "",
        fromDate: "",
    });
    let setParams = reactive({
        params: {
            camp: null,
            block: null,
            year: null,
            month: null,
            sanitationZones: null,
            toDate: null,
            fromDate: null,
        }
    })
    //FILTER DATA
    watch( () => filterForm.sanitationZones, (value) => {
            setParams.params.sanitationZones = value.length > 0 ? JSON.stringify(value) : null
            setTimeout(function(){
                callAllFunctions()
            }, 1)

        }, { immediate: false }
    )
    watch( () => filterForm.camp, (value) => {
            setParams.params.camp = value.length > 0 ? JSON.stringify(value) : null
            setTimeout(function(){
                callAllFunctions()
            }, 1)
           
        }, { immediate: false }
    )
    watch( () => filterForm.block, (value) => {
            setParams.params.block = value.length > 0 ? JSON.stringify(value) : null
            setTimeout(function(){
                callAllFunctions()
            }, 1)

        }, { immediate: false }
    )
    watch( () => filterForm.year, (value) => {
            setParams.params.year = value.length > 0 ? JSON.stringify(value) : null
            setTimeout(function(){
                callAllFunctions()
            }, 1)
           
        }, { immediate: false }
    )
    watch( () => filterForm.month, (value) => {
            setParams.params.month = value.length > 0 ? JSON.stringify(value) : null
            setTimeout(function(){
                callAllFunctions()
            }, 1)

        }, { immediate: false }
    )
    watch( () => filterForm.fromDate, (value) => {
            setParams.params.fromDate = value ? value : null
            setTimeout(function(){
                callAllFunctions()
            }, 1)

        }, { immediate: false }
    )
    watch( () => filterForm.toDate, (value) => {
            setParams.params.toDate = value ? value : null
            setTimeout(function(){
                callAllFunctions()
            }, 1)

        }, { immediate: false }
    )
    const callAllFunctions = () => {
        fetchLatrineDesludgeSchedule()
        fetchTotalVolumeDesludged()
        fetchTypeofLatrines()
        fetchTotalDesludgedTypeofLatrine()
        fetchTotalHoursUsed()
        fetchSeeForeignMaterials()
        fetchTotalLitterFuelUsed()
        fetchReqDesludgeSanitationZone()
    }
    onMounted(() => {
        callAllFunctions()
    })

    //FOR TABS
    const openScheduleList = (event, cityName) => {
        var i, tabContent, tabLinks;
        tabContent = document.getElementsByClassName("tabContent");
        for (i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
        }
        tabLinks = document.getElementsByClassName("tabLinks");
        for (i = 0; i < tabLinks.length; i++) {
            tabLinks[i].className = tabLinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        event.currentTarget.className += " active";
    }

</script>

<template>
  <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <Breadcrumb :icon="'border-all'" :title="'Dashboard'" />

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid d-sm-none d-md-block d-none d-sm-block d-md-none d-lg-block">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex">
                            <div class="flex-fill">
                                <widget
                                    :style="'background-color: transparent; box-shadow: none'"
                                    :title="'Camps'"
                                    :icon="'campground'"
                                    background-color="bg-primary"
                                    :value="totalCamps"
                                />
                            </div>
                            <div class="flex-fill">
                                <widget
                                    :style="'background-color: transparent; box-shadow: none'"
                                    :title="'Blocks'"
                                    :icon="'map'"
                                    :value="totalBlocks"
                                />
                            </div>
                            <div class="flex-fill">
                                <widget
                                    :style="'background-color: transparent; box-shadow: none'"
                                    :title="'Zones'"
                                    :icon="'map-location-dot'"
                                    background-color="bg-danger"
                                    :value="totalSanitationZones"
                                />
                            </div>
                            <div class="flex-fill">
                                <widget
                                    :style="'background-color: transparent; box-shadow: none'"
                                    :title="'Latrines'"
                                    :icon="'toilet'"
                                    background-color="bg-success"
                                    :value="totalLatrines"
                                />
                            </div>
                            <div class="flex-fill">
                                <widget
                                    :style="'background-color: transparent; box-shadow: none'"
                                    :title="'Agencies'"
                                    :icon="'house'"
                                    background-color="bg-warning"
                                    :value="totalAgencies"
                                />
                            </div>
                            <div class="flex-fill">
                                <widget
                                    :style="'background-color: transparent; box-shadow: none'"
                                    :title="'Teams'"
                                    :icon="'people-group'"
                                    background-color="bg-secondary"
                                    :value="totalTeams"
                                />
                            </div>
                            <div class="flex-fill">
                                <widget
                                    :style="'background-color: transparent; box-shadow: none'"
                                    :title="'Users'"
                                    :icon="'users'"
                                    background-color="bg-danger"
                                    :value="totalUsers"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter data -->
            <BreezeFilter :camps="camps" :blocks="blocks" :years="years" :months="months"
            :sanitationZones="sanitationZones" :filterForm="filterForm" :reset-link="'dashboard'"
            :showResetBtn="true" :showSearch="false" :showSearchBtn="false" :showFooter="true"/>

            <!-- Desludging schedule -->
            <div class="row">
                <div class="col-md-8">
                    <div class=" card card-danger card-outline" style="height: 455px !important;">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Desludging schedule</h3>
                        </div>
                        <div class="tab">
                            <button class="tabLinks" @click="openScheduleList($event, `${item}`)" :class="dateIndex == 0 ? 'active' : ''"
                                v-for="(item, dateIndex) in data.LatrineScheduleDate" :key="dateIndex">{{item}}</button>
                        </div>

                        <div :id="`${item}`" class="tabContent" :class="dateIndex == 0 ? 'active' : ''"
                            :style="dateIndex == 0 ? 'display: block;' : ''"
                            v-for="(item, dateIndex) in data.LatrineScheduleDate" :key="dateIndex">
                            <table class="table table-striped table-hover display">
                                <thead class="table-header">
                                    <tr>
                                        <th>UID No. </th>
                                        <th>Camp Name</th>
                                        <th>Block Name</th>
                                        <th>Zone Name</th>
                                        <th>Days Left</th>
                                        <th>Last Desludge Date</th>
                                        <th>Last Volume Desludged</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in data.LatrineScheduleDataList[dateIndex]" :key="index">
                                        <td>{{item.uid_no}}</td>
                                        <td>{{item.camp_name}}</td>
                                        <td>{{item.block_name}}</td>
                                        <td>{{item.sanitation_zone_name}}</td>
                                        <td>{{item.days_left}}</td>
                                        <td>{{item.last_desludge_date}}</td>
                                        <td>{{item.last_volume_desludged}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class=" card card-warning card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">
                                Most required desludge needed sanitation zones
                            </h3>
                        </div>
                        <div class="card-body" style="height: 405px !important; overflow-y: scroll;">
                            <table class="table table-striped table-hover display">
                                <thead class="table-header">
                                    <th>Camp </th>
                                    <th>Block </th>
                                    <th>Zone</th>
                                    <th>Total Latrine</th>
                                    <th>Red</th>
                                    <th>Yellow</th>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in data.requiredSanitationZone" :key="index" 
                                    :style="item.color != '2ecc71' ?  {backgroundColor: `#${item.color}`} : ''">
                                        <td>{{ item.camp_name }}</td>
                                        <td>{{ item.block_name }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.total_latrine }}</td>
                                        <td>{{ item.danger }}%</td>
                                        <td>{{ item.warning }}%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <FirstStackedChart :data="data.TotalVolumeDesludged" :title="'Total volume desludged'"/>
                </div>
                <div class="col-md-6">
                    <FirstStackedChart :data="data.typeofLatrine" :title="'Total Type of latrines'"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <FirstStackedChart :data="data.totalDesludgedTypeofLatrine" :title="'Total Type of latrines desludged'"/>
                </div>
                <div class="col-md-6">
                    <FirstStackedChart :data="data.totalHoursUsed" :title="'Total hour used for this latrine desludging'"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <FirstStackedChart :data="data.seeForeignMaterials" :title="'See any foreign materials ( Plastic bottle, shoes, cloths etc )'"/>
                </div>
                <div class="col-md-6">
                    <FirstStackedChart :data="data.totalLitterFuelUsed" :title="'Liter of Petrol/ Diesel  used'"/>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </BreezeAuthenticatedLayout>
</template>


<style scoped>
    @import url('../../../css/tab.css');
</style>

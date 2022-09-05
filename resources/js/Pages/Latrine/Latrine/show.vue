<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";

defineProps({
  latrine: {
    type: Object,
    default: null,
  },
});
</script>

<template>
  <Head title="Latrine Profile" />
  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb :icon="'toilet'" title="Latrines Profile" :route="route('latrine.index')" />

    <section class="content">
      <BreezeCard :title="'Latrine'">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center" id="qrcode-container">
                  <div><qrcode-vue :value="latrine.uid_no" level="H" id="qrcode" /></div>
                  <h1 class="profile-username text-center">{{ latrine.uid_no }}</h1>
                </div>

                <div class="text-center"><button class="btn btn-info btn-sm mb-2" v-print="'#qrcode-container'">Print QR Code</button></div>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Donor</b>
                    <a class="float-right">{{ latrine.donor_name }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Construction Status </b><br/>
                    <a class="float-right">{{
                      latrine.construction_status_name
                    }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Latrine Structure </b><br/>
                    <a class="float-right"
                      >{{ latrine.latrine_structure_name }}
                    </a>
                  </li>
                  <li class="list-group-item">
                    <b>Pit Type </b><br/>
                    <a class="float-right">{{ latrine.pit_type_name }} </a>
                  </li>
                  <li class="list-group-item" style="border-bottom:unset !important">
                    <b>PWSN </b><br/>
                    <a class="float-right">
                        <span
                            class=" badge"
                            :class="badge-danger ? 'badge-success' : 'badge-danger'"
                        >{{ latrine.pwsn ? "Yes" : "No" }}</span>
                    </a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane">
                    <div class="post clearfix">
                      <hr />
                      <div class="row mt-3">
                        <div class="col">
                          <strong>Chamber door: </strong
                          >{{ latrine.chamber_door }}
                        </div>
                        <div class="col">
                          <strong>Male number stickers: </strong
                          >{{ latrine.male_number_stickers }}
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col">
                          <strong>Male number user: </strong
                          >{{ latrine.male_number_user }}
                        </div>
                        <div class="col">
                          <strong>Female number stickers: </strong
                          >{{ latrine.female_number_stickers }}
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col">
                          <strong>Female number user: </strong
                          >{{ latrine.female_number_user }}
                        </div>
                        <div class="col">
                          <strong>Children number: </strong
                          >{{ latrine.children_number }}
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col">
                          <strong>Common shared: </strong
                          >{{ latrine.common_shared }}
                        </div>
                        <div class="col">
                          <strong>Functional: </strong>{{ latrine.functional }}
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col">
                          <strong>Non Functional: </strong
                          >{{ latrine.non_functional }}
                        </div>
                        <div class="col">
                          <strong>Total chamber: </strong
                          >{{ latrine.total_chamber }}
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col">
                          <strong>Total ring number: </strong
                          >{{ latrine.total_ring_number }}
                        </div>
                        <div class="col">
                          <strong>Dia of ring: </strong
                          >{{ latrine.dia_of_ring }}
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col">
                          <strong>Septic Tank Dimension: </strong
                          >{{ latrine.septic_tank_dimension }}
                        </div>
                        <div class="col">
                          <strong>Total Volume: </strong
                          >{{ latrine.total_volume }}
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col">
                          <strong>Remarks: </strong>{{ latrine.remarks }}
                        </div>
                      </div>
                    </div>
                    <div class="post clearfix">
                      <div class="row">
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.min_or_repair == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label"
                              >Min or repair</label
                            >
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.pwsn_hand_rail_outside == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label"
                              >PWSN hand rail outside</label
                            >
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.pwsn_hand_rail_inside == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label"
                              >PWSN hand rail inside</label
                            >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.pwsn_ramp == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label"
                              >PWSN ramp</label
                            >
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.pwsn_stair == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label"
                              >PWSN stair</label
                            >
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.pwsn_high_commode == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label"
                              >PWSN high commode</label
                            >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.hwd == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label">HWD</label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.hwd_water == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label"
                              >HWD water</label
                            >
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              disabled
                              :checked="latrine.hwd_soap == 1"
                              class="custom-control-input"
                            />
                            <label class="custom-control-label">HWD soap</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-3">
            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong>
                  <font-awesome-icon
                    :class="'mr-1'"
                    :icon="['fas', `campground`]"
                  />Camp</strong
                >

                <p class="text-muted">
                  {{ latrine.camp_name }}
                </p>

                <hr />

                <strong
                  ><font-awesome-icon
                    :class="'mr-1'"
                    :icon="['fas', `map`]"
                  />Block</strong
                >

                <p class="text-muted">{{ latrine.block_name }}</p>

                <hr />

                <strong
                  ><font-awesome-icon
                    :class="'mr-1'"
                    :icon="['fas', `location-crosshairs`]"
                  />

                  Location</strong
                >

                <p class="text-muted">
                  <span class="tag tag-danger"
                    >lat: {{ latrine.latitude }} lon: {{ latrine.longitude }}
                  </span>
                </p>

                <hr />
                <strong>
                  <font-awesome-icon
                    :class="'mr-1'"
                    :icon="['fas', `align-left`]"
                  />

                  Facility Type
                </strong>

                <p class="text-muted">
                  {{ latrine.facility_type_name }}
                </p>
                <hr />
                <strong>
                  <font-awesome-icon
                    :class="'mr-1'"
                    :icon="['fas', `align-justify`]"
                  />
                  Facility Used
                </strong>

                <p class="text-muted">
                  {{ latrine.facility_used_name }}
                </p>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>

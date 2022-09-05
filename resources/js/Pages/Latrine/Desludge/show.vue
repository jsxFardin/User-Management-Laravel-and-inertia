<script setup>
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeBreadcrumb from "@/Components/Breadcrumb.vue";
import BreezeCard from "@/Components/Card.vue";

let props = defineProps({
  item: {
    type: Array,
    default: [],
  },
  message: {
    type: String,
    default: null,
  },
  access: {
    type: Array,
    default: [],
  },
});
</script>

<template>
  <Head title="Desludge" />

  <BreezeAuthenticatedLayout>
    <BreezeBreadcrumb
      :icon="'box-open'"
      title="Desludge"
      :route="route('desludge.index')"
    />
    <section class="content">
      <BreezeCard :title="'Desludge'">
        <h5>Desludge Details</h5>
        <hr />
        <div style="margin: auto; width: 100%">
          <table
            class="table table-bordered table-condensed"
            style="height: 100%; width: 100%"
          >
            <thead>
              <tr>
                <th style="width: 20%" class="headerCell"><h6>Field</h6></th>
                <th style="width: 60%" class="headerCell"><h6>Question</h6></th>
                <th style="width: 20%" class="headerCell"><h6>Answer</h6></th>
              </tr>
            </thead>
            <tbody>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >DataCollectionDate <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">Data collection date:</td>
                <td class="answerCell response-note-cell">
                  {{ item.collection_date_time }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >DataCollectorName <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">Data Collector's Name:</td>
                <td class="answerCell response-note-cell">
                  {{ item.desludge_user_name }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Camp_Name <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">1. Camp Name?</td>
                <td class="answerCell response-note-cell">
                  {{ item.camp_name }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >BLock_Name <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">2. Block Name ?</td>
                <td class="answerCell response-note-cell">
                  {{ item.block_name }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Sub_Block <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">3. Sub Block</td>
                <td class="answerCell response-note-cell">
                  {{ item.sub_block_name }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Facility_Type <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">4. Facility Type?</td>
                <td class="answerCell response-note-cell">
                  {{ item.facility_type_name }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Facility_Used <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">5. Facility Used?</td>
                <td class="answerCell response-note-cell">
                  {{ item.facility_used_name }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Construction_Status
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">6. Construction Status?</td>
                <td class="answerCell response-note-cell">
                  {{ item.construction_status_name }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Latrine_Structure <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">7. Latrine Structure ?</td>
                <td class="answerCell response-note-cell">
                  {{ item.latrine_structure_name }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >pit_type <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">8. PIT Type ?</td>
                <td class="answerCell response-note-cell">
                  {{ item.pit_type_name }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Total_chamber <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">9. Total chamber ?</td>
                <td class="answerCell response-note-cell">
                  {{ item.total_chamber }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >LatrineID <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">10. ID of the latrine:</td>
                <td class="answerCell response-note-cell">
                  {{ item.uid_no }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Dia_of_Ring <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">11. Dia of Ring (In Inches)</td>
                <td class="answerCell response-note-cell">
                  {{ item.dia_of_ring }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >No_of_Ring_desludged
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">12. No of Ring desludged</td>
                <td class="answerCell response-note-cell">
                  {{ item.count_desludge_ring }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Desludged_height_from_top
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">13. Desludged height from top?</td>
                <td class="answerCell response-note-cell">
                  {{ item.desludged_height_from_top }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Dimension_of_septic_tank
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">
                  14. Dimension of septic tank (Feet)
                </td>
                <td class="answerCell response-note-cell">
                  {{ item.dimension_of_septic_tank }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Total_volume_desludged_meter_cube
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">
                  15. Total volume desludged ,meter cube
                </td>
                <td class="answerCell response-note-cell">
                  {{ item.total_volume_desludged }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Sludge_Transferred_to
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">16. Sludge Transferred to</td>
                <td class="answerCell response-note-cell">
                  {{ item.sludge_transferred_to }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >See_foreign_materials
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">16. Foreign Materials?</td>
                <td class="answerCell response-note-cell">
                  {{ item.see_foreign_materials }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >How_many_ring_is_left_behind_in_the_pit
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">
                  17. How many ring is left behind in the pit?
                </td>
                <td class="answerCell response-note-cell">
                  {{ item.ring_left_behind }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Litre_of_petrol <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">
                  18. Litre of Petrol used (For this latrine desludging only) ?
                </td>
                <td class="answerCell response-note-cell">
                  {{ item.litre_of_petrol }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Mention_septic_tank_ID_TS_number
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">
                  19. Mention septic tank ID / TS number
                </td>
                <td class="answerCell response-note-cell">
                  {{ item.septic_tank_id_ts_number }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span
                    >Man_Woman_days_used
                    <span class="required">(required)</span>
                  </span>
                </td>
                <td class="questionCell">
                  20. Man/Woman power used for this latrine desludging?
                </td>
                <td class="answerCell response-note-cell">
                  {{ item.man_woman_days_used }}
                </td>
              </tr>
              <tr class="entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span>Status <span class="required">(required)</span> </span>
                </td>
                <td class="questionCell">21.Status</td>
                <td class="answerCell response-note-cell">
                  {{ item.desludge_status }}
                </td>
              </tr>
              <tr class="gray entryRow">
                <td style="padding-left: 5px" class="fieldCell">
                  <span>Remarks <span class="required">(required)</span> </span>
                </td>
                <td class="questionCell">21.Remarks</td>
                <td class="answerCell response-note-cell">
                  {{ item.desludge_remarks }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </BreezeCard>
    </section>
  </BreezeAuthenticatedLayout>
</template>

 <style scoped>
@import "./css/show.css";
</style>

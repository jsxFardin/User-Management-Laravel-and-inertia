<script setup>

    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import Breadcrumb from '@/Components/Breadcrumb.vue'

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <Breadcrumb :icon="'circle'" :title="'Blank Page'"/>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Title</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <font-awesome-icon :icon="['fas', 'minus']"></font-awesome-icon>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <font-awesome-icon :icon="['fas', 'xmark']"></font-awesome-icon>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    Start creating your amazing application!
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
        
    </BreezeAuthenticatedLayout>
</template>

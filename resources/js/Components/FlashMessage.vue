<script setup>

defineProps({
    title: {
        type: String,
        default: 'Card Title',
    },
});
</script>

<template>
    <!-- Default box -->
    <div v-if="$page.props.flash.message" class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ $page.props.flash.message }}
        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> -->
    </div>

    <div v-if="$page.props.toast" class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $page.props.toast }}
    </div>
    <!-- /.card -->
</template>

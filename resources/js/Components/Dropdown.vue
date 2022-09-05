<script setup>
    import BreezeDropdown from "@/Components/Dropdown.vue"
    import BreezeNavLink from "@/Components/NavLink.vue";
    defineProps({
        item: Object,
        key: Number,
        dropdown: Object
    })

    const isActiveMultiMenu = (currentRoute, checkName) => {
        if(checkName != null) {
            checkName = checkName.split("|")
            return checkName.includes(currentRoute) ? true : false
        }
    }
    const isActiveMenu = (currentRoute, checkName) => {
        // console.error(currentRoute, checkName)
        return checkName.includes(currentRoute) ? true : false
    }
</script>

<template>
    <li
        v-if="item.have_permission"
        class="nav-item"
        :class="
            isActiveMultiMenu(route().current(), item.route)
                ? `menu-is-opening menu-open`
                : ` `
        "
    >
        <a
            v-if="item.child != null && item.child.length != 0"
            class="nav-link"
            href="#"
            :class="
                isActiveMultiMenu(route().current(), item.route) 
                    ? `active menu-open`
                    : ` `
            "
        >
            <font-awesome-icon
                :class="'nav-icon'"
                :icon="['fas', item.icon]"
            >
            </font-awesome-icon>
            <p>
                {{ __(item.name) }}
                <!-- <font-awesome-icon
                    :class="'right'"
                    :icon="['fas', `angle-left`]"
                /> -->
            </p>
        </a>
        <BreezeNavLink
            v-else
            :href="item.route != null ? route(item.route) : '#'"
            :active="item.route != null ? isActiveMenu(route().current(), item.route) : `null`"
        >
            <font-awesome-icon
                :class="'nav-icon'"
                :icon="['fas', item.icon]"
            >
            </font-awesome-icon>
            <p>
                {{ __(item.name) }}
            </p>
        </BreezeNavLink>

        <ul
            v-if="item.child != null && item.child.length != 0"
            class="nav nav-treeview"
        >
            <BreezeDropdown
                v-for="(menu, m) in item.child"
                :key="m"
                :item="menu"
                :dropdown="menu.route"
            />
        </ul>
    </li>
</template>

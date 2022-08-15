<template>
    <section class="
        flex
        items-center
        py-6
        2xl:px-44
    ">
        <div
            :class="color"
            class="h-24 w-24"
        >
            <slot></slot>
        </div>
        <p :class="color" class="ml-6 text-2xl font-extrabold mx-1">
            {{ name }}
        </p>
    </section>
</template>

<script>
    export default {
        props: [
            'name',
            'color',
        ]
    }
</script>
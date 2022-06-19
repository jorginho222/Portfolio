<template>
    <section class="
        flex
        items-center
        px-44
        py-6
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
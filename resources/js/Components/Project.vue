<template>
    <a :href="link" target="_blank" rel="noopener noreferrer">
        <section class="py-6 md:flex md:justify-between md:items-end 2xl:px-44">
            <div
                class="bg-gray-100 h-24 w-24 rounded-2xl p-2"
            >
                <slot></slot>
            </div>
            <p class="mt-4 text-2xl font-extrabold flex-1 md:mt-0 md:mx-10 md:text-4xl">
                    {{ title }}
            </p>
            <p class="mt-1 text-xl flex-1 md:mt-0 md:mx-10 md:text-2xl">
                {{ description }}
            </p>
        </section>
    </a>
</template>

<script>
    export default {
        props: [
            'title',
            'description',
            'link',
            'logo_path',
        ]
    }
</script>
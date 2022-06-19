<script>
    import { defineComponent } from '@vue/runtime-core'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
        },
    })
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg rounded-lg p-6 border-b border-gray-200 flex flex-col text-xl">
                    <p class="mb-5">Your resources</p>
                    <ul class="p-3">
                        <li class="ml-2 flex flex-row items-center">
                            <div class="bg-gray-500 mr-3 h-2 w-2"></div>
                            <Link :href="route('skills.index')" class="hover:text-gray-800 mt-2 text-sm text-indigo-500 border-b border-gray-400">
                                Skills
                            </Link>
                        </li>
                        <li class="ml-2 flex flex-row items-center">
                            <div class="bg-gray-500 mr-3 h-2 w-2"></div>
                            <Link :href="route('projects.index')" class="hover:text-gray-800 mt-2 text-sm text-indigo-500 border-b border-gray-400">
                                Projects
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

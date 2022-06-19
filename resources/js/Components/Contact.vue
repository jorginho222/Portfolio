<template>
    <div class="flex justify-evenly items-center text-xl">
        <Link href="https://github.com/jorginho222"  class="border-b pb-1 px-2 hover:text-gray-50">Github</Link>
        <Link href="https://www.linkedin.com/in/ivan-larra%C3%B1aga-7a8499b9/"  class="border-b pb-1 px-2 hover:text-gray-50">Linkedin</Link>
        <Link href="https://www.udemy.com/user/ivan-larranaga-2/"  class="border-b pb-1 px-2 hover:text-gray-50">Udemy</Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { defineComponent } from '@vue/runtime-core';

export default defineComponent({
    components: {
        Link
    }
})
</script>
<template>
    <div>
        <main
            id="home-layout"
        >
            <slot />
        </main>
    </div>
</template>

<script>
export default {
    name: "HomeLayout",
    metaInfo() {
        return {
            title: 'LXST.ADMIN',
            meta: [
                {
                    name: 'description',
                    content: 'LXST.ADMIN - powered by Laravel, Tailwind, Vue, and Inertia',
                }
            ]
        }
    },
}
</script>

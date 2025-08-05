<template>
    <header class="bg-theme-secondary px-4 py-8 text-theme-secondary-contrast">
        <div class="container max-w-screen-lg mx-auto">
            <div class="flex flex-col items-center md:flex-col md:items-center">
                <div class="aspect-ratio-16-9 max-w-xl relative w-full align-right">
                    <iframe
                        :src="course.video_preview"
                        class="h-full w-full"
                        frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen
                    />
                </div>
            </div>
            <div class="flex flex-col items-center md:flex-col md:items-center">
                <section class="lg:mt-8 text-center md:ml-8 md:mt-2 md:text-center sm:mt-2">
                    <strong class="text-sm font-light md:text-sm">{{ course.creator.name }}</strong>

                    <h1 v-if="showName" class="text-2xl font-bold md:text-2xl">{{ course.name }}</h1>

                    <p v-if="showSummary" class="mt-4">{{ course.summary }}</p>
                </section>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        name: "CourseHeaderFullVideo",
        props: {
            course: {
                required: true,
                type: Object,
            },
            showName: {
                required: false,
                type: Boolean,
                default: false
            },
            showSummary: {
                required: false,
                type: Boolean,
                default: false
            }
        },
    }
</script>

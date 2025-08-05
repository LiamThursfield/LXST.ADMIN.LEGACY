<template>
    <section
        id="interest-form"
        class="px-4 py-12"
    >
        <standard-form
            class="max-w-screen-sm mx-auto"
            :form="form"
            :form-data-overrides="{
                'course_name': course.name
            }"
            :title-override="titleOverride"
            :title-class="titleClass"
            :button-class="buttonClass"
            :button-div-class="buttonDivClass"
        />
    </section>
</template>

<script>
    import StandardForm from "../../cms/forms/StandardForm.vue";

    export default {
        name: "CourseInterestForm",
        components: {
            StandardForm
        },
        props: {
            course: {
                required: true,
                type: Object,
            },
            form: {
                required: true,
                type: Object,
            },
            buttonDivClass: {
                default: 'text-center',
                type: String,
            },
            buttonClass: {
                default: 'button button-primary ml-auto',
                type: String,
            },
            titleClass: {
                default: 'font-bold text-lg pb-5',
                type: String
            },
            titleOverride: {
                default: '',
                type: String,
            }
        }
    }
</script>

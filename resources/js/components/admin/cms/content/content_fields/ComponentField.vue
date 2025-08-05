<template>
    <div>
        <slot />

        <div class="border-2 border-theme-subtle p-4 rounded">
            <div
                v-if="isLoadingComponentTemplate"
                class="flex flex-row items-start text-theme-base-subtle-contrast w-full"
            >
                <icon-loader-circle class="animate-spin-slow mr-2 w-5"/>
                <span class="text-left">Loading</span>
            </div>

            <div v-else-if="isInitialisedContent && isComponentTemplateFields">
                <content-editor
                    :template-fields="componentTemplateFields"
                    v-model="editableContent"
                />
            </div>
        </div>
    </div>
</template>

<script>
    import _ from "lodash";
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";
    import InputGroup from "../../../../core/forms/InputGroup.vue";

    export default {
        name: "ComponentField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            InputGroup,
        },
        data() {
            return {
                isInitialisedContent: false,
                isLoadingComponentTemplate: false,
                componentTemplate: null,
            }
        },
        computed: {
            isComponentTemplateFields() {
                return this.componentTemplateFields && this.componentTemplateFields.length;
            },
            componentTemplateId() {
                try {
                    return this.templateField.settings.template_id;
                } catch (e) {
                    return false;
                }
            },
            componentTemplateFields() {
                try {
                    return this.componentTemplate.template_fields;
                } catch (e) {
                    return null;
                }
            },
        },
        created() {
            this.getComponentTemplate();
        },
        methods: {
            getComponentTemplate() {
                this.isLoadingComponentTemplate = true;

                if (!this.componentTemplateId) {
                    this.$errorToast('No component template id set.');
                    return;
                }

                axios.get(
                    this.$route('admin.api.cms.templates.show', this.componentTemplateId),
                ).then(response => {
                    this.componentTemplate = response.data.data;
                    this.setInitialContent();
                }).catch(e => {
                    this.$errorToast('Failed to load component template');
                    console.log(e); // TODO: This should go through to a log tracker once available
                }).finally(() => {
                    this.isLoadingComponentTemplate = false;
                });
            },
            setInitialContent() {
                let formattedContent;

                if (!this.content || this.content === '') {
                    formattedContent = {};
                } else {
                    formattedContent = _.cloneDeep(this.content);
                }

                // Set the defaults for any missing content in the row
                _.forEach(this.componentTemplateFields, templateField => {
                    if (!formattedContent.hasOwnProperty(templateField.id)) {
                        formattedContent[templateField.id] = {
                            data: '',
                            template_field_id: templateField.id,
                            template_field_slug: templateField.slug,
                            template_field_type: templateField.type
                        };
                    }
                });

                this.editableContent = _.cloneDeep(formattedContent);
                this.isInitialisedContent = true;
            }
        }
    }
</script>

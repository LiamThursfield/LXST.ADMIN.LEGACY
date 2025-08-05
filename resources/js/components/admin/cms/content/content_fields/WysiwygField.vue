<template>
    <div>
        <slot />

        <Editor
            ref="editor"
            api-key="gpl"
            :init="editorConfig"
            v-model="editableContent"
        />
    </div>
</template>

<script>
    import { contentFieldMixin } from "../../../../../mixins/admin/cms/content-field";

    /** TinyMCE core **/
    import 'tinymce';
    import 'tinymce/icons/default/icons.min.js';

    /* Required TinyMCE components */
    import 'tinymce/themes/silver/theme.min.js';
    import 'tinymce/models/dom/model.min.js';

    /* Import plugins */
    import 'tinymce/plugins/code';
    import 'tinymce/plugins/fullscreen';
    import 'tinymce/plugins/image';
    import 'tinymce/plugins/link';
    import 'tinymce/plugins/lists';

    /** Loading this last ensures we use self-hosted **/
    import Editor from '@tinymce/tinymce-vue';

    /** Import the manifest file so we can ascertain the css path **/
    import manifestJson from '../../../../../../../public/build/manifest.json';

    export default {
        name: "WysiwygField",
        mixins: [
            contentFieldMixin,
        ],
        components: {
            Editor,
        },
        data() {
            return {
                editorFilePickerCallback: null,
            }
        },
        computed: {
            cssUrl() {
                let defaultUrl = '/css/app.css';
                try {
                    let manifestUrl = manifestJson['resources/js/app.css'].file;

                    return manifestUrl ? ('/build/' + manifestUrl) : defaultUrl;
                } catch (e) {
                    return defaultUrl;
                }
            },
            editorConfig() {
                return {
                    content_css: '/css/app.css',
                    file_picker_callback: this.onEditorFilePicker,
                    formats: {
                        alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-left' },
                        aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-center' },
                        alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-right' },
                        alignjustify: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'text-justify' },
                        bold: { inline: 'strong', classes: 'font-bold' },
                        italic: { inline: 'em', classes: 'italic' },
                        underline: { inline: 'span', classes: 'underline'},
                        strikethrough: { inline: 'span', classes: 'line-through' },
                    },
                    min_height: 300,
                    plugins: 'code fullscreen image link lists',
                    skin: 'SIGI',
                    skin_url: '/vendor/tinymce/skins/sigi',
                    toolbar: 'styleselect bold italic alignleft aligncenter alignright numlist bullist link image',
                };
            },
        },
        beforeDestroy() {
            this.$refs.editor.editor.destroy();
        },
        methods: {
            onEditorFilePicker(callback, value, meta) {
                this.editorFilePickerCallback = callback;
                this.$store.commit('openFileManagerModel', this.onFileManagerFileSelected);
            },
            onFileManagerFileSelected(file) {
                try {
                    this.editorFilePickerCallback(
                        file.url,
                        {alt: file.meta.filename ? file.meta.filename : ''}
                    );
                    this.editorFilePickerCallback = null;
                } catch (e) {
                    this.$errorToast(e);
                }
            }
        }
    }
</script>

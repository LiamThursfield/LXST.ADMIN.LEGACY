<template>
    <div>
        <main
            id="admin-layout"
            class="flex min-h-screen"
        >
            <side-menu
                :url="url()"
                :menu="sideMenu"
            />

            <div class="admin-section">
                <top-menu />

                <page-alerts />

                <div class="bg-theme-base flex-1 p-8">
                    <slot/>
                </div>
            </div>


            <!-- Singleton Modals -->
            <file-manager-modal class="z-30" />
        </main>
    </div>
</template>

<script>
    import { router } from '@inertiajs/vue2'

    import FileManagerModal from "../../components/admin/modals/FileManagerModal.vue";
    import PageAlerts from "../../components/core/alerts/PageAlerts.vue";

    export default {
        name: "AdminLayout",
        components: {
            FileManagerModal,
            PageAlerts
        },
        metaInfo() {
            return {
                title: this.metaTitle,
                meta: [
                    {
                        name: 'description',
                        content: this.metaDescription,
                    }
                ]
            }
        },
        data() {
            return {
                sideMenu: {
                    main: {
                        children: {
                            dashboard: {
                                children: false,
                                icon: "icon-home",
                                label: "Dashboard",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: [],
                                route: "admin.index",
                            },
                        },
                        label: "Main",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: [],
                        showLabel: false,
                    },
                    cms: {
                        children : {
                            pages: {
                                activeRoutes: ["admin.cms.pages.index", "admin.cms.pages.create", "admin.cms.pages.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Pages",
                                        requiresAllPermissions: ["cms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.pages.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Page",
                                        requiresAllPermissions: ["cms.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.pages.create",
                                    },
                                },
                                icon: "icon-layout-navbar",
                                label: "Pages",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms.create", "cms.view"],
                            },
                            layouts: {
                                activeRoutes: ["admin.cms.layouts.index", "admin.cms.layouts.create", "admin.cms.layouts.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Layouts",
                                        requiresAllPermissions: ["cms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.layouts.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Layout",
                                        requiresAllPermissions: ["cms_advanced.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.layouts.create",
                                    },
                                },
                                icon: "icon-layout",
                                label: "Layouts",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms.create", "cms.view"],
                            },
                            menus: {
                                activeRoutes: ["admin.cms.menus.index", "admin.cms.menus.create", "admin.cms.menus.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Menus",
                                        requiresAllPermissions: ["cms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.menus.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Menu",
                                        requiresAllPermissions: ["cms.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.menus.create",
                                    },
                                },
                                icon: "icon-columns",
                                label: "Menus",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms.create", "cms.view"],
                            },
                        },
                        label: "CMS",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["cms.edit", "cms.create", "cms.view"],
                        requiresTenantModule: 'cms',
                        showLabel: true,
                    },
                    cms_advanced: {
                        children : {
                            redirects: {
                                activeRoutes: ["admin.cms.redirects.index", "admin.cms.redirects.create", "admin.cms.redirects.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Redirects",
                                        requiresAllPermissions: ["cms_advanced.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.redirects.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Redirects",
                                        requiresAllPermissions: ["cms_advanced.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.redirects.create",
                                    },
                                },
                                icon: "icon-arrows-shuffle",
                                label: "Redirects",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms_advanced.create", "cms_advanced.view"],
                            },
                            templates: {
                                activeRoutes: ["admin.cms.templates.index", "admin.cms.templates.create", "admin.cms.templates.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Templates",
                                        requiresAllPermissions: ["cms_advanced.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.templates.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Template",
                                        requiresAllPermissions: ["cms_advanced.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.templates.create",
                                    },
                                },
                                icon: "icon-template",
                                label: "Templates",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms_advanced.create", "cms_advanced.view"],
                            },
                        },
                        label: "CMS - Advanced",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["cms_advanced.create", "cms_advanced.view"],
                        requiresTenantModule: 'cms',
                        showLabel: true,
                    },
                    cms_advanced: {
                        children : {
                            redirects: {
                                activeRoutes: ["admin.cms.redirects.index", "admin.cms.redirects.create", "admin.cms.redirects.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Redirects",
                                        requiresAllPermissions: ["cms_advanced.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.redirects.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Redirects",
                                        requiresAllPermissions: ["cms_advanced.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.redirects.create",
                                    },
                                },
                                icon: "icon-arrows-shuffle",
                                label: "Redirects",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms_advanced.create", "cms_advanced.view"],
                            },
                            templates: {
                                activeRoutes: ["admin.cms.templates.index", "admin.cms.templates.create", "admin.cms.templates.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Templates",
                                        requiresAllPermissions: ["cms_advanced.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.templates.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Template",
                                        requiresAllPermissions: ["cms_advanced.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.cms.templates.create",
                                    },
                                },
                                icon: "icon-template",
                                label: "Templates",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["cms_advanced.create", "cms_advanced.view"],
                            },
                        },
                        label: "CMS - Advanced",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["cms_advanced.create", "cms_advanced.view"],
                        showLabel: true,
                    },
                    crm: {
                        children: {
                            forms: {
                                activeRoutes: ["admin.crm.forms.index", "admin.crm.forms.create", "admin.crm.forms.edit", "admin.crm.form-submissions.index", "admin.crm.form-submissions.show"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Forms",
                                        requiresAllPermissions: ["crm_forms.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.forms.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Form",
                                        requiresAllPermissions: ["crm_forms.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.forms.create",
                                    },
                                    submissions: {
                                        activeRoutes: ["admin.crm.form-submissions.index", "admin.crm.form-submissions.show"],
                                        icon: false,
                                        label: "View Form Submissions",
                                        requiresAllPermissions: ["crm_form_submissions.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.form-submissions.index",
                                    },
                                },
                                icon: "icon-forms",
                                label: "Forms",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["crm_forms.create", "crm_forms.view"],
                            },
                            contacts: {
                                activeRoutes: ["admin.crm.contacts.index", "admin.crm.contacts.create", "admin.crm.contacts.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Contacts",
                                        requiresAllPermissions: ["crm_contacts.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.contacts.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Contact",
                                        requiresAllPermissions: ["crm_contacts.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.contacts.create",
                                    },
                                },
                                icon: "icon-id",
                                label: "Contacts",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["crm_contacts.create", "crm_contacts.view"],
                            },
                            organisation_units: {
                                activeRoutes: ["admin.crm.organisation-units.index", "admin.crm.organisation-units.create", "admin.crm.organisation-units.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Units",
                                        requiresAllPermissions: ["crm_organisation_units.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.organisation-units.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create Unit",
                                        requiresAllPermissions: ["crm_organisation_units.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.crm.organisation-units.create",
                                    },
                                },
                                icon: "icon-building",
                                label: "Organisation Units",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["crm_organisation_units.create", "crm_organisation_units.view"],
                            }
                        },
                        label: "CRM",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["crm_forms.create", "crm_forms.view", "crm_contacts.create", "crm_contacts.view", "crm_organisation_units.create", "crm_organisation_units.view"],
                        requiresTenantModule: 'crm',
                        showLabel: true,
                    },
                    utilities: {
                        children : {
                            file_manager: {
                                children: false,
                                icon: "icon-folders",
                                label: "File Manager",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["file_manager.view"],
                                route: 'admin.file_manager.index',
                            }
                        },
                        label: "Utilities",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["file_manager.view"],
                        showLabel: true,
                    },
                    admin: {
                        children : {
                            settings: {
                                activeRoutes: ["admin.settings.edit"],
                                children: {
                                    core: {
                                        icon: false,
                                        label: "Core",
                                        requiresAllPermissions: ["settings.edit"],
                                        requiresAnyPermissions: [],
                                        route: ["admin.settings.edit", 'core'],
                                    },
                                    theme: {
                                        children: false,
                                        icon: false,
                                        label: "Theme",
                                        requiresAllPermissions: ["settings.edit"],
                                        requiresAnyPermissions: [],
                                        route: ["admin.settings.edit", 'theme'],
                                    },
                                    thirdParty: {
                                        children: false,
                                        icon: false,
                                        label: "Third Party",
                                        requiresAllPermissions: ["settings.edit"],
                                        requiresAnyPermissions: [],
                                        route: ["admin.settings.edit", 'third-party'],
                                    },
                                },
                                icon: "icon-settings",
                                label: "Settings",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["settings.edit"],
                                route: false,
                            },
                            users: {
                                activeRoutes: ["admin.users.index", "admin.users.create", "admin.users.edit"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Users",
                                        requiresAllPermissions: ["users.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.users.index",
                                    },
                                    create: {
                                        children: false,
                                        icon: false,
                                        label: "Create User",
                                        requiresAllPermissions: ["users.create"],
                                        requiresAnyPermissions: [],
                                        route: "admin.users.create",
                                    },
                                },
                                icon: "icon-users",
                                label: "Users",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["users.view", "users.create"],
                                route: false,
                            },
                            email_preview: {
                                activeRoutes: ["admin.email.preview.index", "admin.email.preview.show"],
                                children: {
                                    index: {
                                        icon: false,
                                        label: "View Emails",
                                        requiresAllPermissions: ["email_preview.view"],
                                        requiresAnyPermissions: [],
                                        route: "admin.email.preview.index",
                                    },
                                },
                                icon: "icon-mail",
                                label: "Email Preview",
                                requiresAllPermissions: [],
                                requiresAnyPermissions: ["admin.email.preview.index", "admin.email.preview.show"],
                                route: false,
                            },

                        },
                        label: "Admin",
                        requiresAllPermissions: [],
                        requiresAnyPermissions: ["users.view", "users.create"],
                        showLabel: true,
                    },
                },
            }
        },
        computed: {
            metaDescription() {
                return this.getMetaDataField(
                    'description',
                    'LXST.ADMIN - powered by Laravel, Tailwind, Vue, and Inertia'
                );
            },
            metaTitle() {
                return this.getMetaDataField(
                    'title',
                    'LXST.ADMIN'
                );
            }
        },
        mounted() {
            router.on('success', event => {
                this.hideMobileSideMenu();
            })
        },
        methods: {
            getMetaDataField(slug, fallback = '') {
                try {
                    return this.$page.props.meta[slug] ?? fallback;
                } catch (e) {
                    console.log(e);
                    return fallback;
                }
            },
            url() {
                return location.pathname.substr(1)
            },
            hideMobileSideMenu() {
                if (this.$store.state.isMobileSideMenuOpen) {
                    this.$store.commit('hideMobileSideMenu');
                }
            },
        }
    }
</script>

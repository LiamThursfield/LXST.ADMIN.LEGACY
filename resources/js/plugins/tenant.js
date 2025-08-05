// Add tenant helpers
import Vue from "vue";

Vue.mixin({
    methods: {
        /**
         * Returns the tenant if available
         * @returns {null|Object}
         */
        tenant() {
            try {
                return this.$page.props.tenant;
            } catch (e) {
                return null;
            }
        },
        /**
         * Check whether the tenant has a given module
         * @param module
         * @returns {boolean}
         */
        tenantHasModule(module) {
            try {
                let tenant = this.tenant();
                if (!tenant) {
                    return false;
                }

                module = module.toUpperCase();

                return tenant.modules.indexOf(module) >= 0;
            } catch (e) {
                console.error(e);
                return false;
            }
        },
    }
})
